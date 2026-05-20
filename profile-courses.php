<?php
// profile-courses.php
// Full version: displays enrolled courses in modern minimalist cards

$studentID = null;
$enrollments = [];

if (isset($user) && $user && isset($user['id'])) {
    $conn = $GLOBALS['conn'] ?? null;
    if ($conn) {
        // Get student ID from account
        $studentRes = mysqli_query($conn, "SELECT id FROM student WHERE accountID = " . (int)$user['id']);
        if ($studentRes && mysqli_num_rows($studentRes) > 0) {
            $studentRow = mysqli_fetch_assoc($studentRes);
            $studentID = $studentRow['id'];

            // Fetch all enrollments with course + learning type details
            $enrollQuery = "
                SELECT 
                    e.id,
                    e.courseID,
                    e.learningType,
                    e.enrollDateTime,
                    e.isApprove,
                    e.isComplete,
                    e.grade,
                    c.name AS course_name,
                    lt.name AS learning_type_name
                FROM enrollment e
                JOIN course c ON e.courseID = c.id
                JOIN learning_type lt ON e.learningType = lt.id
                WHERE e.studentID = $studentID
                ORDER BY e.enrollDateTime DESC
            ";
            
            $enrollRes = mysqli_query($conn, $enrollQuery);
            
            if ($enrollRes) {
                while ($row = mysqli_fetch_assoc($enrollRes)) {
                    $enrollments[] = $row;
                }
            }
        }
    }
}
?>

<div class="max-w-5xl mx-auto">
    <h2 class="text-5xl font-light tracking-[-2px] mb-12">Your Courses</h2>
    
    <?php if (empty($enrollments)): ?>
        <!-- No courses placeholder (kept from original) -->
        <div class="bg-white border-2 border-black p-12 text-center">
            <p class="text-xl text-zinc-500">You haven't enrolled in any courses yet.</p>
            <a href="courses.php" 
               class="inline-block mt-10 px-10 py-5 bg-black text-white text-lg font-medium hover:bg-purple-600 transition-colors">
                BROWSE ALL COURSES
            </a>
        </div>
    <?php else: ?>
        <!-- Modern minimalist card grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($enrollments as $row): ?>
                <?php 
                $isApproved = (int)$row['isApprove'] === 1;
                $approveLabel = $isApproved ? 'Active' : 'Not Active Yet';
                $approveColor = $isApproved 
                    ? 'bg-emerald-100 text-emerald-700 border-emerald-300' 
                    : 'bg-red-100 text-red-700 border-red-300';

                $isCompleted = !empty($row['isComplete']) && (int)$row['isComplete'] === 1;
                $completeLabel = $isCompleted ? 'Completed' : 'Not completed yet';
                $completeColor = $isCompleted 
                    ? 'bg-emerald-100 text-emerald-700 border-emerald-300' 
                    : 'bg-blue-100 text-blue-700 border-blue-300';
                ?>
                
                <div class="group bg-white border-2 border-black hover:border-purple-600 transition-all duration-300 p-8 flex flex-col h-full">
                    
                    <!-- Course name -->
                    <h3 class="text-2xl font-light tracking-tight leading-none mb-8 line-clamp-2 min-h-[3.5rem]">
                        <?= htmlspecialchars($row['course_name']) ?>
                    </h3>

                    <!-- Status row -->
                    <div class="flex flex-wrap gap-3 mb-10">
                        
                        <!-- isApprove status -->
                        <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border <?= $approveColor ?> rounded-none">
                            <?= $approveLabel ?>
                        </div>

                        <!-- Learning type -->
                        <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border border-black/70 bg-white rounded-none">
                            <?= htmlspecialchars($row['learning_type_name']) ?>
                        </div>

                        <!-- isComplete status -->
                        <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border <?= $completeColor ?> rounded-none">
                            <?= $completeLabel ?>
                        </div>

                        <!-- Grade (if exists) -->
                        <?php if (!empty($row['grade'])): ?>
                            <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border border-black/70 bg-white rounded-none">
                                Grade: <span class="ml-1 font-semibold"><?= htmlspecialchars($row['grade']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Enrolled date -->
                    <div class="mt-auto mb-8">
                        <p class="text-xs uppercase tracking-[0.5px] text-zinc-400 mb-1">Enrolled on</p>
                        <p class="text-zinc-600 font-light">
                            <?= date('F j, Y', strtotime($row['enrollDateTime'])) ?>
                        </p>
                    </div>

                    <!-- Study button -->
                    <a href="specificCourse.php?courseID=<?= (int)$row['courseID'] ?>" 
                       class="mt-auto block w-full text-center py-5 text-lg font-medium border-2 border-black hover:bg-purple-600 hover:text-white hover:border-purple-600 transition-all group-hover:shadow-xl">
                        STUDY THIS COURSE →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>