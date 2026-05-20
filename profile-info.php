<?php
// profile-info.php - FULL VERSION + FIXED (no more undefined variable warnings)

$totalCourses = 0;
$classesEnrolled = 0;
$completedClasses = 0;
$gpa = '—';
$studentID = null;
$specificLabel = 'STUDENT ID';

if (!empty($user['id'])) {
    $accountID = (int)$user['id'];
    $conn = $GLOBALS['conn'] ?? null;

    // Get studentID from student table
    $studentRes = mysqli_query($conn, "SELECT id FROM student WHERE accountID = $accountID LIMIT 1");
    if ($studentRes && mysqli_num_rows($studentRes) > 0) {
        $studentID = (int)mysqli_fetch_assoc($studentRes)['id'];

        $totalRes = mysqli_query($conn, "
            SELECT COUNT(DISTINCT courseID) as total 
            FROM (
                SELECT courseID FROM enrollment WHERE studentID = $studentID
                UNION
                SELECT b.courseID 
                FROM group_class_enrollment g
                JOIN batch b ON g.batchID = b.id
                WHERE g.studentID = $studentID
            ) as unique_courses
        ");
        $totalCourses = $totalRes ? (int)mysqli_fetch_assoc($totalRes)['total'] : 0;

        // CLASSES ENROLLED
        $res2 = mysqli_query($conn, "SELECT COUNT(*) as total FROM group_class_enrollment WHERE studentID = $studentID");
        $classesEnrolled = $res2 ? (int)mysqli_fetch_assoc($res2)['total'] : 0;

        // COMPLETED CLASSES
        $completedQuery = "
            SELECT COUNT(*) as total 
            FROM (
                SELECT id FROM enrollment 
                WHERE studentID = $studentID AND isComplete = 1
                UNION ALL
                SELECT id FROM group_class_enrollment 
                WHERE studentID = $studentID AND isComplete = 1
            ) as completed
        ";
        $completedRes = mysqli_query($conn, $completedQuery);
        $completedClasses = $completedRes ? (int)mysqli_fetch_assoc($completedRes)['total'] : 0;

        // GPA
        $grades = [];
        $res1 = mysqli_query($conn, "SELECT grade FROM enrollment WHERE studentID = $studentID AND isComplete = 1 AND grade IS NOT NULL");
        while ($row = mysqli_fetch_assoc($res1)) $grades[] = $row['grade'];

        $res2 = mysqli_query($conn, "SELECT grade FROM group_class_enrollment WHERE studentID = $studentID AND isComplete = 1 AND grade IS NOT NULL");
        while ($row = mysqli_fetch_assoc($res2)) $grades[] = $row['grade'];

        if (count($grades) > 0) {
            $totalPoints = 0;
            foreach ($grades as $grade) {
                $totalPoints += gradeToPoint($grade);
            }
            $gpa = number_format($totalPoints / count($grades), 2);
        }
    }
}

function gradeToPoint($grade) {
    $g = strtoupper(trim($grade));
    if ($g === 'A+') return 4.00;
    if ($g === 'A')  return 3.75;
    if ($g === 'B+') return 3.25;
    if ($g === 'B')  return 2.75;
    if ($g === 'C')  return 2.25;
    if ($g === 'D')  return 1.75;
    if ($g === 'F')  return 1.25;
    return 0.0;
}

// Birthday formatting
$formattedBirthday = '—';
if (!empty($user['birthday'])) {
    $formattedBirthday = date('F j, Y', strtotime($user['birthday']));
}
?>

<div class="max-w-6xl mx-auto">

    <!-- Hero Header -->
    <div class="bg-white border border-black/10 rounded-3xl p-10 lg:p-12 flex flex-col lg:flex-row items-center gap-12 lg:gap-16 shadow-sm">
        <div class="flex-shrink-0">
            <?php if (!empty($photoPath)): ?>
                <img src="<?= htmlspecialchars($photoPath) ?>" alt="<?= htmlspecialchars($user['name'] ?? 'Profile') ?>"
                     class="w-64 h-64 lg:w-72 lg:h-72 object-cover rounded-full ring-8 ring-white shadow-2xl">
            <?php else: ?>
                <div class="w-64 h-64 lg:w-72 lg:h-72 bg-white border border-black/10 flex items-center justify-center rounded-full shadow-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-36 h-36 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex-1 text-center lg:text-left">
            <h1 class="text-5xl lg:text-6xl font-light tracking-[-2.5px] leading-none">
                <?= htmlspecialchars($user['name'] ?? 'User') ?>
            </h1>
            <div class="mt-6 flex items-center justify-center lg:justify-start">
                <div class="inline-flex items-center px-7 py-3 bg-white border-2 border-black text-lg font-medium rounded-2xl">
                    <span class="relative flex h-3 w-3 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-600"></span>
                    </span>
                    STUDENT
                </div>
            </div>
            <p class="mt-8 text-zinc-400 text-base font-light tracking-widest">
                MEMBER SINCE <?= !empty($user['registerDateTime']) ? date('F Y', strtotime($user['registerDateTime'])) : '—' ?>
            </p>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white border border-black p-8 rounded-3xl text-center hover:border-purple-300 transition-colors">
            <div class="text-xs font-medium tracking-[1.5px] text-zinc-400 mb-2">COURSES ENROLLED</div>
            <div class="text-5xl font-light"><?= $totalCourses ?></div>
        </div>
        <div class="bg-white border border-black p-8 rounded-3xl text-center hover:border-purple-300 transition-colors">
            <div class="text-xs font-medium tracking-[1.5px] text-zinc-400 mb-2">CLASSES ENROLLED</div>
            <div class="text-5xl font-light"><?= $classesEnrolled ?></div>
        </div>
        <div class="bg-white border border-black p-8 rounded-3xl text-center hover:border-purple-300 transition-colors">
            <div class="text-xs font-medium tracking-[1.5px] text-zinc-400 mb-2">GPA</div>
            <div class="text-5xl font-light"><?= $gpa ?></div>
        </div>
        <div class="bg-white border border-black p-8 rounded-3xl text-center hover:border-purple-300 transition-colors">
            <div class="text-xs font-medium tracking-[1.5px] text-zinc-400 mb-2">COMPLETED CLASSES</div>
            <div class="text-5xl font-light"><?= $completedClasses ?></div>
        </div>
    </div>

    <!-- Personal Information - Full Original Section -->
    <div class="mt-16">
        <h2 class="text-3xl font-light tracking-[-1px] mb-8">Personal Information</h2>
        <div class="bg-white border border-black rounded-3xl p-8 lg:p-12 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">

                <!-- Student ID -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-2xl flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0v5m4-5v5" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-semibold tracking-[1px] text-zinc-400 mb-0.5"><?= htmlspecialchars($specificLabel) ?></p>
                        <p class="text-2xl font-light leading-none"><?= $studentID ?? '—' ?></p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-2xl flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.5-5L18 8M3 19h18M3 8l7.5 5L18 8" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-semibold tracking-[1px] text-zinc-400 mb-0.5">EMAIL</p>
                        <p class="text-2xl font-light leading-none"><?= htmlspecialchars($user['email'] ?? '—') ?></p>
                    </div>
                </div>

                <!-- Country -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-2xl flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314-11.314z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-semibold tracking-[1px] text-zinc-400 mb-0.5">COUNTRY</p>
                        <p class="text-2xl font-light leading-none"><?= htmlspecialchars($user['country'] ?? '—') ?></p>
                    </div>
                </div>

                <!-- Birthday -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-2xl flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-semibold tracking-[1px] text-zinc-400 mb-0.5">BIRTHDAY</p>
                        <p class="text-2xl font-light leading-none"><?= $formattedBirthday ?></p>
                    </div>
                </div>

                <!-- Telegram -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-2xl flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 8a2 2 0 01-2 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-semibold tracking-[1px] text-zinc-400 mb-0.5">TELEGRAM</p>
                        <p class="text-2xl font-light leading-none"><?= htmlspecialchars($user['telegram'] ?? '—') ?></p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start gap-4 md:col-span-2">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-600 text-white rounded-2xl flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2 2 2 0 01-2-2 2 2 0 01-2-2 2 2 0 012-2 2 2 0 01-2-2 2 2 0 012-2zM21 19a2 2 0 01-2 2 2 2 0 01-2-2 2 2 0 01-2-2 2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] font-semibold tracking-[1px] text-zinc-400 mb-0.5">PHONE</p>
                        <p class="text-2xl font-light leading-none"><?= htmlspecialchars($user['phone'] ?? '—') ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>