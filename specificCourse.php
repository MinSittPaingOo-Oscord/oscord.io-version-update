<?php
session_start();
require_once 'includes/auth.php';
include './nav.php';

$courseID = isset($_GET['courseID']) ? (int)$_GET['courseID'] : 0;
$course = null;
$courseDetails = [];

// ── Enrollment status logic ──────────────────────────────────────────────────
$isLoggedIn   = isset($_SESSION['accountID']);
$isEnrolled   = false;
$isApproved   = false;

if ($courseID > 0) {
    $conn = $GLOBALS['conn'] ?? null;
    if ($conn) {
        $res = mysqli_query($conn, "SELECT * FROM course WHERE id = $courseID LIMIT 1");
        if ($res && mysqli_num_rows($res) > 0) {
            $course = mysqli_fetch_assoc($res);
        }

        if ($course) {
            $detailRes = mysqli_query($conn, "
                SELECT name, sort 
                FROM course_detail 
                WHERE courseID = $courseID 
                ORDER BY sort ASC
            ");
            while ($row = mysqli_fetch_assoc($detailRes)) {
                $courseDetails[] = $row;
            }
        }

        // Check enrollment if user is logged in
        if ($isLoggedIn) {
            $accountID = (int)$_SESSION['accountID'];
            // Get studentID from accountID
            $stuRes = mysqli_query($conn, "SELECT id FROM student WHERE accountID = $accountID LIMIT 1");
            if ($stuRes && mysqli_num_rows($stuRes) > 0) {
                $student   = mysqli_fetch_assoc($stuRes);
                $studentID = (int)$student['id'];

                $enrRes = mysqli_query($conn, "
                    SELECT isApprove FROM enrollment 
                    WHERE studentID = $studentID AND courseID = $courseID 
                    LIMIT 1
                ");
                if ($enrRes && mysqli_num_rows($enrRes) > 0) {
                    $enrollment = mysqli_fetch_assoc($enrRes);
                    $isEnrolled = true;
                    $isApproved = ($enrollment['isApprove'] == 1);
                }
            }
        }
    }
}
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
  :root {
    --cream: #F7F3EE;
    --ink: #1A1612;
    --gold: #C9A84C;
    --gold-light: #E8D5A3;
    --rust: #9B4F2E;
    --muted: #7A7068;
    --border: #D9D0C5;
    --green: #1A6B3A;
    --green-light: #EEFAF3;
  }

  * { box-sizing: border-box; }

  body {
    background-color: var(--cream);
    color: var(--ink);
    font-family: 'DM Sans', sans-serif;
  }

  .font-display { font-family: 'Cormorant Garamond', serif; }

  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9999;
    opacity: 0.4;
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  @keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
  }
  @keyframes modalIn {
    from { opacity: 0; transform: translateY(32px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
  }
  @keyframes backdropIn {
    from { opacity: 0; }
    to   { opacity: 1; }
  }

  .fade-up   { animation: fadeUp 0.8s cubic-bezier(0.22,1,0.36,1) both; }
  .fade-up-2 { animation: fadeUp 0.8s 0.15s cubic-bezier(0.22,1,0.36,1) both; }
  .fade-up-3 { animation: fadeUp 0.8s 0.3s cubic-bezier(0.22,1,0.36,1) both; }
  .fade-up-4 { animation: fadeUp 0.8s 0.45s cubic-bezier(0.22,1,0.36,1) both; }
  .fade-in   { animation: fadeIn 1.2s 0.2s both; }

  /* ── CTA Buttons ──────────────────────────────────────────────── */
  .btn-base {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    padding: 0.9rem 2rem;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 500;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
    border: none;
    font-family: 'DM Sans', sans-serif;
    transition: all 0.28s cubic-bezier(0.22,1,0.36,1);
  }

  /* Learn Free — outlined gold */
  .btn-free {
    background: transparent;
    color: var(--gold);
    border: 1.5px solid var(--gold);
  }
  .btn-free:hover {
    background: var(--gold);
    color: #fff;
    box-shadow: 0 8px 32px rgba(201,168,76,0.28);
    transform: translateY(-2px);
  }
  .btn-free svg { transition: transform 0.25s; }
  .btn-free:hover svg { transform: translateX(3px); }

  /* Enroll — solid ink */
  .btn-enroll {
    background: var(--ink);
    color: var(--cream);
    border: 1.5px solid var(--ink);
  }
  .btn-enroll:hover {
    background: #2e2820;
    box-shadow: 0 10px 36px rgba(26,22,18,0.22);
    transform: translateY(-2px);
  }
  .btn-enroll svg { transition: transform 0.25s; }
  .btn-enroll:hover svg { transform: translateX(3px); }

  /* Continue Learning — solid green */
  .btn-continue {
    background: var(--green);
    color: #fff;
    border: 1.5px solid var(--green);
  }
  .btn-continue:hover {
    background: #155930;
    box-shadow: 0 10px 36px rgba(26,107,58,0.25);
    transform: translateY(-2px);
  }
  .btn-continue svg { transition: transform 0.25s; }
  .btn-continue:hover svg { transform: translateX(3px); }

  /* Pending approval badge */
  .badge-pending {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 999px;
    background: rgba(201,168,76,0.1);
    color: #7A5C10;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    border: 1.5px solid rgba(201,168,76,0.3);
  }

  /* CTA group row */
  .cta-group {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    flex-wrap: wrap;
    margin-top: 2.5rem;
  }

  /* ── Modal ────────────────────────────────────────────────────── */
  #login-modal-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(26,22,18,0.6);
    backdrop-filter: blur(7px);
    -webkit-backdrop-filter: blur(7px);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    animation: backdropIn 0.3s ease both;
  }
  #login-modal-backdrop.show { display: flex; }

  #login-modal {
    background: var(--cream);
    border-radius: 28px;
    padding: 3rem 2.5rem 2.5rem;
    max-width: 440px;
    width: 100%;
    position: relative;
    animation: modalIn 0.4s cubic-bezier(0.22,1,0.36,1) both;
    text-align: center;
    border: 1px solid var(--border);
    box-shadow: 0 40px 100px rgba(26,22,18,0.3);
  }

  .modal-close {
    position: absolute;
    top: 1.25rem;
    right: 1.25rem;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    background: rgba(26,22,18,0.06);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    transition: background 0.2s, color 0.2s;
  }
  .modal-close:hover { background: rgba(26,22,18,0.12); color: var(--ink); }

  .modal-icon {
    width: 5rem;
    height: 5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(201,168,76,0.15), rgba(201,168,76,0.05));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.75rem;
    border: 1.5px solid rgba(201,168,76,0.3);
  }

  .modal-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.2rem;
    font-weight: 400;
    color: var(--ink);
    margin: 0 0 0.75rem;
    line-height: 1.15;
  }

  .modal-body {
    font-size: 0.9rem;
    color: var(--muted);
    line-height: 1.75;
    margin: 0 0 2rem;
  }

  .modal-divider {
    height: 1px;
    background: var(--border);
    margin: 0 0 1.75rem;
  }

  .modal-btn-login {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.55rem;
    padding: 0.95rem 2rem;
    background: var(--ink);
    color: var(--cream);
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 500;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    text-decoration: none;
    transition: background 0.25s, transform 0.25s, box-shadow 0.25s;
    font-family: 'DM Sans', sans-serif;
  }
  .modal-btn-login:hover {
    background: #2e2820;
    transform: translateY(-1px);
    box-shadow: 0 8px 28px rgba(26,22,18,0.2);
  }

  .modal-btn-cancel {
    display: block;
    width: 100%;
    padding: 0.8rem;
    background: transparent;
    border: none;
    color: var(--muted);
    font-size: 0.82rem;
    cursor: pointer;
    letter-spacing: 0.04em;
    font-family: 'DM Sans', sans-serif;
    transition: color 0.2s;
    margin-top: 0.5rem;
  }
  .modal-btn-cancel:hover { color: var(--ink); }

  /* ── Path cards ───────────────────────────────────────────────── */
  .path-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 2rem 1.5rem;
    transition: all 0.35s cubic-bezier(0.22,1,0.36,1);
    position: relative;
    overflow: hidden;
  }
  .path-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 60%, rgba(201,168,76,0.06) 100%);
    opacity: 0;
    transition: opacity 0.35s;
  }
  .path-card:hover { border-color: var(--gold); transform: translateY(-4px); box-shadow: 0 20px 60px rgba(26,22,18,0.10); }
  .path-card:hover::before { opacity: 1; }
  .path-card.featured { background: var(--ink); border-color: var(--ink); color: #fff; }

  .ornament {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--gold);
  }
  .ornament::before, .ornament::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--gold-light);
  }

  #curriculum-content { display: none; }
  #curriculum-content.open {
    display: block;
    animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
  }

  .curriculum-row {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    padding: 1.25rem 0;
    border-bottom: 1px solid var(--border);
    transition: background 0.2s;
  }
  .curriculum-row:last-child { border-bottom: none; }
  .curriculum-row:hover { background: rgba(201,168,76,0.04); margin: 0 -1.5rem; padding-left: 1.5rem; padding-right: 1.5rem; border-radius: 12px; }

  .pill {
    display: inline-block;
    padding: 0.25rem 0.85rem;
    border-radius: 999px;
    font-size: 0.7rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    font-weight: 500;
  }

  .price-sticky { position: sticky; top: 2rem; }

  .fb-link {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    color: var(--ink);
    font-size: 0.875rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    text-decoration: none;
    border-bottom: 1px solid var(--gold);
    padding-bottom: 2px;
    transition: color 0.2s, border-color 0.2s;
  }
  .fb-link:hover { color: var(--rust); border-color: var(--rust); }

  .section-label {
    font-family: 'DM Sans', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 500;
  }

  #curriculum-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.75rem;
    border: 1px solid var(--ink);
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    background: transparent;
    color: var(--ink);
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    transition: background 0.25s, color 0.25s;
  }
  #curriculum-btn:hover { background: var(--ink); color: var(--cream); }

  .not-found { text-align: center; padding: 8rem 2rem; }
</style>


<!-- ══════════════ LOGIN REQUIRED MODAL ══════════════ -->
<div id="login-modal-backdrop" onclick="closeModal(event)" role="dialog" aria-modal="true" aria-labelledby="modal-title">
  <div id="login-modal">

    <!-- Close X -->
    <button class="modal-close" onclick="hideModal()" aria-label="Close modal">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M18 6L6 18M6 6l12 12"/>
      </svg>
    </button>

    <!-- Icon -->
    <div class="modal-icon">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.5">
        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
      </svg>
    </div>

    <!-- Text -->
    <h2 class="modal-title" id="modal-title">Login Required</h2>
    <p class="modal-body">
      You need to be signed in to enroll in this course.<br>
      Log in to your account and start your learning journey today.
    </p>

    <div class="modal-divider"></div>

    <!-- Actions -->
    <a href="profile.php?redirect=<?= urlencode('specificCourse.php?courseID=' . $courseID) ?>" class="modal-btn-login">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/>
      </svg>
      Sign In to Continue
    </a>
    <button class="modal-btn-cancel" onclick="hideModal()">Maybe later</button>

  </div>
</div>


<!-- ══════════════ PAGE ══════════════ -->
<div style="background:var(--cream); min-height:100vh; padding-bottom: 6rem;">
  <div style="max-width: 1160px; margin: 0 auto; padding: 4rem 1.5rem 0;">

    <?php if ($course): ?>

      <!-- ───── HERO ───── -->
      <div class="fade-up">

        <!-- Top bar: label + Facebook -->
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; margin-bottom:3rem;">
          <span class="section-label">Course Detail</span>
          <?php if (!empty($course['fbLink'])): ?>
          <a href="<?= htmlspecialchars($course['fbLink']) ?>" target="_blank" class="fb-link">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.268h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>
            View on Facebook
          </a>
          <?php endif; ?>
        </div>

        <!-- Hero two-column -->
        <div style="display:grid; grid-template-columns:1fr; gap:3rem; align-items:start;">

          <!-- Left: title + description + CTA buttons -->
          <div>
            <div class="ornament" style="margin-bottom:2rem;">
              <span class="font-display" style="font-size:0.9rem; letter-spacing:0.1em; color:var(--gold); font-style:italic;">Explore</span>
            </div>

            <h1 class="font-display" style="font-size:clamp(2.8rem,6vw,5rem); font-weight:300; line-height:1.08; letter-spacing:-1px; color:var(--ink); margin:0 0 2rem;">
              <?= htmlspecialchars($course['name']) ?>
            </h1>

            <!-- Duration -->
            <div style="display:flex; align-items:center; gap:1.5rem; margin-bottom:2.5rem; flex-wrap:wrap;">
              <div style="display:flex; align-items:center; gap:0.5rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <span class="section-label" style="color:var(--muted);">Duration</span>
                <span style="font-size:0.95rem; font-weight:500; color:var(--ink);"><?= htmlspecialchars($course['period']) ?></span>
              </div>
              <span style="color:var(--border);">|</span>
              <span class="pill" style="background:rgba(201,168,76,0.12); color:var(--rust);">Self-paced Available</span>
            </div>

            <!-- Description -->
            <div class="fade-up-2" style="font-size:1.05rem; line-height:1.85; color:var(--muted); max-width:none; white-space:pre-wrap; word-break:break-word; overflow:visible; border-left:2px solid var(--gold-light); padding-left:1.5rem;">
              <?= nl2br(htmlspecialchars($course['description'])) ?>
            </div>

            <!-- ── CTA BUTTONS ─────────────────────────────────── -->
            <div class="cta-group fade-up-3">

              <!-- Always visible: Learn Free -->
              <a href="moduleFree.php?courseID=<?= $courseID ?>" class="btn-base btn-free">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                  <polyline points="14 2 14 8 20 8"/>
                  <line x1="9" y1="13" x2="15" y2="13"/>
                  <line x1="9" y1="17" x2="15" y2="17"/>
                </svg>
                Learn Free
              </a>

              <?php if ($isApproved): ?>
                <!-- Enrolled + approved → Continue Learning -->
                <a href="moduleNotFree.php?courseID=<?= $courseID ?>" class="btn-base btn-continue">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="5 3 19 12 5 21 5 3"/>
                  </svg>
                  Continue Learning
                </a>

              <?php elseif ($isEnrolled): ?>
                <!-- Enrolled but not yet approved → show badge only -->
                <span class="badge-pending">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                  </svg>
                  Awaiting Approval
                </span>

              <?php else: ?>
                <!-- Not enrolled at all -->
                <?php if ($isLoggedIn): ?>
                  <!-- Logged in → go to enrollment page -->
                  <a href="enrollCourse.php?courseID=<?= $courseID ?>" class="btn-base btn-enroll">
                    Enroll Now
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </a>
                <?php else: ?>
                  <!-- Not logged in → trigger modal -->
                  <button class="btn-base btn-enroll" onclick="showModal()">
                    Enroll Now
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                  </button>
                <?php endif; ?>

              <?php endif; ?>

            </div><!-- end cta-group -->
          </div><!-- end left column -->

          <!-- Right: price sticky card -->
          <div class="price-sticky fade-up-3">
            <div style="background:var(--ink); border-radius:24px; padding:2.5rem; color:#fff; text-align:center; position:relative; overflow:hidden;">
              <div style="position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:rgba(201,168,76,0.08);"></div>
              <div style="position:absolute;bottom:-60px;left:-30px;width:200px;height:200px;border-radius:50%;background:rgba(201,168,76,0.05);"></div>

              <p class="section-label" style="color:var(--gold-light); margin-bottom:0.75rem;">Starting From</p>
              <p class="font-display" style="font-size:clamp(3rem,7vw,4.5rem); font-weight:300; line-height:1; margin:0; color:#fff;">
                <?= number_format($course['fee'] * 0.2) ?>
                <span style="font-size:1.25rem; opacity:0.7;"> MMK</span>
              </p>
              <p style="font-size:0.8rem; color:rgba(255,255,255,0.45); margin-top:0.75rem; letter-spacing:0.05em;">(Video Lectures Only)</p>

              <div style="margin-top:2rem; padding-top:2rem; border-top:1px solid rgba(255,255,255,0.1);">
                <span class="pill" style="background:rgba(201,168,76,0.2); color:var(--gold-light);">80% OFF · Best Value</span>
              </div>
            </div>
          </div>

        </div><!-- end hero two-col -->
      </div><!-- end hero -->


      <!-- ───── LEARNING PATHS ───── -->
      <div class="fade-up-3" style="margin-top:6rem;">

        <div class="ornament" style="margin-bottom:3rem;">
          <span class="section-label" style="font-size:0.7rem;">Choose Your Learning Path</span>
        </div>
        <h2 class="font-display" style="font-size:clamp(2rem,4vw,3rem); font-weight:300; letter-spacing:-0.5px; margin:0 0 2.5rem; color:var(--ink);">
          Five Ways to <em>Learn</em>
        </h2>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:1.25rem;">

          <div class="path-card">
            <p class="section-label" style="margin-bottom:1.5rem;">01</p>
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:400; line-height:1.3; margin:0 0 2rem; color:var(--ink);">Video Lectures Only</h3>
            <p style="font-size:1.8rem; font-weight:300; color:var(--ink); margin:0;"><?= number_format($course['fee'] * 0.2) ?><span style="font-size:0.85rem; margin-left:3px; color:var(--muted);">MMK</span></p>
            <span class="pill" style="margin-top:0.6rem; background:#EEFAF3; color:#1A7A46;">80% OFF · Self-paced</span>
          </div>

          <div class="path-card">
            <p class="section-label" style="margin-bottom:1.5rem;">02</p>
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:400; line-height:1.3; margin:0 0 2rem; color:var(--ink);">Video + Zoom By One</h3>
            <p style="font-size:1.8rem; font-weight:300; color:var(--ink); margin:0;"><?= number_format($course['fee'] * 0.5) ?><span style="font-size:0.85rem; margin-left:3px; color:var(--muted);">MMK</span></p>
            <span class="pill" style="margin-top:0.6rem; background:#EEFAF3; color:#1A7A46;">50% OFF · Live support</span>
          </div>

          <div class="path-card">
            <p class="section-label" style="margin-bottom:1.5rem;">03</p>
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:400; line-height:1.3; margin:0 0 2rem; color:var(--ink);">Group Class</h3>
            <p style="font-size:1.8rem; font-weight:300; color:var(--ink); margin:0;"><?= number_format($course['fee'] * 0.7) ?><span style="font-size:0.85rem; margin-left:3px; color:var(--muted);">MMK</span></p>
            <span class="pill" style="margin-top:0.6rem; background:#EEFAF3; color:#1A7A46;">30% OFF · Batch learning</span>
          </div>

          <div class="path-card featured">
            <p class="section-label" style="margin-bottom:1.5rem; color:var(--gold);">04</p>
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:400; line-height:1.3; margin:0 0 2rem; color:#fff;">VIP By One Class</h3>
            <p style="font-size:1.8rem; font-weight:300; color:#fff; margin:0;"><?= number_format($course['fee']) ?><span style="font-size:0.85rem; margin-left:3px; color:rgba(255,255,255,0.55);">MMK</span></p>
            <span class="pill" style="margin-top:0.6rem; background:rgba(201,168,76,0.2); color:var(--gold-light);">1-on-1 private</span>
          </div>

          <div class="path-card">
            <p class="section-label" style="margin-bottom:1.5rem;">05</p>
            <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.3rem; font-weight:400; line-height:1.3; margin:0 0 2rem; color:var(--ink);">Face to Face Bangkok</h3>
            <p style="font-size:1.8rem; font-weight:300; color:var(--ink); margin:0;"><?= number_format($course['fee'] * 2) ?><span style="font-size:0.85rem; margin-left:3px; color:var(--muted);">MMK</span></p>
            <span class="pill" style="margin-top:0.6rem; background:#FFF4ED; color:var(--rust);">In-person class</span>
          </div>

        </div>
      </div><!-- end learning paths -->


      <!-- ───── CURRICULUM ───── -->
      <div class="fade-up-4" style="margin-top:6rem;">

        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1.5rem; margin-bottom:2.5rem;">
          <div>
            <div class="ornament" style="justify-content:flex-start; margin-bottom:0.75rem;">
              <span class="section-label">What You'll Learn</span>
            </div>
            <h2 class="font-display" style="font-size:clamp(2rem,4vw,3rem); font-weight:300; letter-spacing:-0.5px; margin:0; color:var(--ink);">
              Course <em>Curriculum</em>
            </h2>
          </div>
          <button onclick="toggleCurriculum()" id="curriculum-btn">
            <svg id="curriculum-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
            <span id="curriculum-label">View Course Curriculum</span>
          </button>
        </div>

        <div id="curriculum-content" style="background:#fff; border:1px solid var(--border); border-radius:24px; padding:2.5rem;">
          <?php if (!empty($courseDetails)): ?>
            <div>
              <?php foreach ($courseDetails as $i => $detail): ?>
                <div class="curriculum-row">
                  <div style="min-width:2.25rem; height:2.25rem; background:var(--ink); color:var(--cream); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.72rem; font-weight:600; flex-shrink:0; letter-spacing:0.02em;">
                    <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                  </div>
                  <div style="flex:1; padding-top:0.35rem;">
                    <p class="font-display" style="font-size:1.15rem; font-weight:400; color:var(--ink); margin:0;">
                      <?= htmlspecialchars($detail['name']) ?>
                    </p>
                  </div>
                  <svg style="flex-shrink:0; color:var(--gold-light); margin-top:0.5rem;" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div style="text-align:center; padding:3rem 0; color:var(--muted);">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--gold-light)" stroke-width="1.5" style="margin:0 auto 1rem;"><path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm0 6v4m0 4h.01"/></svg>
              <p style="font-size:0.95rem;">Curriculum details will be added soon.</p>
            </div>
          <?php endif; ?>
        </div>

      </div><!-- end curriculum -->


    <?php else: ?>

      <!-- Not Found -->
      <div class="not-found fade-up">
        <div class="ornament" style="justify-content:center; margin-bottom:2rem;">
          <span class="section-label">404</span>
        </div>
        <h1 class="font-display" style="font-size:clamp(3rem,8vw,6rem); font-weight:300; color:var(--ink); margin:0 0 2rem;">
          Course Not Found
        </h1>
        <p style="color:var(--muted); font-size:1rem; margin-bottom:3rem;">The course you're looking for doesn't exist or has been removed.</p>
        <a href="courses.php" style="display:inline-flex; align-items:center; gap:0.75rem; padding:0.875rem 2rem; border:1px solid var(--ink); border-radius:999px; color:var(--ink); text-decoration:none; font-size:0.8rem; letter-spacing:0.08em; text-transform:uppercase; font-weight:500; transition:background 0.25s, color 0.25s;" onmouseover="this.style.background='var(--ink)';this.style.color='var(--cream)';" onmouseout="this.style.background='transparent';this.style.color='var(--ink)';">
          ← Back to All Courses
        </a>
      </div>

    <?php endif; ?>

  </div><!-- end container -->
</div><!-- end page -->

<script>
  /* ── Curriculum toggle ─────────────────────────────────────────── */
  function toggleCurriculum() {
    const content = document.getElementById('curriculum-content');
    const label   = document.getElementById('curriculum-label');
    const icon    = document.getElementById('curriculum-icon');
    const isOpen  = content.classList.contains('open');

    if (isOpen) {
      content.classList.remove('open');
      content.style.display = 'none';
      label.textContent = 'View Course Curriculum';
      icon.setAttribute('d', 'M19 9l-7 7-7-7');
    } else {
      content.style.display = 'block';
      content.classList.add('open');
      label.textContent = 'Hide Curriculum';
      icon.setAttribute('d', 'M19 15l-7-7-7 7');
    }
  }

  /* ── Login modal ───────────────────────────────────────────────── */
  function showModal() {
    const bd = document.getElementById('login-modal-backdrop');
    bd.classList.add('show');
    document.body.style.overflow = 'hidden';
    // Re-trigger animation each open
    const modal = document.getElementById('login-modal');
    modal.style.animation = 'none';
    modal.offsetHeight; // reflow
    modal.style.animation = '';
  }

  function hideModal() {
    document.getElementById('login-modal-backdrop').classList.remove('show');
    document.body.style.overflow = '';
  }

  // Click outside modal box → close
  function closeModal(e) {
    if (e.target === document.getElementById('login-modal-backdrop')) hideModal();
  }

  // Escape key → close
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') hideModal();
  });
</script>

<?php include 'footer.php'; ?>