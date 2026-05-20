<?php
session_start();
require_once 'includes/auth.php';

$courseID = isset($_GET['courseID']) ? (int)$_GET['courseID'] : 0;
if ($courseID <= 0) {
    header("Location: courses.php");
    exit;
}

$isLoggedIn = isset($_SESSION['accountID']);

$conn = $GLOBALS['conn'] ?? null;
$course = null;
$modules = [];

// Fetch Course (accessible to everyone)
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

    // Fetch Modules + Items
    $stmt = mysqli_prepare($conn, "SELECT id, title FROM module WHERE courseID = ? ORDER BY id ASC");
    mysqli_stmt_bind_param($stmt, "i", $courseID);
    mysqli_stmt_execute($stmt);
    $modRes = mysqli_stmt_get_result($stmt);

    while ($mod = mysqli_fetch_assoc($modRes)) {
        $modID = (int)$mod['id'];

        $itemStmt = mysqli_prepare($conn, "
            SELECT mi.id, mi.sort, mi.isFree, v.name AS videoName, v.video AS videoFile
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

        $modules[] = [
            'id' => $modID,
            'title' => $mod['title'],
            'items' => $items
        ];
    }
    mysqli_stmt_close($stmt);
}

$currentVideo = null;
if (!empty($modules) && !empty($modules[0]['items'])) {
    foreach ($modules[0]['items'] as $item) {
        if ($item['isFree'] == 1) {
            $currentVideo = $item;
            break;
        }
    }
    if (!$currentVideo) $currentVideo = $modules[0]['items'][0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['name'] ?? 'Free Preview') ?> - Oscord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root { --ink: #1A1612; --gold: #C9A84C; }
        body { margin:0; padding:0; font-family:'DM Sans', sans-serif; }
        .font-display { font-family:'Cormorant Garamond', serif; }

        video { width:100% !important; height:100% !important; display:block; }
        .lesson-item.locked { opacity: 0.75; }
        .lesson-item.active { background:#FEFCE8; border-left:4px solid var(--gold); }
    </style>
</head>
<body>

<?php include './nav.php'; ?>

<div class="flex" style="height: calc(100vh - 72px);">
    <!-- SIDEBAR -->
    <div class="w-80 bg-white border-r flex flex-col overflow-hidden">
        <div class="p-5 border-b">
            <div class="uppercase text-xs tracking-widest text-var(--gold)">FREE PREVIEW</div>
            <div class="font-display text-lg font-light"><?= htmlspecialchars($course['name']) ?></div>
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
                            <div onclick="<?= $item['isFree'] == 1 ? "playVideo('".htmlspecialchars($item['videoFile'])."','".htmlspecialchars($item['videoName'])."',this)" : "showLockedMessage()" ?>"
                                 class="lesson-item flex items-center gap-3 px-4 py-3 rounded-2xl cursor-pointer hover:bg-gray-50 text-sm <?= $item['isFree'] != 1 ? 'locked' : '' ?>">
                                <i class="fa-solid <?= $item['isFree'] == 1 ? 'fa-play' : 'fa-lock' ?> text-var(--gold)"></i>
                                <span><?= htmlspecialchars($item['videoName']) ?></span>
                                <?php if ($item['isFree'] != 1): ?>
                                    <span class="ml-auto text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded">Locked</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <div class="h-14 bg-white border-b flex items-center px-6 justify-between flex-shrink-0">
            <a href="specificCourse.php?courseID=<?= $courseID ?>" class="flex items-center gap-2 text-sm hover:text-var(--gold)">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Course
            </a>
            <h1 class="font-display text-lg font-light"><?= htmlspecialchars($course['name']) ?></h1>
            <div></div>
        </div>

        <div class="flex-1 bg-black relative overflow-hidden">
            <?php if ($currentVideo && $currentVideo['isFree'] == 1): ?>
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
                <div class="absolute inset-0 flex items-center justify-center text-white text-center px-6">
                    <div>
                        <i class="fa-solid fa-play-circle text-6xl opacity-40 mb-4"></i>
                        <p class="text-xl">Free Preview</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-white border-t p-5 flex-shrink-0">
            <div id="currentLessonTitle" class="font-display text-2xl font-light">
                <?= htmlspecialchars($currentVideo['videoName'] ?? 'Free Preview') ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Locked Lecture Modal -->
<div id="lockedModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 text-center">
        <i class="fa-solid fa-lock text-5xl text-amber-500 mb-6"></i>
        <h2 class="text-2xl font-display mb-3">This lecture is locked</h2>
        <p class="text-gray-600 mb-8">You need to enroll in the course to watch this lecture.</p>
        
        <?php if ($isLoggedIn): ?>
            <a href="enrollCourse.php?courseID=<?= $courseID ?>" 
               class="block w-full py-4 bg-var(--ink) text-white rounded-2xl font-medium hover:bg-black transition">
                Enroll Now
            </a>
        <?php else: ?>
            <a href="specificCourse.php?courseID=<?= $courseID ?>" 
               class="block w-full py-4 bg-var(--ink) text-white rounded-2xl font-medium hover:bg-black transition">
                Go to Course Page & Login
            </a>
        <?php endif; ?>
        
        <button onclick="hideLockedModal()" class="mt-4 text-gray-500 hover:text-gray-700">Close</button>
    </div>
</div>

<script>
// Play only free videos
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
}

function showLockedMessage() {
    document.getElementById('lockedModal').classList.remove('hidden');
}

function hideLockedModal() {
    document.getElementById('lockedModal').classList.add('hidden');
}

function toggleModule(header) {
    const content = header.nextElementSibling;
    content.classList.toggle('hidden');
    const chevron = header.querySelector('.module-chevron');
    chevron.style.transform = content.classList.contains('hidden') ? '' : 'rotate(180deg)';
}

window.onload = () => {
    const firstHeader = document.querySelector('.module-header');
    if (firstHeader) firstHeader.nextElementSibling.classList.remove('hidden');
};
</script>

</body>
</html>