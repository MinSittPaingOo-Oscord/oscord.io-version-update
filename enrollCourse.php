<?php
session_start();
require_once 'includes/auth.php';
include './nav.php';

$courseID = isset($_GET['courseID']) ? (int)$_GET['courseID'] : 0;
$course = null;
$studentID = null;
$error = '';
$success = '';

$conn = $GLOBALS['conn'] ?? null;

if ($courseID > 0 && $conn) {
    $res = mysqli_query($conn, "SELECT * FROM course WHERE id = $courseID LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $course = mysqli_fetch_assoc($res);
    }

    if (isset($_SESSION['accountID'])) {
        $accountID = (int)$_SESSION['accountID'];
        $stuRes = mysqli_query($conn, "SELECT id FROM student WHERE accountID = $accountID LIMIT 1");
        if ($stuRes && mysqli_num_rows($stuRes) > 0) {
            $student = mysqli_fetch_assoc($stuRes);
            $studentID = (int)$student['id'];
        }
    }
}

if (!$course || !$studentID) {
    $error = "Unable to load course or student information. Please make sure you are logged in.";
}

// ── Handle form submission ─────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $studentID && $course) {
    $learningType = (int)($_POST['learningType'] ?? 0);
    $agree        = isset($_POST['agree']) && $_POST['agree'] === '1';

    $validTypes = [1, 2, 3, 4, 5];

    if (!in_array($learningType, $validTypes)) {
        $error = "Please select a valid learning path.";
    } elseif (!$agree) {
        $error = "You must agree to the Terms and Conditions to enroll.";
    } else {
        // Insert with correct integer learningType + timestamp
        $stmt = mysqli_prepare($conn, "
            INSERT INTO enrollment 
            (studentID, courseID, learningType, isApprove, isComplete, grade, enrollDateTime,status)
            VALUES (?, ?, ?, 0, 0, NULL, NOW(),'ENROLLED')
        ");

        mysqli_stmt_bind_param($stmt, "iii", $studentID, $courseID, $learningType);

        if (mysqli_stmt_execute($stmt)) {
            $success = "✅ Enrollment request submitted successfully!<br>You will receive approval after payment confirmation.";
        } else {
            $error = "Database error. Please try again later.";
        }
    }
}

// Learning paths with correct database IDs
$learningOptions = [
    ['value' => 1, 'label' => 'Video Lectures Only',       'multi' => 0.2,  'desc' => '80% OFF · Self-paced'],
    ['value' => 4, 'label' => 'Video + Zoom By One',      'multi' => 0.5,  'desc' => '50% OFF · Live support'],
    ['value' => 2, 'label' => 'VIP By One Class',         'multi' => 1.0,  'desc' => '1-on-1 private'],
    ['value' => 5, 'label' => 'Face to Face Bangkok',     'multi' => 2.0,  'desc' => 'In-person class'],
];

$baseFee = $course['fee'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll — <?= htmlspecialchars($course['name'] ?? 'Course') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --cream: #F7F3EE; --ink: #1A1612; --gold: #C9A84C;
            --gold-light: #E8D5A3; --rust: #9B4F2E; --muted: #7A7068;
            --border: #D9D0C5; --green: #1A6B3A;
        }
        * { box-sizing: border-box; }
        body {
            background-color: var(--cream);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
        }
        .font-display { font-family: 'Cormorant Garamond', serif; }

        .learning-card {
            transition: all 0.3s cubic-bezier(0.22,1,0.36,1);
        }
        .learning-card:hover { transform: translateY(-4px); box-shadow: 0 20px 60px rgba(201,168,76,0.15); }
        .learning-card.selected {
            border-color: var(--gold);
            background: #FEFBF0;
            box-shadow: 0 0 0 4px rgba(201,168,76,0.25);
        }
        .price-big { font-size: 2.25rem; font-weight: 300; line-height: 1; }
        .form-section {
            background: white;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
        }
        .terms-content {
            max-height: 460px;
            overflow-y: auto;
            line-height: 1.85;
            font-size: 15.5px;
        }
        .terms-content::-webkit-scrollbar { width: 6px; }
        .terms-content::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 20px; }
        /* Fix extra space under footer */
        body {
            background: var(--cream);
        }

        #oscord-footer {
            margin-top: 0 !important;
            padding-top: 40px;
        }

        #oscord-footer footer {
            padding-bottom: 30px;
        }
    </style>
</head>
<body class="bg-[var(--cream)] pb-0">

<?php if ($success): ?>
    <div style="max-width:720px;margin:6rem auto 4rem;padding:3rem 2rem;background:white;border-radius:28px;text-align:center;box-shadow:0 30px 80px rgba(26,22,18,0.1);">
        <div class="mx-auto w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
            <svg width="48" height="48" fill="none" stroke="#1A6B3A" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7"/></svg>
        </div>
        <h1 class="font-display text-4xl mb-3">Enrollment Successful!</h1>
        <p class="text-lg text-muted mb-8"><?= $success ?></p>
        <a href="specificCourse.php?courseID=<?= $courseID ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-[var(--ink)] text-white rounded-full font-medium hover:bg-black transition-all">← Back to Course</a>
    </div>
<?php else: ?>

<div style="max-width:1100px;margin:0 auto;padding:4rem 1.5rem 1rem;">

    <?php if ($error): ?>
        <div class="max-w-2xl mx-auto mb-8 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl text-center">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="flex justify-between items-baseline mb-8">
        <div>
            <span class="section-label text-gold">ENROLLMENT</span>
            <h1 class="font-display text-5xl tracking-[-1px]"><?= htmlspecialchars($course['name'] ?? 'Course Enrollment') ?></h1>
        </div>
        <a href="specificCourse.php?courseID=<?= $courseID ?>" class="text-muted hover:text-ink flex items-center gap-2">← Back to course</a>
    </div>

    <form id="enrollForm" method="POST" class="space-y-10">

        <!-- LEARNING PATH SELECTION -->
        <div class="form-section">
            <h2 class="font-display text-3xl mb-6">Choose Your Learning Path</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="path-grid">
                <?php foreach ($learningOptions as $option): 
                    $price = number_format($baseFee * $option['multi']);
                ?>
                <label class="learning-card border-2 border-transparent rounded-3xl p-6 cursor-pointer flex flex-col" data-value="<?= $option['value'] ?>">
                    <input type="radio" name="learningType" value="<?= $option['value'] ?>" class="peer hidden">
                    <div class="flex-1">
                        <div class="text-gold font-medium text-sm tracking-widest mb-1"><?= $option['desc'] ?></div>
                        <h3 class="text-2xl font-light mb-4"><?= htmlspecialchars($option['label']) ?></h3>
                        <div class="price-big"><?= $price ?> <span class="text-xl text-muted">MMK</span></div>
                    </div>
                    <div class="text-xs text-gold mt-8 flex justify-end">
                        <span class="px-5 py-1 bg-gold/10 rounded-full">SELECT</span>
                    </div>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- PAYMENT SECTION -->
        <div class="form-section">
            <h2 class="font-display text-3xl mb-6">Payment via KPay</h2>
            <p class="text-muted mb-8">Please transfer the exact amount for your chosen learning path to the KPay account below.</p>
            <div class="flex flex-col lg:flex-row gap-12 items-start">
                <div class="flex-shrink-0">
                    <p class="uppercase text-xs tracking-[1px] text-gold mb-3">SCAN QR CODE</p>
                    <div class="w-64 h-64 border-4 border-gold rounded-3xl bg-[#FEFBF0] flex items-center justify-center overflow-hidden">
                        <img src ='./image/KPayScan.jpg'>
                    </div>
                </div>
                <div class="flex-1 space-y-8">
                    <div>
                        <div class="text-xs uppercase tracking-widest text-gold mb-2">KPay Phone Number</div>
                        <div class="text-3xl font-medium">09791303803</div>
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-widest text-gold mb-2">Account Name</div>
                        <div class="text-3xl font-medium">Min Sitt Paing Oo</div>
                    </div>
                    <p class="text-sm text-muted max-w-xs">After payment, please keep the transaction receipt / screenshot as proof for verification.</p>
                </div>
            </div>
        </div>

        <!-- TERMS & CONDITIONS -->
        <div class="form-section">
            <h2 class="font-display text-3xl mb-6 text-center">သင်တန်းစည်းကမ်းများနှင့် သတ်မှတ်ချက်များ</h2>
            <div class="terms-content bg-[#FAF7F0] border border-[var(--border)] rounded-3xl p-8 mb-8 text-[15.5px]">
                <!-- (Burmese text remains exactly the same as before) -->
                <p class="mb-6">သင်တန်းကြေးပေးသွင်းပြီးပါက သင်တန်းမတတ်ဖြစ်တော့သည်ဖြစ်စေ မည်သည့်အကြောင်းကြောင့်မှ ပြန်လည် Refund ပေးအပ်မည်မဟုတ်ပါ။</p>
                <p class="mb-6">Video Lectures Only အတန်းမှ ကျောင်းသားများသည် Payment Successful ဖြစ်ပါက Admin မှ Approve ပေးမှာဖြစ်ပြီး သင်ခန်းစာများကို www.oscord.io website ရဲ့ သက်ဆိုင်ရာ Course အောက်မှာ ဝင်ရောက်လေ့လာလိုရပါပြီ။</p>
                <p class="mb-6">Video Lectures Only အတန်းများ မှမဟုတ်သော ကျောင်းသားများသည်လည်း Website မှ Video Lectures များကို Lifetime access ရမှာဖြစ်ပါတယ်။ Video Lectures အတန်းများ မှမဟုတ်သော ကျောင်းသားများသည် သင်တန်းကြေးကို အတန်းစမမှီနှင့် အတန်းစပြီး 2 ပတ်ခန့်အတွင်း အဆင်ပြေတဲ့အချိန်မှာ ပေးသွင်းထားလိုရပါတယ်။</p>
                <ul class="list-disc pl-6 space-y-4 mb-8">
                    <li>Payment Successful ဖြစ်မှအတန်းစမည်မဟုတ်ပါ</li>
                    <li>အတန်းစရန်ညှိနှိင်းထားသော သိုမဟုတ် ထုတ်ပြန်ထားသောအချိန်တွင် အတန်းစပေးမှာဖြစ်ပါတယ်</li>
                    <li>သိုသော် Admin Approve ဖြစ်မှသာ Website မှသင်ခန်းစာများကို ဝင်ရောက်လေ့လာလိုရပါမယ်</li>
                    <li>သင်တန်းကာလ 2 ပတ်ခန့်ကျော်လွန်ပြီး Payment Successful မဖြစ်သေးပါက အတန်းအားရပ်တန့်လိုက်မှာဖြစ်ပါတယ်</li>
                    <li>Payment Successful ဖြစ်ပြီးမှသာ အတန်းအားဆက်လက် Continue လုပ်မှာဖြစ်ပါတယ်</li>
                    <li>Payment Successful မဖြစ်သေးဘဲ သင်တန်းကာလ 2 ပတ်အပြီး သင်တန်းအား ဆက်လက်မတက်ရောက်ဖြစ်တော့ပါက ပြီးခဲ့သော အတန်းချိန်များအတွက် သက်ဆိုင်ရာ Course မှ သက်ဆိုင်ရာ Learning Type ရဲ့ သင်တန်းကြေးမှ 10% ကိုပေးသွင်းရမှာဖြစ်ပါတယ်</li>
                </ul>
                <p class="font-semibold text-lg mb-4">သင်တန်းစည်းကမ်းများ</p>
                <ul class="list-disc pl-6 space-y-4">
                    <li>Zoom meeting ချိန်အတွင်း အသံ Mute ထားလိုမရပါဖူး</li>
                    <li>Telegram private channel, Google Classroom နှင့် Website ပေါ်တွင်ပေးထားသော သင်ခန်းစာ, Video record များကို မိမိတစ်ဦးတည်းသာဝင်ရောက်ပီး လေ့လာလိုရပါမယ်။ မည်သူတစ်ဦးတစ်ယောက်ကိုမှ မျှဝေခြင်းကိုခွင့်မပြုပါ။</li>
                    <li>အကယ်၍တွေ့ရှိပါက သင်တန်းမှအပြီးတိုင်ထုတ်ပယ်သွားမှာဖြစ်ပြီး ပေးသွင်းပြီးသင်တန်းကြေးအား ပြန်လည် Refund ပေးအပ်မည်မဟုတ်ပါ။</li>
                    <li>အတန်းစမည့်အချိန်မှာ အမြဲတမ်း Zoom ID & passcode သိုမဟုတ် Meeting Link ပိုပေးသွားမှာဖြစ်ပြီး 20 minutes အတွင်းဝင်ရောက်လာခြင်းမရှိပါက ပျက်ကွက်သည်ဟုယူဆပြီး Meeting အားရုတ်သိမ်းမှာဖြစ်ပါတယ်။</li>
                </ul>
            </div>

            <div class="flex items-start gap-4">
                <input type="checkbox" id="agree" name="agree" value="1" class="mt-1 w-6 h-6 accent-gold cursor-pointer">
                <label for="agree" class="cursor-pointer text-[15.5px] leading-tight font-medium">
                    အထက်ပါ သင်တန်းစည်းကမ်းများနှင့် သတ်မှတ်ချက်များကို ဖတ်ရှုပြီး လိုက်နာရန် သဘောတူပါသည်။ <span class="text-red-600">*</span>
                </label>
            </div>
        </div>

        <button type="submit" class="w-full py-6 text-lg font-medium bg-[var(--ink)] hover:bg-black text-white rounded-3xl transition-all disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn">
            Submit Enrollment &amp; Pay
        </button>
    </form>
</div>

<?php endif; ?>

<script>
    document.querySelectorAll('.learning-card').forEach(card => {
        card.addEventListener('click', function () {
            document.querySelectorAll('.learning-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    const form = document.getElementById('enrollForm');
    form.addEventListener('submit', function (e) {
        const selected = document.querySelector('input[name="learningType"]:checked');
        const agreed   = document.getElementById('agree').checked;
        if (!selected) {
            e.preventDefault();
            alert('⚠️ Please select a learning path.');
            return;
        }
        if (!agreed) {
            e.preventDefault();
            alert('⚠️ သင်တန်းစည်းကမ်းများနှင့် သတ်မှတ်ချက်များကို လိုက်နာရန် သဘောတူရမည်ဖြစ်ပါသည်။');
            return;
        }
    });
</script>

<?php include 'footer.php'; ?>
</body>
</html>