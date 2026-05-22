<?php
session_start();
require_once 'includes/connectdb.php';
require_once 'includes/auth.php';
include 'nav.php';

// Check login
$isLoggedIn = function_exists('isLoggedIn') && isLoggedIn();
$user = $isLoggedIn ? getCurrentUser() : null;
$studentID = null;

if ($isLoggedIn && $user && $GLOBALS['conn']) {
    $res = mysqli_query($GLOBALS['conn'], "SELECT id FROM student WHERE accountID = " . (int)$user['id']);
    if ($res && mysqli_num_rows($res) > 0) {
        $studentID = (int)mysqli_fetch_assoc($res)['id'];
    }
}

// Fetch courses
$courses = [];
$conn = $GLOBALS['conn'] ?? null;
if ($conn) {
    $query = "SELECT c.*, p.name AS photo_name FROM course c LEFT JOIN photo p ON c.photoID = p.id ORDER BY c.sort ASC";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $catQuery = "SELECT cat.name FROM coursexcategory cc JOIN category cat ON cc.categoryID = cat.id WHERE cc.courseID = " . (int)$row['id'];
        $catRes = mysqli_query($conn, $catQuery);
        $categories = [];
        while ($cat = mysqli_fetch_assoc($catRes)) $categories[] = $cat['name'];
        $row['categories'] = $categories;

        $enrolled = false;
        if ($studentID) {
            $check = mysqli_query($conn, "SELECT id FROM enrollment WHERE studentID = $studentID AND courseID = " . (int)$row['id'] . " LIMIT 1");
            $enrolled = mysqli_num_rows($check) > 0;
        }
        $row['isEnrolled'] = $enrolled;
        $courses[] = $row;
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-white-50 min-h-screen pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-16">
        
        <div class="mb-12 text-center md:text-left">
            <h1 class="text-5xl md:text-6xl font-light tracking-tight">Discover Our Courses</h1>
            <p class="mt-4 text-xl text-zinc-600">Learn from industry experts. Build real projects.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <?php foreach ($courses as $course): ?>
                <?php 
                $photoUrl = !empty($course['photo_name']) ? "image/" . htmlspecialchars($course['photo_name']) : null;
                $buttonText = $course['isEnrolled'] ? "Continue Learning" : "View Detail";
                $buttonBg   = $course['isEnrolled'] ? "bg-emerald-600 hover:bg-emerald-700" : "bg-black hover:bg-purple-600";
                ?>
                
                <a href="specificCourse.php?courseID=<?= (int)$course['id'] ?>" 
                   class="group bg-white border border-black/10 rounded-3xl overflow-hidden hover:border-black hover:shadow-2xl transition-all flex flex-col h-full">
                    
                    <div class="h-52 md:h-56 bg-zinc-100 relative overflow-hidden">
                        <?php if ($photoUrl): ?>
                            <img src="<?= $photoUrl ?>" alt="<?= htmlspecialchars($course['name']) ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-7xl opacity-20">📚</div>
                        <?php endif; ?>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($course['categories'] as $cat): ?>
                                <span class="text-xs px-3 py-1 bg-zinc-100 text-zinc-700 rounded-2xl">
                                    <?= htmlspecialchars($cat) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <h3 class="text-xl md:text-2xl font-light leading-tight mb-6 line-clamp-3 group-hover:text-purple-700 transition-colors">
                            <?= htmlspecialchars($course['name']) ?>
                        </h3>

                        <div class="mt-auto flex justify-between items-end">
                            <div>
                                <p class="text-xs text-zinc-500 tracking-widest">FEE</p>
                                <p class="text-3xl font-light"><?= number_format($course['fee'] * 0.2) ?> <span class="text-base">MMK</span></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-zinc-500 tracking-widest">DURATION</p>
                                <p class="font-medium"><?= htmlspecialchars($course['period'] ?? '3 Months') ?></p>
                            </div>
                        </div>

                        <div class="mt-8 <?= $buttonBg ?> text-white text-center py-4 rounded-2xl font-medium text-lg transition-all">
                            <?= $buttonText ?> →
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include './footer.php'; ?>