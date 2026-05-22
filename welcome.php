<?php
// welcome.php - Refined Minimalist Black & White Design
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,300;0,400;1,300;1,400&family=Jost:wght@300;400;500&display=swap');

    .wc * { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── HERO ── */
    .wc-hero {
        background: #fff;
        min-height: 85vh;           /* Shortened from 100vh */
        display: grid;
        place-items: center;
        padding: 120px 40px 100px;  /* Reduced padding */
        position: relative;
        overflow: hidden;
    }
        .wc-hero::before {
            content: 'Since 2022';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Playfair Display', serif;
            font-size: clamp(80px, 15vw, 170px);   /* Slightly smaller because text is longer */
            font-weight: 300;
            color: #f0f0f0;
            letter-spacing: -0.05em;
            pointer-events: none;
            user-select: none;
            line-height: 1;
            opacity: 0.6;          /* Optional: make it a bit lighter if needed */
        }
    .wc-hero-inner {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 860px;
    }
    .wc-eyebrow {
        font-family: 'Jost', sans-serif;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.35em;
        color: #999;
        text-transform: uppercase;
        margin-bottom: 2rem;
    }
    .wc-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.8rem, 7vw, 5.5rem);
        line-height: 1.08;
        font-weight: 300;
        color: #0a0a0a;
        margin-bottom: 2rem;
        letter-spacing: -0.03em;
    }
    .wc-hero h1 em {
        font-style: italic;
        color: #444;
    }
    .wc-hero-desc {
        font-family: 'Jost', sans-serif;
        font-size: 1.05rem;
        line-height: 2.45;           /* Increased Burmese line spacing */
        color: #555;
        margin-bottom: 3rem;
    }
    .wc-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 40px;
        background: #0a0a0a;
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        text-decoration: none;
        border: 1px solid #0a0a0a;
        transition: all 0.35s ease;
    }
    .wc-btn:hover {
        background: transparent;
        color: #0a0a0a;
    }
    .wc-btn-arrow {
        transition: transform 0.35s ease;
    }
    .wc-btn:hover .wc-btn-arrow {
        transform: translateX(5px);
    }

    /* ── DIVIDER ── */
    .wc-divider {
        border: none;
        border-top: 1px solid #e8e8e8;
        margin: 0;
    }

    /* ── SECTION ── */
    .wc-section {
        padding: 110px 40px;
    }
    .wc-label {
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem;
        font-weight: 500;
        letter-spacing: 0.35em;
        color: #bbb;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 1.2rem;
    }
    .wc-heading {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4.5vw, 3.4rem);
        font-weight: 300;
        text-align: center;
        color: #0a0a0a;
        line-height: 1.12;
        letter-spacing: -0.02em;
        margin-bottom: 70px;
    }
    .wc-heading em { font-style: italic; color: #555; }

    /* ── INTRO ── */
    .wc-intro-inner {
        max-width: 720px;
        margin: 0 auto;
        text-align: center;
    }
    .wc-intro-inner p {
        font-family: 'Jost', sans-serif;
        font-size: 1.08rem;
        line-height: 2.45;           /* Increased Burmese line spacing */
        color: #444;
    }
    .wc-intro-inner p + p {
        margin-top: 1.5rem;
        font-size: 1rem;
        font-weight: 500;
        color: #0a0a0a;
    }

    /* ── BENEFITS ── */
    .wc-benefits-bg {
        background: #fafafa;
        border-top: 1px solid #ebebeb;
        border-bottom: 1px solid #ebebeb;
    }
    .wc-benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 0;
        max-width: 1100px;
        margin: 0 auto;
        border: 1px solid #e5e5e5;
    }
    .wc-benefit-item {
        padding: 40px 36px;
        border-right: 1px solid #e5e5e5;
        border-bottom: 1px solid #e5e5e5;
        transition: background 0.3s ease;
    }
    .wc-benefit-item:hover { background: #fff; }
    .wc-benefit-check {
        width: 32px;
        height: 32px;
        border: 1px solid #0a0a0a;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .wc-benefit-item p {
        font-family: 'Jost', sans-serif;
        font-size: 0.96rem;
        line-height: 2.45;           /* Increased Burmese line spacing */
        color: #444;
    }

    /* ── LEARNING SYSTEMS ── */
    .wc-systems-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 2px;
        max-width: 1200px;
        margin: 0 auto;
        background: #e0e0e0;
    }
    .wc-sys-card {
        background: #fff;
        padding: 44px 36px;
        transition: background 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .wc-sys-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 0; height: 2px;
        background: #0a0a0a;
        transition: width 0.4s ease;
    }
    .wc-sys-card:hover { background: #f8f8f8; }
    .wc-sys-card:hover::after { width: 100%; }
    .wc-sys-num {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 300;
        color: #ebebeb;
        line-height: 1;
        margin-bottom: 20px;
        letter-spacing: -0.04em;
    }
    .wc-sys-tag {
        font-family: 'Jost', sans-serif;
        font-size: 0.6rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: #bbb;
        margin-bottom: 10px;
    }
    .wc-sys-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 300;
        color: #0a0a0a;
        line-height: 1.3;
        margin-bottom: 18px;
        letter-spacing: -0.01em;
    }
    .wc-sys-card p {
        font-family: 'Jost', sans-serif;
        font-size: 0.92rem;
        line-height: 2.45;           /* Increased Burmese line spacing */
        color: #666;
    }

</style>

<!-- ──────────── HERO ──────────── -->
<div class="wc wc-hero">
    <div class="wc-hero-inner">
        <div class="wc-eyebrow">Est. Oscord Code Academy</div>
        <h1>Learn to Build<br><em>Exceptional Software</em></h1>
        <p class="wc-hero-desc">
            Programming, Software Development နှင့် Computer Science ဘာသာရပ်များကို<br>
            အခြေခံမှ အဆင့်မြင့် Application Development အထိ သင်ကြားပေးနေပါသည်။
        </p>
        <a class="wc-btn" href="courses.php">
            Browse Our Courses
            <span class="wc-btn-arrow">→</span>
        </a>
    </div>
</div>

<?php include './our_impact.php'; ?>

<hr class="wc-divider">

<!-- ──────────── INTRO ──────────── -->
<div class="wc wc-section" style="background:#fff;">
    <div class="wc-intro-inner">
        <div class="wc-label">About Us</div>
        <p>
            Oscord မှာ Programming, Software Development နှင့် Computer Science ဘာသာရပ် သင်တန်းတွေကို
            အခြေခံမှစ၍ Application Development Level အထိ ဆရာများဖြင့် တစ်ဦးတည်းသီးသန့်အတန်းများ၊
            အဖွဲ့လိုက် Zoom အတန်များ၊ Teach Yourself with Video Lectures အတန်းများဖြင့် သင်ကြားပေးနေပါတယ်။
        </p>
        <p>
            နမူနာသင်ခန်းစာများကိုလည်း website ရှိ သက်ဆိုင်ရာ course အောက်မှာ ဝင်ရောက်လေ့လာနိုင်ပါတယ်။
        </p>
    </div>
</div>

<hr class="wc-divider">
<?php include './course_horizontal.php'; ?>
<?php include './our_review.php'; ?>


<!-- ──────────── BENEFITS ──────────── -->
<div class="wc wc-section wc-benefits-bg">
    <div class="wc-label">Why Choose Us</div>
    <h2 class="wc-heading">By One အတန်းတက်ရခြင်းရဲ့<br><br>အကျိုးကျေးဇူး</h2>

    <div class="wc-benefits-grid">
        <div class="wc-benefit-item">
            <div class="wc-benefit-check">✓</div>
            <p>ဆရာနဲ့တစ်ဦးတည်းသီးသန့်သင်ရတာဖြစ်တဲ့အတွက် အတန်းချိန်အတွင်းမှာ ဆရာ့ရဲ့ဂရုစိုက်မူကို အပြည့်အဝ ခံစားရမယ်</p>
        </div>
        <div class="wc-benefit-item">
            <div class="wc-benefit-check">✓</div>
            <p>Course ထဲမှာမပါတဲ့ အခြားသင်ခန်းစာထဲကဖြစ်ဖြစ် သိလိုတာ သင်လိုတာရှိရင် ဆရာ့ကိုတန်းမေးလိုရတယ်</p>
        </div>
        <div class="wc-benefit-item">
            <div class="wc-benefit-check">✓</div>
            <p>အဖွဲနဲ့သင်ရတာမဟုတ်တဲ့အတွက် ဘယ်သူ့မှ အားနာစရာမလိုဘူး</p>
        </div>
        <div class="wc-benefit-item">
            <div class="wc-benefit-check">✓</div>
            <p>အတန်းနားချင်ရင်လည်း ဆရာ့ကိုပြောပြီး ပိတ်ရက်ယူလိုရတယ်၊ စာနောက်ကျသွားတာမျိုးလည်းမရှိဖူး</p>
        </div>
        <div class="wc-benefit-item">
            <div class="wc-benefit-check">✓</div>
            <p>By One အတန်းတိုင်းအတွက် အတန်းချိန်များ ညှိနှိင်းပေးတယ်</p>
        </div>
        <div class="wc-benefit-item">
            <div class="wc-benefit-check">✓</div>
            <p>မြန်မာ၊ ထိုင်း၊ ကိုရီးယား၊ ဂျပန်၊ စင်ကာပူ နဲ့ အနောက်တိုင်းနိုင်ငံများမှ ကျောင်းသားများအတွက်လည်း Time Zone ညှိပေးပါသည်</p>
        </div>
    </div>
</div>

<hr class="wc-divider">

<!-- ──────────── LEARNING SYSTEMS ──────────── -->
<div class="wc wc-section" style="background:#fff;">
    <div class="wc-label">How We Teach</div>
    <h2 class="wc-heading">Our Learning<br><em>Systems</em></h2>

    <div class="wc-systems-grid">
        <div class="wc-sys-card">
            <div class="wc-sys-num">01</div>
            <div class="wc-sys-tag">Learning System — One</div>
            <h3>Teach Yourself with Video Lectures</h3>
            <p>Video Lecture များဖြင့် မိမိကိုယ်တိုင်သင်ယူရမှာဖြစ်ပါတယ်။ နားမလည်တာရှိရင် ဆရာနဲ့ By One Zoom ချိန် ၇–၈ ကြိမ်အထိ ရရှိနိုင်ပါတယ်။</p>
        </div>
        <div class="wc-sys-card">
            <div class="wc-sys-num">02</div>
            <div class="wc-sys-tag">Learning System — Two</div>
            <h3>Video Lectures + Weekly Zoom</h3>
            <p>Video Lectures နဲ့ Zoom Class နှစ်မျိုးလုံးပါဝင်ပါသည်။ အပတ်စဉ် ၂ နာရီ တစ်ဦးတည်း Zoom ရှိပြီး နားမလည်တာတွေ ပြန်မေးနိုင်ပါတယ်။</p>
        </div>
        <div class="wc-sys-card">
            <div class="wc-sys-num">03</div>
            <div class="wc-sys-tag">Learning System — Three</div>
            <h3>By Group — Zoom Class</h3>
            <p>အဖွဲ့လိုက် အွန်လိုင်း Zoom တန်းများ။ အတန်းစရက်နှင့် အချိန်ကို Website သို့မဟုတ် Facebook Messenger မှ စုံစမ်းနိုင်ပါသည်။</p>
        </div>
        <div class="wc-sys-card">
            <div class="wc-sys-num">04</div>
            <div class="wc-sys-tag">Learning System — Four</div>
            <h3>VIP By One — Online Class</h3>
            <p>တစ်ဦးတည်း VIP Zoom တန်း။ အချိန်ညှိနိုင်ပြီး သူငယ်ချင်း ၂ ဦးအထက် ပူးတွဲတက်ရင် Promotion ရရှိနိုင်ပါသည်။</p>
        </div>
        <div class="wc-sys-card">
            <div class="wc-sys-num">05</div>
            <div class="wc-sys-tag">Learning System — Five</div>
            <h3>Face to Face — By One Class</h3>
            <p>ဘန်ကောက်တွင် တွေ့ဆုံသင်ကြားနိုင်ပါသည်။ သူငယ်ချင်း ၂ ဦးအထက် ပူးတွဲတက်ရင် ၂၀% လျှော့ပေးပါသည်။</p>
        </div>
    </div>
</div>