<?php
// course_horizontal.php - Fixed Width + Fixed Height Cards
$conn = $GLOBALS['conn'] ?? null;
$courses = [];

if ($conn) {
    $query = "
        SELECT c.*, p.name AS photo_name
        FROM course c
        LEFT JOIN photo p ON c.photoID = p.id
        ORDER BY c.sort ASC
        LIMIT 8
    ";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $catQuery = "
            SELECT cat.name 
            FROM coursexcategory cc 
            JOIN category cat ON cc.categoryID = cat.id 
            WHERE cc.courseID = " . (int)$row['id'] . "
        ";
        $catRes = mysqli_query($conn, $catQuery);
        $categories = [];
        while ($cat = mysqli_fetch_assoc($catRes)) {
            $categories[] = $cat['name'];
        }
        $row['categories'] = $categories;
        $courses[] = $row;
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<style>
    .horizontal-scroll {
        overflow-x: auto;
        overflow-y: hidden;
        padding: 20px 0 50px;
        scrollbar-width: none;
    }
    .horizontal-scroll::-webkit-scrollbar { display: none; }
    
    .horizontal-track {
        display: flex;
        gap: 28px;
        padding: 0 20px;
    }
    
    /* FIXED SIZE CARD */
    .course-card-horizontal {
        width: 380px !important;
        height: 600px !important;        /* Fixed Height */
        min-width: 380px !important;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
    }
    
    .course-card-horizontal .image-container {
        height: 220px !important;        /* Fixed image height */
        flex-shrink: 0;
    }
</style>

<div class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex justify-between items-end mb-10">
        <h2 class="text-5xl md:text-6xl font-light tracking-[-2.5px]"><b>Our Premium Courses</b></h2>
        <a href="courses.php" class="text-black hover:text-purple-600 flex items-center gap-2 text-lg">
            View All →
        </a>
    </div>

    <div class="horizontal-scroll">
        <div class="horizontal-track">
            <?php foreach ($courses as $course): ?>
                <?php 
                $photoUrl = !empty($course['photo_name']) ? "image/" . htmlspecialchars($course['photo_name']) : null;
                $buttonText = ($course['isEnrolled'] ?? false) ? "Continue Learning" : "View Detail";
                $buttonBg   = ($course['isEnrolled'] ?? false) ? "bg-emerald-600 hover:bg-emerald-700" : "bg-black hover:bg-purple-600";
                ?>
                
                <a href="specificCourse.php?courseID=<?= (int)$course['id'] ?>" 
                   class="course-card-horizontal group bg-white border border-black/10 rounded-3xl overflow-hidden hover:border-black hover:shadow-2xl transition-all duration-300 flex flex-col">
                    
                    <!-- Fixed Image Area -->
                    <div class="image-container bg-zinc-100 relative">
                        <?php if ($photoUrl): ?>
                            <img src="<?= $photoUrl ?>" 
                                 alt="<?= htmlspecialchars($course['name']) ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-100 to-white">
                                <span class="text-7xl opacity-20">📚</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="p-7 flex-1 flex flex-col">
                        <!-- Categories -->
                        <div class="flex flex-wrap gap-2 mb-5">
                            <?php foreach ($course['categories'] as $cat): ?>
                                <span class="text-xs font-medium px-4 py-1 bg-zinc-100 text-zinc-700 rounded-2xl">
                                    <?= htmlspecialchars($cat) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Title -->
                        <h3 class="text-2xl font-light leading-[1.3] tracking-tight text-black mb-6 line-clamp-3 group-hover:text-purple-700 transition-colors">
                            <?= htmlspecialchars($course['name']) ?>
                        </h3>

                        <!-- Fee & Period -->
                        <div class="mt-auto flex items-end justify-between">
                            <div>
                                <p class="text-xs tracking-widest text-zinc-500">FEE</p>
                                <p class="text-3xl font-light text-black">
                                    <?= number_format($course['fee'] * 0.2) ?> <span class="text-base">MMK</span>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs tracking-widest text-zinc-500">DURATION</p>
                                <p class="font-medium"><?= htmlspecialchars($course['period'] ?? '3 Months') ?></p>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="mt-8 <?= $buttonBg ?> text-white text-center py-4 rounded-2xl font-medium text-lg transition-all group-hover:scale-[1.02]">
                            <?= $buttonText ?> →
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>