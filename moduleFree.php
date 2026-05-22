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

        /* Mobile: sidebar becomes a bottom drawer / collapsible panel */
        @media (max-width: 767px) {
            #main-layout { flex-direction: column !important; height: auto !important; }
            #sidebar { width: 100% !important; border-right: none !important; border-bottom: 2px solid #e5e7eb; max-height: none; }
            #sidebar-inner { max-height: 260px; overflow-y: auto; }
            #video-area { height: 56vw; min-height: 200px; max-height: 360px; flex-shrink: 0; }
            #content-col { height: auto !important; overflow: visible !important; }
        }
    </style>
</head>
<body>

<?php include './nav.php'; ?>

<!-- Mobile: course title bar -->
<div class="md:hidden bg-white border-b px-4 py-3 flex items-center justify-between">
    <a href="specificCourse.php?courseID=<?= $courseID ?>" class="flex items-center gap-2 text-sm text-zinc-600">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <span class="font-display text-base font-light truncate max-w-[60vw] text-center"><?= htmlspecialchars($course['name']) ?></span>
    <div class="w-10"></div>
</div>

<div id="main-layout" class="flex" style="height: calc(100vh - 72px);">

    <!-- ══════════════ SIDEBAR ══════════════ -->
    <!-- On mobile: renders BELOW the video (order-2); on desktop: left column (order-1) -->
    <div id="sidebar" class="order-2 md:order-1 md:w-80 w-full bg-white border-r flex flex-col overflow-hidden flex-shrink-0">
        
        <!-- Sidebar header — hidden on mobile (redundant with top bar) -->
        <div class="hidden md:block p-5 border-b">
            <div class="uppercase text-xs tracking-widest text-zinc-400">FREE PREVIEW</div>
            <div class="font-display text-lg font-light"><?= htmlspecialchars($course['name']) ?></div>
        </div>

        <!-- Mobile: collapsible toggle -->
        <button onclick="toggleSidebar()" 
                class="md:hidden flex items-center justify-between px-5 py-3 border-b text-sm font-medium bg-amber-50 w-full text-left">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-list text-amber-600"></i>
                Course Contents
            </span>
            <i id="sidebar-chevron" class="fa-solid fa-chevron-down text-zinc-500 transition-transform"></i>
        </button>

        <!-- Module list -->
        <div id="sidebar-inner" class="flex-1 overflow-y-auto p-3 hidden md:block">
            <?php foreach ($modules as $modIndex => $module): ?>
                <div class="mb-3">
                    <div onclick="toggleModule(this)" class="module-header px-4 py-3 md:px-5 md:py-4 cursor-pointer flex justify-between items-center hover:bg-amber-50 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 bg-zinc-800 text-white text-xs font-mono flex items-center justify-center rounded-full flex-shrink-0">
                                <?= str_pad($modIndex+1,2,'0',STR_PAD_LEFT) ?>
                            </span>
                            <span class="font-medium text-sm md:text-base leading-tight"><?= htmlspecialchars($module['title']) ?></span>
                        </div>
                        <i class="fa-solid fa-chevron-down module-chevron transition-transform flex-shrink-0 ml-2 text-sm"></i>
                    </div>
                    <div class="module-content hidden pl-6 md:pl-8 pr-2 mt-1">
                        <?php foreach ($module['items'] as $item): ?>
                            <div onclick="<?= $item['isFree'] == 1 ? "playVideo('".htmlspecialchars($item['videoFile'])."','".htmlspecialchars($item['videoName'])."',this)" : "showLockedMessage()" ?>"
                                 class="lesson-item flex items-center gap-3 px-3 md:px-4 py-2.5 md:py-3 rounded-2xl cursor-pointer hover:bg-gray-50 text-sm <?= $item['isFree'] != 1 ? 'locked' : '' ?>">
                                <i class="fa-solid <?= $item['isFree'] == 1 ? 'fa-play' : 'fa-lock' ?> text-amber-500 flex-shrink-0 text-xs"></i>
                                <span class="flex-1 min-w-0 truncate"><?= htmlspecialchars($item['videoName']) ?></span>
                                <?php if ($item['isFree'] != 1): ?>
                                    <span class="flex-shrink-0 text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded">Locked</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ══════════════ MAIN CONTENT ══════════════ -->
    <div id="content-col" class="order-1 md:order-2 flex-1 flex flex-col overflow-hidden">

        <!-- Desktop top bar -->
        <div class="hidden md:flex h-14 bg-white border-b items-center px-6 justify-between flex-shrink-0">
            <a href="specificCourse.php?courseID=<?= $courseID ?>" class="flex items-center gap-2 text-sm hover:text-amber-600 transition-colors">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Course
            </a>
            <h1 class="font-display text-lg font-light"><?= htmlspecialchars($course['name']) ?></h1>
            <div></div>
        </div>

        <!-- Video player -->
        <div id="video-area" class="flex-1 bg-black relative overflow-hidden">
            <?php if ($currentVideo && $currentVideo['isFree'] == 1): ?>
                <video id="mainVideo" 
                       controls 
                       controlsList="nodownload"
                       disablePictureInPicture
                       oncontextmenu="return false;"
                       class="absolute inset-0 w-full h-full"
                       autoplay
                       playsinline>
                    <source src="video/<?= htmlspecialchars($currentVideo['videoFile']) ?>" type="video/mp4">
                </video>
            <?php else: ?>
                <div class="absolute inset-0 flex items-center justify-center text-white text-center px-6">
                    <div>
                        <i class="fa-solid fa-play-circle text-5xl md:text-6xl opacity-40 mb-4"></i>
                        <p class="text-lg md:text-xl">Free Preview</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Lesson title bar -->
        <div class="bg-white border-t px-4 py-3 md:p-5 flex-shrink-0">
            <div id="currentLessonTitle" class="font-display text-lg md:text-2xl font-light leading-tight">
                <?= htmlspecialchars($currentVideo['videoName'] ?? 'Free Preview') ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Locked Lecture Modal -->
<div id="lockedModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full text-center">
        <i class="fa-solid fa-lock text-4xl md:text-5xl text-amber-500 mb-4 md:mb-6"></i>
        <h2 class="text-xl md:text-2xl font-display mb-3">This lecture is locked</h2>
        <p class="text-gray-600 mb-6 md:mb-8 text-sm md:text-base">You need to enroll in the course to watch this lecture.</p>
        
        <?php if ($isLoggedIn): ?>
            <a href="enrollCourse.php?courseID=<?= $courseID ?>" 
               class="block w-full py-4 bg-zinc-900 text-white rounded-2xl font-medium hover:bg-black transition text-sm md:text-base">
                Enroll Now
            </a>
        <?php else: ?>
            <a href="specificCourse.php?courseID=<?= $courseID ?>" 
               class="block w-full py-4 bg-zinc-900 text-white rounded-2xl font-medium hover:bg-black transition text-sm md:text-base">
                Go to Course Page &amp; Login
            </a>
        <?php endif; ?>
        
        <button onclick="hideLockedModal()" class="mt-4 text-gray-500 hover:text-gray-700 text-sm">Close</button>
    </div>
</div>

<script>
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

    // On mobile, scroll to top (video) after selecting a lesson
    if (window.innerWidth < 768) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
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

// Mobile sidebar toggle
let sidebarOpen = false;
function toggleSidebar() {
    const inner = document.getElementById('sidebar-inner');
    const chevron = document.getElementById('sidebar-chevron');
    sidebarOpen = !sidebarOpen;
    inner.classList.toggle('hidden', !sidebarOpen);
    chevron.style.transform = sidebarOpen ? 'rotate(180deg)' : '';
}

window.onload = () => {
    const firstHeader = document.querySelector('.module-header');
    if (firstHeader) firstHeader.nextElementSibling.classList.remove('hidden');
};
</script>

</body>
</html>