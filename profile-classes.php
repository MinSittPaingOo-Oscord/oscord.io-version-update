<?php
// profile-classes.php
// Full version: displays student's group class enrollments

$studentID = null;
$groupEnrollments = [];

if (isset($user) && $user && isset($user['id'])) {
    $conn = $GLOBALS['conn'] ?? null;
    if ($conn) {
        // Get student ID
        $studentRes = mysqli_query($conn, "SELECT id FROM student WHERE accountID = " . (int)$user['id']);
        if ($studentRes && mysqli_num_rows($studentRes) > 0) {
            $studentRow = mysqli_fetch_assoc($studentRes);
            $studentID = $studentRow['id'];

            // Fetch group class enrollments
            $groupQuery = "
                SELECT 
                    gce.id AS enrollment_id,
                    gce.batchID,
                    gce.enrollDateTime,
                    gce.isApprove,
                    gce.isComplete,
                    gce.grade,
                    b.batchNumber,
                    b.schedule,
                    b.status AS batch_status,
                    b.startDate,
                    c.name AS course_name
                FROM group_class_enrollment gce
                JOIN batch b ON gce.batchID = b.id
                JOIN course c ON b.courseID = c.id
                WHERE gce.studentID = $studentID
                ORDER BY gce.enrollDateTime DESC
            ";
            
            $groupRes = mysqli_query($conn, $groupQuery);
            
            if ($groupRes) {
                while ($row = mysqli_fetch_assoc($groupRes)) {
                    $groupEnrollments[] = $row;
                }
            }
        }
    }
}
?>

<div class="max-w-5xl mx-auto">
    <h2 class="text-5xl font-light tracking-[-2px] mb-12">Your Classes</h2>
    
    <?php if (empty($groupEnrollments)): ?>
        <div class="bg-white border-2 border-black p-12 text-center">
            <p class="text-xl text-zinc-500">No active classes at the moment.</p>
            <p class="mt-4 text-zinc-400">Your group classes and batch schedules will appear here.</p>
            <a href="batches.php" 
               class="inline-block mt-10 px-10 py-5 bg-black text-white text-lg font-medium hover:bg-purple-600 transition-colors">
                BROWSE GROUP CLASSES
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($groupEnrollments as $row): ?>
                <?php 
                $isApproved = (int)$row['isApprove'] === 1;
                $approveLabel = $isApproved ? 'Active' : 'Pending Approval';
                $approveColor = $isApproved 
                    ? 'bg-emerald-100 text-emerald-700 border-emerald-300' 
                    : 'bg-amber-100 text-amber-700 border-amber-300';

                $isCompleted = !empty($row['isComplete']) && (int)$row['isComplete'] === 1;
                $completeLabel = $isCompleted ? 'Completed' : 'In Progress';
                $completeColor = $isCompleted 
                    ? 'bg-emerald-100 text-emerald-700 border-emerald-300' 
                    : 'bg-blue-100 text-blue-700 border-blue-300';
                ?>
                
                <div class="group bg-white border-2 border-black hover:border-purple-600 transition-all duration-300 p-8 flex flex-col h-full">
                    
                    <div class="mb-6">
                        <p class="text-xs uppercase tracking-[0.5px] text-zinc-400 mb-1">Batch #<?= htmlspecialchars($row['batchNumber']) ?></p>
                        <h3 class="text-2xl font-light tracking-tight leading-none line-clamp-2">
                            <?= htmlspecialchars($row['course_name']) ?>
                        </h3>
                    </div>

                    <div class="flex flex-wrap gap-3 mb-8">
                        <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border <?= $approveColor ?> rounded-none">
                            <?= $approveLabel ?>
                        </div>
                        <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border border-black/70 bg-white rounded-none">
                            <?= htmlspecialchars($row['batch_status']) ?>
                        </div>
                        <?php if (!empty($row['grade'])): ?>
                            <div class="inline-flex items-center px-5 py-1.5 text-xs font-medium border border-black/70 bg-white rounded-none">
                                Grade: <?= htmlspecialchars($row['grade']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-6">
                        <p class="text-xs uppercase tracking-[0.5px] text-zinc-400 mb-1">Schedule</p>
                        <p class="text-zinc-600 font-light text-sm leading-tight">
                            <?= nl2br(htmlspecialchars($row['schedule'])) ?>
                        </p>
                    </div>

                    <div class="mt-auto grid grid-cols-2 gap-8 text-sm mb-10">
                        <div>
                            <p class="text-xs uppercase tracking-[0.5px] text-zinc-400 mb-1">Starts</p>
                            <p class="text-zinc-600 font-light">
                                <?= date('M j, Y', strtotime($row['startDate'])) ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.5px] text-zinc-400 mb-1">Enrolled</p>
                            <p class="text-zinc-600 font-light">
                                <?= date('M j, Y', strtotime($row['enrollDateTime'])) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Get into Class Button -->
                    <?php if ($isApproved): ?>
                        <a href="specificGroupClass.php?batchID=<?= (int)$row['batchID'] ?>" 
                           class="mt-auto block w-full text-center py-5 text-lg font-medium border-2 border-black hover:bg-purple-600 hover:text-white hover:border-purple-600 transition-all">
                            GET INTO CLASS →
                        </a>
                    <?php else: ?>
                        <button onclick="showWaitModal()" 
                                class="mt-auto block w-full text-center py-5 text-lg font-medium border-2 border-amber-400 bg-amber-50 text-amber-700 cursor-default">
                            Wait for Approval
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Wait for Approval Modal -->
<div id="waitModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 text-center">
        <i class="fa-solid fa-clock text-5xl text-amber-500 mb-6"></i>
        <h2 class="font-display text-3xl mb-3">Wait for Approval</h2>
        <p class="text-gray-600 mb-8">Your enrollment is under review.<br>Admin will approve it shortly.</p>
        <button onclick="hideWaitModal()" 
                class="px-10 py-4 bg-black text-white rounded-2xl font-medium hover:bg-zinc-800 transition">
            OK
        </button>
    </div>
</div>

<script>
function showWaitModal() {
    document.getElementById('waitModal').classList.remove('hidden');
}

function hideWaitModal() {
    document.getElementById('waitModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('waitModal').addEventListener('click', function(e) {
    if (e.target === this) hideWaitModal();
});
</script>