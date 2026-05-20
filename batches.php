<?php
session_start();
require_once 'includes/connectdb.php';
require_once 'includes/auth.php';
include 'nav.php';

// Check login
$isLoggedIn = isset($_SESSION['accountID']);
$studentID = null;

if ($isLoggedIn) {
    $accountID = (int)$_SESSION['accountID'];
    $res = mysqli_query($GLOBALS['conn'], "SELECT id FROM student WHERE accountID = $accountID LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $studentID = (int)mysqli_fetch_assoc($res)['id'];
    }
}

// Fetch batches
$batches = [];
$conn = $GLOBALS['conn'] ?? null;

if ($conn) {
    $query = "
        SELECT b.*, c.name AS course_name, c.fee
        FROM batch b
        JOIN course c ON b.courseID = c.id
        ORDER BY b.courseID ASC, b.batchNumber ASC
    ";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $enrolled = false;
        if ($studentID) {
            $check = mysqli_query($conn, "
                SELECT id FROM group_class_enrollment 
                WHERE studentID = $studentID AND batchID = " . (int)$row['id'] . " LIMIT 1
            ");
            $enrolled = mysqli_num_rows($check) > 0;
        }
        $row['isEnrolled'] = $enrolled;
        $batches[] = $row;
    }
}
?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-white-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-16">
        
        <div class="mb-12">
            <h1 class="text-5xl md:text-6xl font-light tracking-[-2.5px]">Group Classes</h1>
            <p class="mt-4 text-xl text-zinc-600">Join live batches with expert instructors</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($batches as $batch): ?>
                <?php 
                $isEnrolled = $batch['isEnrolled'];
                $buttonText = $isEnrolled ? "Already Enrolled" : "Enroll Now";
                $buttonBg   = $isEnrolled ? "bg-emerald-600" : "bg-black hover:bg-zinc-800";
                $statusColor = $batch['status'] === 'In Progress' ? 'text-emerald-600' : 
                              ($batch['status'] === 'Coming Soon' ? 'text-amber-600' : 'text-gray-500');
                ?>
                
                <div class="group bg-white border border-black/10 rounded-3xl overflow-hidden hover:border-black hover:shadow-2xl transition-all duration-300 flex flex-col h-full">
                    <div class="h-56 bg-gradient-to-br from-zinc-900 to-black relative flex items-center justify-center">
                        <div class="text-center text-white">
                            <div class="text-5xl font-light">Batch <?= $batch['batchNumber'] ?></div>
                            <div class="text-sm opacity-70 mt-1"><?= htmlspecialchars($batch['course_name']) ?></div>
                        </div>
                    </div>

                    <div class="p-7 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-4 py-1 text-xs font-medium rounded-2xl <?= $statusColor ?> border border-current/30">
                                <?= htmlspecialchars($batch['status']) ?>
                            </span>
                            <span class="text-xs text-right">
                                <span class="block text-zinc-500">Seats Left</span>
                                <span class="font-semibold text-lg"><?= $batch['seat'] ?></span>
                            </span>
                        </div>

                        <div class="mb-6">
                            <p class="text-xs tracking-widest text-zinc-500 mb-1">SCHEDULE</p>
                            <p class="text-sm leading-relaxed"><?= nl2br(htmlspecialchars($batch['schedule'])) ?></p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 text-sm mb-8">
                            <div>
                                <p class="text-xs text-zinc-500">STARTS</p>
                                <p class="font-medium"><?= date('d M Y', strtotime($batch['startDate'])) ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500">ENDS</p>
                                <p class="font-medium"><?= date('d M Y', strtotime($batch['endDate'])) ?></p>
                            </div>
                        </div>

                        <?php if ($isEnrolled): ?>
                            <div class="mt-auto py-4 text-center text-emerald-600 font-medium bg-emerald-50 rounded-2xl">
                                ✓ Already Enrolled
                            </div>
                        <?php else: ?>
                            <button onclick="<?= $isLoggedIn ? "window.location.href='enrollGroupClass.php?batchID=".$batch['id']."'" : "showLoginModal()" ?>"
                                    class="mt-auto <?= $buttonBg ?> text-white text-center py-4 rounded-2xl font-medium transition-all hover:scale-[1.02]">
                                Enroll Now →
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($batches)): ?>
            <div class="text-center py-20 border-2 border-dashed border-black/30 rounded-3xl">
                <p class="text-2xl text-zinc-400">No batches available at the moment.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- Login Required Modal -->
<div id="loginModal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 text-center">
        <div class="w-16 h-16 mx-auto mb-6 bg-amber-100 rounded-2xl flex items-center justify-center">
            <i class="fa-solid fa-lock text-3xl text-amber-600"></i>
        </div>
        <h2 class="font-display text-3xl mb-3">Login Required</h2>
        <p class="text-gray-600 mb-8">You need to sign in to enroll in group classes.</p>
        
        <a href="profile.php" 
           class="block w-full py-4 bg-black text-white rounded-2xl font-medium hover:bg-zinc-800 transition">
            Sign In to Continue
        </a>
        <button onclick="hideLoginModal()" class="mt-4 text-gray-500 hover:text-black">Maybe later</button>
    </div>
</div>

<?php include './footer.php'; ?>

<script>
function showLoginModal() {
    document.getElementById('loginModal').classList.remove('hidden');
}

function hideLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
}

document.getElementById('loginModal').addEventListener('click', function(e) {
    if (e.target === this) hideLoginModal();
});
</script>

</body>
</html>