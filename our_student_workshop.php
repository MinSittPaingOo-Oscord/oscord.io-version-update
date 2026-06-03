<?php
// our_student_workshop.php - Student Final Project Showcase
// Minimalist black & white design matching welcome.php
// Scoped with ID #wc-student-workshop to prevent any CSS conflicts
// FIXED: Mobile video now fully clickable/touchable (aspect-ratio + pointer-events)
?>

<style>
    /* ── SCOPED STYLES (ID-based) ── */
    #wc-student-workshop * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    #wc-student-workshop {
        padding: 110px 40px;
        background: #fff;
    }

    /* Label & Heading reuse existing wc- styles + minor override for consistency */
    #wc-student-workshop .wc-label {
        font-family: 'Jost', sans-serif;
        font-size: 0.65rem;
        font-weight: 500;
        letter-spacing: 0.35em;
        color: #bbb;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 1.2rem;
    }

    #wc-student-workshop .wc-heading {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4.5vw, 3.4rem);
        font-weight: 300;
        text-align: center;
        color: #0a0a0a;
        line-height: 1.12;
        letter-spacing: -0.02em;
        margin-bottom: 70px;
    }

    /* Intro Burmese text */
    #wc-student-workshop .sws-intro {
        max-width: 820px;
        margin: 0 auto 60px;
        text-align: center;
    }

    #wc-student-workshop .sws-intro p {
        font-family: 'Jost', sans-serif;
        font-size: 1.08rem;
        line-height: 2.45;
        color: #444;
        margin-bottom: 1.8rem;
    }

    /* Student Info Highlight */
    #wc-student-workshop .sws-highlight {
        max-width: 860px;
        margin: 0 auto 70px;
        background: #fafafa;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 42px 48px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 32px;
        text-align: center;
    }

    #wc-student-workshop .sws-highlight-item {
        font-family: 'Jost', sans-serif;
    }

    #wc-student-workshop .sws-highlight-item strong {
        display: block;
        font-family: 'Playfair Display', serif;
        font-size: 1.35rem;
        font-weight: 300;
        color: #0a0a0a;
        margin-bottom: 6px;
        letter-spacing: -0.02em;
    }

    #wc-student-workshop .sws-highlight-item span {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
    }

    /* ── FIXED VIDEO CONTAINER (Mobile Clickable) ── */
    #wc-student-workshop .sws-video-wrapper {
        max-width: 960px;
        margin: 0 auto;
        position: relative;
        background: #0a0a0a;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(10, 10, 10, 0.08);
        aspect-ratio: 16 / 9;           /* Modern & reliable mobile fix */
    }

    #wc-student-workshop .sws-video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
        pointer-events: auto;           /* Ensures clicks/touches work on mobile */
    }

    #wc-student-workshop .sws-video-caption {
        text-align: center;
        margin-top: 24px;
        font-family: 'Jost', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.08em;
        color: #777;
        text-transform: uppercase;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        #wc-student-workshop {
            padding: 80px 20px;
        }
        #wc-student-workshop .sws-highlight {
            padding: 32px 24px;
            gap: 24px;
        }
    }
</style>

<!-- ──────────── STUDENT SHOWCASE SECTION ──────────── -->
<div id="wc-student-workshop">

    <div class="wc-label">Student Showcase</div>
    <h2 class="wc-heading">Proudly Showcasing Our Top Student’s<br>Final Project</h2>

    <div class="sws-intro">
        <p>
            နည်းပညာလောကထဲကို ယုံကြည်မှုရှိရှိ ခြေလှမ်းနိုင်ဖို့အတွက် 
            <strong style="font-weight:500; color:#0a0a0a;">𝐎𝐬𝐜𝐨𝐫𝐝 𝐂𝐨𝐝𝐞 𝐀𝐜𝐚𝐝𝐞𝐦𝐲</strong> 
            က အားလုံးနဲ့အတူ ရှိနေပါတယ်။
        </p>
        <p>
            ဒါလေးကတော့ Oscord Code Academy ရဲ့ Full Stack Developer Class ကို One on One တက်ရောက်သင်ကြားခဲ့တဲ့ 
            မောင်ဇွဲထက်အောင် ရဲ့သင်တန်းအပြီး Final Project လေးကို တင်ပြလိုက်တာပဲဖြစ်ပါတယ်။
        </p>
    </div>

    <!-- Student & Project Info -->
    <div class="sws-highlight">
        <div class="sws-highlight-item">
            <strong>Student Name</strong>
            <span>Zwe Htet Aung<br>(မောင်ဇွဲထက်အောင်)</span>
        </div>
        <div class="sws-highlight-item">
            <strong>Project Topic</strong>
            <span>Hotel Management &amp; Booking System</span>
        </div>
        <div class="sws-highlight-item">
            <strong>Course Enrolled</strong>
            <span>Full Stack Developer Class<br><em style="font-size:0.9rem; color:#0a0a0a;">(One on One)</em></span>
        </div>
    </div>

    <!-- FIXED Ready-made YouTube Video Player (Mobile Clickable) -->
    <div class="sws-video-wrapper">
        <iframe 
            src="https://www.youtube.com/embed/k2SC22SXyu8" 
            title="Zwe Htet Aung - Hotel Management &amp; Booking System Final Project" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
            loading="lazy"
            frameborder="0">
        </iframe>
    </div>

    <div class="sws-video-caption">
        Full Stack Developer Final Project Demo • Hotel Management &amp; Booking System
    </div>

</div>