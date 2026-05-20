<?php
session_start();
require_once 'includes/auth.php';

$courseID = isset($_GET['courseID']) ? (int)$_GET['courseID'] : 0;
if ($courseID <= 0) {
    header("Location: courses.php");
    exit;
}

// Auth & Enrollment Check
$isLoggedIn = isset($_SESSION['accountID']);
if (!$isLoggedIn) {
    header("Location: specificCourse.php?courseID=$courseID");
    exit;
}

$accountID = (int)$_SESSION['accountID'];
$conn = $GLOBALS['conn'] ?? null;
$course = null;
$modules = [];
$isApproved = false;

if ($conn) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM course WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $courseID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res && mysqli_num_rows($res) > 0) {
        $course = mysqli_fetch_assoc($res);
    }
    mysqli_stmt_close($stmt);

    if (!$course) {
        header("Location: courses.php");
        exit;
    }

    $stmt = mysqli_prepare($conn, "SELECT id FROM student WHERE accountID = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $accountID);
    mysqli_stmt_execute($stmt);
    $stuRes = mysqli_stmt_get_result($stmt);
    $studentID = null;
    if ($stuRes && mysqli_num_rows($stuRes) > 0) {
        $student = mysqli_fetch_assoc($stuRes);
        $studentID = (int)$student['id'];
    }
    mysqli_stmt_close($stmt);

    if ($studentID) {
        $stmt = mysqli_prepare($conn, "SELECT isApprove FROM enrollment WHERE studentID = ? AND courseID = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "ii", $studentID, $courseID);
        mysqli_stmt_execute($stmt);
        $enrRes = mysqli_stmt_get_result($stmt);
        if ($enrRes && mysqli_num_rows($enrRes) > 0) {
            $enr = mysqli_fetch_assoc($enrRes);
            $isApproved = ($enr['isApprove'] == 1);
        }
        mysqli_stmt_close($stmt);
    }
}

if (!$isApproved) {
    header("Location: specificCourse.php?courseID=$courseID");
    exit;
}

// Fetch Modules
if ($course) {
    $stmt = mysqli_prepare($conn, "SELECT id, title FROM module WHERE courseID = ? ORDER BY id ASC");
    mysqli_stmt_bind_param($stmt, "i", $courseID);
    mysqli_stmt_execute($stmt);
    $modRes = mysqli_stmt_get_result($stmt);

    while ($mod = mysqli_fetch_assoc($modRes)) {
        $modID = (int)$mod['id'];
        $itemStmt = mysqli_prepare($conn, "
            SELECT mi.sort, v.name AS videoName, v.video AS videoFile
            FROM module_item mi
            LEFT JOIN video v ON mi.videoID = v.id
            WHERE mi.moduleID = ? AND mi.type = 'VIDEO'
            ORDER BY mi.sort ASC
        ");
        mysqli_stmt_bind_param($itemStmt, "i", $modID);
        mysqli_stmt_execute($itemStmt);
        $itemRes = mysqli_stmt_get_result($itemStmt);

        $items = [];
        while ($item = mysqli_fetch_assoc($itemRes)) {
            $items[] = $item;
        }
        mysqli_stmt_close($itemStmt);

        $modules[] = ['id' => $modID, 'title' => $mod['title'], 'items' => $items];
    }
    mysqli_stmt_close($stmt);
}

$currentVideo = !empty($modules) && !empty($modules[0]['items']) ? $modules[0]['items'][0] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['name'] ?? 'Course Player') ?> - Oscord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root { --ink: #1A1612; --gold: #C9A84C; }
        body { margin:0; padding:0; font-family:'DM Sans', sans-serif; }
        .font-display { font-family:'Cormorant Garamond', serif; }

        video { width:100% !important; height:100% !important; display:block; }

        .lesson-item.active { background:#FEFCE8; border-left:4px solid var(--gold); }

        .sidebar {
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -320px;
                top: 0;
                height: 100vh;
                z-index: 9999;
                box-shadow: 4px 0 30px rgba(0,0,0,0.25);
            }
            .sidebar.open { left: 0; }
        }
        /* Fix Next Button Visibility */
        button[onclick="nextLesson()"] {
            background-color: var(--ink) !important;
            color: white !important;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(26, 22, 18, 0.2);
        }

        button[onclick="nextLesson()"]:hover {
            background-color: #111111 !important;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<?php include './nav.php'; ?>

<div class="flex" style="height: calc(100vh - 72px);">
    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar w-80 bg-white border-r flex flex-col overflow-hidden md:static">
        <div class="p-5 border-b flex items-center justify-between md:hidden">
            <div>
                <div class="uppercase text-xs tracking-widest text-var(--gold)">CURRICULUM</div>
                <div class="font-display text-lg font-light"><?= htmlspecialchars($course['name']) ?></div>
            </div>
            <button onclick="toggleSidebar()" class="text-3xl leading-none hover:bg-gray-100 w-10 h-10 flex items-center justify-center rounded-xl">
                ✕
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-3">
            <?php foreach ($modules as $modIndex => $module): ?>
                <div class="mb-3">
                    <div onclick="toggleModule(this)" class="module-header px-5 py-4 cursor-pointer flex justify-between items-center hover:bg-amber-50 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 bg-var(--ink) text-white text-xs font-mono flex items-center justify-center rounded-full"><?= str_pad($modIndex+1,2,'0',STR_PAD_LEFT) ?></span>
                            <span class="font-medium"><?= htmlspecialchars($module['title']) ?></span>
                        </div>
                        <i class="fa-solid fa-chevron-down module-chevron transition-transform"></i>
                    </div>
                    <div class="module-content hidden pl-8 pr-2 mt-1">
                        <?php foreach ($module['items'] as $item): ?>
                            <div onclick="playVideo('<?= htmlspecialchars($item['videoFile']) ?>','<?= htmlspecialchars($item['videoName']) ?>',this)"
                                 class="lesson-item flex items-center gap-3 px-4 py-3 rounded-2xl cursor-pointer hover:bg-gray-50 text-sm">
                                <i class="fa-solid fa-play text-var(--gold)"></i>
                                <span><?= htmlspecialchars($item['videoName']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Bar -->
        <div class="h-14 bg-white border-b flex items-center px-6 justify-between flex-shrink-0">
            <div class="flex items-center gap-4">
                <!-- Hamburger only on mobile -->
                <button onclick="toggleSidebar()" class="md:hidden p-2 hover:bg-gray-100 rounded-lg text-2xl">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a href="specificCourse.php?courseID=<?= $courseID ?>" class="flex items-center gap-2 text-sm hover:text-var(--gold)">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="hidden md:inline">Back to Course</span>
                </a>
            </div>
            <h1 class="font-display text-lg font-light"><?= htmlspecialchars($course['name']) ?></h1>
            <div></div>
        </div>

        <!-- VIDEO - FULL FIT -->
        <div class="flex-1 bg-black relative overflow-hidden">
            <?php if ($currentVideo): ?>
                <video id="mainVideo" 
                       controls 
                       controlsList="nodownload"
                       disablePictureInPicture
                       oncontextmenu="return false;"
                       class="absolute inset-0 w-full h-full"
                       autoplay>
                    <source src="video/<?= htmlspecialchars($currentVideo['videoFile']) ?>" type="video/mp4">
                </video>
            <?php else: ?>
                <div class="absolute inset-0 flex items-center justify-center text-white text-2xl">No video available</div>
            <?php endif; ?>
        </div>

        <!-- Bottom Bar -->
        <div class="bg-white border-t p-5 flex-shrink-0">
            <div id="currentLessonTitle" class="font-display text-2xl font-light">
                <?= htmlspecialchars($currentVideo['videoName'] ?? 'Select a lesson') ?>
            </div>
            <div class="flex gap-3 mt-4">
                <button onclick="prevLesson()" class="flex-1 py-4 border rounded-2xl flex items-center justify-center gap-2 hover:bg-gray-100">
                    <i class="fa-solid fa-chevron-left"></i> Previous
                </button>
                <button onclick="nextLesson()" 
                    class="flex-1 py-4 bg-var(--ink) text-white rounded-2xl flex items-center justify-center gap-2 
                        hover:bg-black transition-all duration-200 font-medium shadow-sm">
                Next <i class="fa-solid fa-chevron-right"></i>
            </button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
// Lessons Data
const lessons = <?= json_encode(array_reduce($modules ?? [], function($c, $m) {
    foreach ($m['items'] as $i) $c[] = ['file' => $i['videoFile'], 'title' => $i['videoName']];
    return $c;
}, [])) ?>;

let currentIndex = 0;

function playVideo(filename, title, element) {
    const video = document.getElementById('mainVideo');
    if (video) {
        video.src = `video/${filename}`;
        video.load();
        video.play().catch(() => {});
    }
    document.getElementById('currentLessonTitle').textContent = title;
    document.querySelectorAll('.lesson-item').forEach(el => el.classList.remove('active'));
    if (element) element.classList.add('active');
    currentIndex = lessons.findIndex(l => l.file === filename);
}

function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

function toggleModule(header) {
    const content = header.nextElementSibling;
    content.classList.toggle('hidden');
    const chevron = header.querySelector('.module-chevron');
    chevron.style.transform = content.classList.contains('hidden') ? '' : 'rotate(180deg)';
}

function nextLesson() {
    if (currentIndex < lessons.length - 1) {
        currentIndex++;
        const l = lessons[currentIndex];
        playVideo(l.file, l.title, null);
    }
}

function prevLesson() {
    if (currentIndex > 0) {
        currentIndex--;
        const l = lessons[currentIndex];
        playVideo(l.file, l.title, null);
    }
}

document.addEventListener('keydown', e => {
    if (e.key === "ArrowRight") nextLesson();
    if (e.key === "ArrowLeft") prevLesson();
});

window.onload = () => {
    const firstHeader = document.querySelector('.module-header');
    if (firstHeader) firstHeader.nextElementSibling.classList.remove('hidden');
    const firstLesson = document.querySelector('.lesson-item');
    if (firstLesson) firstLesson.classList.add('active');
};
</script>

</body>
</html>