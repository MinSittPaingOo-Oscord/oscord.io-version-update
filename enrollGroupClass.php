<?php
session_start();
require_once 'includes/auth.php';
requireLogin();                 

$batchID = isset($_GET['batchID']) ? (int)$_GET['batchID'] : 0;
$batch = null;
$studentID = null;
$error = '';
$success = '';

$conn = $GLOBALS['conn'] ?? null;

if ($batchID > 0 && $conn) {
    $stmt = mysqli_prepare($conn, "
        SELECT b.*, c.name AS course_name, c.fee 
        FROM batch b 
        JOIN course c ON b.courseID = c.id 
        WHERE b.id = ? LIMIT 1
    ");
    mysqli_stmt_bind_param($stmt, "i", $batchID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res && mysqli_num_rows($res) > 0) {
        $batch = mysqli_fetch_assoc($res);
    }
    mysqli_stmt_close($stmt);

    if (isset($_SESSION['accountID'])) {
        $accountID = (int)$_SESSION['accountID'];
        $stuRes = mysqli_query($conn, "SELECT id FROM student WHERE accountID = $accountID LIMIT 1");
        if ($stuRes && mysqli_num_rows($stuRes) > 0) {
            $student = mysqli_fetch_assoc($stuRes);
            $studentID = (int)$student['id'];
        }
    }
}

if (!$batch || !$studentID) {
    $error = "Unable to load batch information. Please make sure you are logged in.";
}

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $studentID && $batch) {
    $agree = isset($_POST['agree']) && $_POST['agree'] === '1';

    if (!$agree) {
        $error = "You must agree to the Terms and Conditions.";
    } else {
        $stmt = mysqli_prepare($conn, "
            INSERT INTO group_class_enrollment (studentID, batchID, enrollDateTime,status,isApprove)
            VALUES (?, ?, NOW(),'ENROLLED',0)
        ");
        mysqli_stmt_bind_param($stmt, "ii", $studentID, $batchID);

        if (mysqli_stmt_execute($stmt)) {
            $success = "✅ Enrollment request submitted successfully!";
        } else {
            $error = "Database error. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Group Class - Oscord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root { --ink: #1A1612; --gold: #C9A84C; }
        body { margin:0; padding:0; font-family:'DM Sans', sans-serif; background:var(--cream); }
        .font-display { font-family:'Cormorant Garamond', serif; }
        
        .qr-container {
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .terms-content {
            max-height: 480px;
            overflow-y: auto;
            line-height: 1.85;
        }
    </style>
</head>
<body>

<?php include './nav.php'; ?>

<div class="max-w-4xl mx-auto px-6 py-12">

    <?php if ($success): ?>
        <div class="max-w-lg mx-auto text-center py-20">
            <div class="text-green-600 text-6xl mb-6">✓</div>
            <h1 class="font-display text-4xl mb-4">Enrollment Successful!</h1>
            <p class="text-lg text-gray-600"><?= $success ?></p>
            <a href="batches.php" class="mt-8 inline-block px-10 py-4 bg-black text-white rounded-full font-medium">Back to Batches</a>
        </div>
    <?php else: ?>

    <div class="mb-10">
        <a href="batches.php" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-black">
            ← Back to Batches
        </a>
    </div>

    <h1 class="font-display text-5xl tracking-tight mb-2">Batch <?= $batch['batchNumber'] ?? '' ?> Enrollment</h1>
    <p class="text-xl text-gray-600"><?= htmlspecialchars($batch['course_name'] ?? '') ?></p>

    <?php if ($error): ?>
        <div class="mt-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="mt-10 space-y-12">

        <!-- Batch Info -->
        <div class="bg-white rounded-3xl p-8 border">
            <h2 class="font-display text-3xl mb-6">Batch Details</h2>
            <div class="grid md:grid-cols-2 gap-8 text-sm">
                <div>
                    <p class="text-gold uppercase tracking-widest text-xs mb-1">Schedule</p>
                    <p><?= nl2br(htmlspecialchars($batch['schedule'] ?? '')) ?></p>
                </div>
                <div>
                    <p class="text-gold uppercase tracking-widest text-xs mb-1">Dates</p>
                    <p>Start: <strong><?= date('d M Y', strtotime($batch['startDate'])) ?></strong></p>
                    <p>End: <strong><?= date('d M Y', strtotime($batch['endDate'])) ?></strong></p>
                </div>
            </div>
        </div>

        <!-- Price -->
        <div class="bg-white rounded-3xl p-8 border">
            <h2 class="font-display text-3xl mb-4">Group Class Fee</h2>
            <div class="flex items-baseline gap-3">
                <span class="text-5xl font-light"><?= number_format(($batch['fee'] ?? 0) * 0.8) ?></span>
                <span class="text-2xl">MMK</span>
                <span class="text-emerald-600 font-medium">(20% OFF)</span>
            </div>
        </div>

        <!-- KPay -->
        <div class="bg-white rounded-3xl p-8 border">
            <h2 class="font-display text-3xl mb-6">Payment via KPay</h2>
            
            <div class="qr-container mx-auto max-w-[260px]">
                <p class="text-center text-xs tracking-widest text-gold mb-4">SCAN QR CODE</p>
                <img src="./image/KPaySca2.jpg" alt="KPay QR Code" class="w-full rounded-2xl">
            </div>

            <div class="mt-8 grid md:grid-cols-2 gap-8 text-center md:text-left">
                <div>
                    <p class="text-xs text-gold tracking-widest">KPay NUMBER</p>
                    <p class="text-3xl font-medium">+959259662272</p>
                </div>
                <div>
                    <p class="text-xs text-gold tracking-widest">ACCOUNT NAME</p>
                    <p class="text-3xl font-medium">Lin Khant Min Maung</p>
                </div>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="bg-white rounded-3xl p-8 border">
            <h2 class="font-display text-3xl mb-6 text-center">သင်တန်းစည်းကမ်းများနှင့် သတ်မှတ်ချက်များ</h2>
            <div class="terms-content bg-[#FAF7F0] p-8 rounded-2xl text-[15px] leading-relaxed border">
               


                <p class="mb-6">ကျောင်းသားများသည် သင်တန်းကြေးကို အတန်းစမမှီနှင့် အတန်းစပြီး 2 ပတ်ခန့်အတွင်း အဆင်ပြေတဲ့အချိန်မှာ ပေးသွင်းထားလိုရပါတယ်။</p>
                 <p class="mb-6"> သင်တန်းကြေးပေးသွင်းပြီးပါက သင်တန်းမတတ်ဖြစ်တော့သည်ဖြစ်စေ မည်သည့်အကြောင်းကြောင့်မှ ပြန်လည် Refund ပေးအပ်မည်မဟုတ်ပါ။ </p>
                 <p class="mb-6"> ကျောင်းသားများသည် Payment Successful ဖြစ်ပါက Admin မှ Approve ပေးမှာဖြစ်ပြီး သင်ခန်းစာများကို www.oscord.io website ရဲ့ သက်ဆိုင်ရာ Course အောက်မှာ ဝင်ရောက်လေ့လာလိုရပါပြီ။  </p>
                <ul class="list-disc pl-6 space-y-4 mb-8">
                    <li>Payment Successful ဖြစ်မှအတန်းစမည်မဟုတ်ပါ</li>
                    <li>အတန်းစရန်ညှိနှိင်းထားသော သိုမဟုတ် ထုတ်ပြန်ထားသောအချိန်တွင် အတန်းစပေးမှာဖြစ်ပါတယ်</li>
                    <li>သိုသော် Admin Approve ဖြစ်မှသာ Website မှသင်ခန်းစာများကို ဝင်ရောက်လေ့လာလိုရပါမယ်</li>
                    
                </ul>

                <p class="font-semibold text-lg mb-4">သင်တန်းစည်းကမ်းများ</p>
                <ul class="list-disc pl-6 space-y-4">
                    <li>Zoom meeting ချိန်အတွင်း အသံ Mute ထားလိုမရပါဖူး</li>
                    <li>Telegram private channel, Google Classroom နှင့် Website ပေါ်တွင်ပေးထားသော သင်ခန်းစာ, Video record များကို မိမိတစ်ဦးတည်းသာဝင်ရောက်ပီး လေ့လာလိုရပါမယ်။ မည်သူတစ်ဦးတစ်ယောက်ကိုမှ မျှဝေခြင်းကိုခွင့်မပြုပါ။</li>
                    <li>အကယ်၍တွေ့ရှိပါက သင်တန်းမှအပြီးတိုင်ထုတ်ပယ်သွားမှာဖြစ်ပြီး ပေးသွင်းပြီးသင်တန်းကြေးအား ပြန်လည် Refund ပေးအပ်မည်မဟုတ်ပါ။</li>
                    <li>အတန်းစမည့်အချိန်မှာ အမြဲတမ်း Zoom ID & passcode သိုမဟုတ် Meeting Link ပိုပေးသွားမှာဖြစ်ပြီး 10 minutes အတွင်းဝင်ရောက်လာခြင်းမရှိပါက ပျက်ကွက်သည်ဟုယူဆမှာဖြစ်ပါတယ်။</li>
                </ul>
            </div>

            <div class="flex items-start gap-4 mt-8">
                <input type="checkbox" id="agree" name="agree" value="1" class="mt-1 w-5 h-5 accent-black">
                <label for="agree" class="text-sm leading-tight cursor-pointer">
                    အထက်ပါ သင်တန်းစည်းကမ်းများနှင့် သတ်မှတ်ချက်များကို ဖတ်ရှုပြီး လိုက်နာရန် သဘောတူပါသည်။ <span class="text-red-600">*</span>
                </label>
            </div>
        </div>

        <button type="submit" class="w-full py-6 text-lg font-medium bg-black text-white rounded-3xl hover:bg-zinc-800 transition">
            Submit Group Class Enrollment
        </button>
    </form>

    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!document.getElementById('agree').checked) {
            e.preventDefault();
            alert('Please agree to the Terms and Conditions');
        }
    });
</script>

</body>
</html>