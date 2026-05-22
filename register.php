<?php

include 'includes/connectdb.php';
require_once 'includes/auth.php';   

$success = $_SESSION['success'] ?? null;
$error   = $_SESSION['error']   ?? null;
unset($_SESSION['success'], $_SESSION['error']);

$countries = [
    'Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia',
    'Austria','Azerbaijan','Bahrain','Bangladesh','Belarus','Belgium','Belize','Bhutan',
    'Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Cambodia',
    'Cameroon','Canada','Chile','China','Colombia','Croatia','Cuba','Cyprus','Czech Republic',
    'Denmark','Ecuador','Egypt','Estonia','Ethiopia','Finland','France','Georgia','Germany',
    'Ghana','Greece','Guatemala','Honduras','Hungary','Iceland','India','Indonesia','Iran',
    'Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya',
    'Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Libya','Liechtenstein',
    'Lithuania','Luxembourg','Malaysia','Maldives','Malta','Mexico','Moldova','Mongolia',
    'Montenegro','Morocco','Mozambique','Myanmar','Nepal','Netherlands','New Zealand',
    'Nicaragua','Nigeria','North Korea','North Macedonia','Norway','Oman','Pakistan',
    'Palestine','Panama','Paraguay','Peru','Philippines','Poland','Portugal','Qatar',
    'Romania','Russia','Saudi Arabia','Serbia','Singapore','Slovakia','Slovenia',
    'Somalia','South Africa','South Korea','Spain','Sri Lanka','Sudan','Sweden',
    'Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Tunisia','Turkey',
    'Turkmenistan','Uganda','Ukraine','United Arab Emirates','United Kingdom',
    'United States','America','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zimbabwe'
];
sort($countries);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Oscord Code Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:        #0d0d0d;
            --paper:      #ffffff;
            --muted:      #9a9a9a;
            --border:     #e8e8e8;
            --light:      #f8f8f8;
            --purple:     #7c5cbf;
            --purple-lt:  #f3eeff;
            --purple-mid: #c4aff0;
            --error:      #b5341a;
            --ok:         #1a6b3a;
            --radius:     12px;
            --radius-sm:  8px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── page shell ── */
        .page-wrap {
            max-width: 800px;
            margin: 0 auto;
            padding: 48px 20px 80px;
            animation: fadeUp .5s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @media (min-width: 640px) {
            .page-wrap { padding: 64px 40px 100px; }
        }

        /* ── masthead ── */
        .masthead {
            margin-bottom: 44px;
        }
        .masthead-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--purple-lt);
            color: var(--purple);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 20px;
        }
        .masthead-badge::before {
            content: '';
            display: inline-block;
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--purple);
        }
        .masthead h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2rem, 5vw, 2.9rem);
            font-weight: 400;
            line-height: 1.1;
            letter-spacing: -.02em;
            color: var(--ink);
            margin-bottom: 12px;
        }
        .masthead h1 em {
            font-style: italic;
            color: var(--purple);
        }
        .masthead-sub {
            font-size: .88rem;
            color: var(--muted);
            font-weight: 400;
        }
        .masthead-sub a {
            color: var(--ink);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1.5px solid var(--purple-mid);
            padding-bottom: 1px;
            transition: border-color .2s, color .2s;
        }
        .masthead-sub a:hover { color: var(--purple); border-color: var(--purple); }

        /* ── alerts ── */
        .alert {
            font-size: .85rem;
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 32px;
            line-height: 1.55;
            border: 1.5px solid;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert::before { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }
        .alert-error   { border-color: #f2c2bb; color: var(--error); background: #fff8f7; }
        .alert-error::before { content: '⚠'; }
        .alert-success { border-color: #aee0c3; color: var(--ok);    background: #f4fdf7; }
        .alert-success::before { content: '✓'; }

        /* ── section labels ── */
        .section-label {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: .13em;
            text-transform: uppercase;
            color: var(--purple);
            padding: 28px 0 16px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }
        .section-label:first-of-type { padding-top: 0; margin-top: 0; }

        /* ── form fields ── */
        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .03em;
            color: var(--ink);
            margin-bottom: 7px;
        }
        .field label .opt {
            font-weight: 400;
            color: var(--muted);
            font-size: .76rem;
            letter-spacing: 0;
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--paper);
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            -webkit-appearance: none;
        }
        .field input:hover,
        .field select:hover { border-color: #c8c8c8; }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 3.5px rgba(124, 92, 191, .1);
            background: var(--purple-lt);
        }
        .field input::placeholder,
        .field textarea::placeholder { color: #c4c4c4; }

        .field select {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237c5cbf' stroke-width='1.8' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 580px) {
            .row-2 { grid-template-columns: 1fr; gap: 0; }
        }

        /* ── upload box ── */
        .upload-box {
            border: 1.5px dashed var(--border);
            border-radius: var(--radius);
            padding: 36px 24px;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s, background .2s, box-shadow .2s;
            position: relative;
            overflow: hidden;
            background: var(--light);
        }
        .upload-box:hover {
            border-color: var(--purple-mid);
            background: var(--purple-lt);
            box-shadow: 0 0 0 4px rgba(124, 92, 191, .07);
        }
        .upload-box input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer;
            width: 100%; height: 100%; border: none; padding: 0;
        }
        .upload-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            background: #fff;
            border: 1.5px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
            font-size: 1.25rem;
            transition: border-color .2s;
        }
        .upload-box:hover .upload-icon { border-color: var(--purple-mid); }
        .upload-box p {
            font-size: .84rem;
            color: var(--muted);
            line-height: 1.55;
        }
        .upload-box p strong { color: var(--ink); font-weight: 600; }
        .upload-box p .hint { font-size: .76rem; margin-top: 3px; display: block; }

        #preview-wrap { margin-top: 20px; display: none; }
        #preview-wrap img {
            width: 80px; height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 2.5px solid var(--purple-mid);
            display: block;
            margin: 0 auto 8px;
            box-shadow: 0 0 0 4px var(--purple-lt);
        }
        #file-name {
            font-size: .78rem;
            color: var(--muted);
            display: block;
            text-align: center;
        }

        /* ── password strength ── */
        .strength-bar {
            height: 3px;
            background: var(--border);
            border-radius: 10px;
            margin-top: 9px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            width: 0;
            border-radius: 10px;
            transition: width .35s cubic-bezier(.4,0,.2,1), background .35s;
        }
        .strength-text {
            font-size: .73rem;
            color: var(--muted);
            margin-top: 5px;
            min-height: 1em;
            font-weight: 500;
        }

        /* ── password match ── */
        .match-msg {
            font-size: .73rem;
            margin-top: 5px;
            min-height: 1em;
            font-weight: 500;
        }

        /* ── divider ── */
        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 36px 0;
        }

        /* ── submit ── */
        .submit-row { margin-top: 36px; }

        .btn-register {
            width: 100%;
            padding: 15px 24px;
            background: var(--ink);
            color: var(--paper);
            border: 1.5px solid var(--ink);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
            font-weight: 600;
            letter-spacing: .04em;
            cursor: pointer;
            transition: background .2s, color .2s, box-shadow .2s, transform .15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-register:hover {
            background: #1f1f1f;
            box-shadow: 0 4px 20px rgba(0,0,0,.18);
            transform: translateY(-1px);
        }
        .btn-register:active { transform: translateY(0); }
        .btn-register:disabled { opacity: .45; cursor: not-allowed; transform: none; box-shadow: none; }
        .btn-register .arrow { transition: transform .2s; }
        .btn-register:hover .arrow { transform: translateX(3px); }

        .terms {
            font-size: .74rem;
            color: var(--muted);
            text-align: center;
            margin-top: 14px;
            line-height: 1.65;
        }
        .terms a { color: var(--ink); text-decoration: underline; text-underline-offset: 2px; }

        /* ── mobile ── */
        @media (max-width: 580px) {
            .field input,
            .field select,
            .field textarea { font-size: 1rem; padding: 13px 14px; }
            .upload-box { padding: 28px 16px; }
            .masthead h1 { font-size: 1.85rem; }
            .submit-row { margin-top: 28px; }
            .btn-register { padding: 16px; font-size: .95rem; }
        }
    </style>
</head>
<body>
<?php include './nav.php'; ?>

<div class="page-wrap">

    <div class="masthead">
        <div class="masthead-badge">Oscord Code Academy</div>
        <h1>Create your<br><em>account</em></h1>
        <p class="masthead-sub">Already a member? <a href="profile.php">Sign in here</a></p>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="register_action.php" method="POST" enctype="multipart/form-data" id="reg-form" novalidate>

        <!-- ── Profile Picture ── -->
        <div class="section-label">Profile picture</div>
        <div class="field">
            <label>Photo <span class="opt">(optional — jpg, png, gif · max 5 MB)</span></label>
            <div class="upload-box" id="upload-box">
                <input type="file" name="profile" id="profile-input" accept="image/*">
                <div class="upload-icon">📷</div>
                <p><strong>Click to upload</strong> or drag &amp; drop<span class="hint">Leave blank to use a default avatar</span></p>
            </div>
            <div id="preview-wrap">
                <img id="preview-img" src="" alt="Preview">
                <span id="file-name"></span>
            </div>
        </div>

        <!-- ── Personal info ── -->
        <div class="section-label">Personal information</div>

        <div class="field">
            <label>Full name</label>
            <input type="text" name="name" placeholder="e.g. Aye Myat Thu"
                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        </div>

        <div class="row-2">
            <div class="field">
                <label>Birthday</label>
                <input type="date" name="birthday"
                       value="<?= htmlspecialchars($_POST['birthday'] ?? '') ?>" required>
            </div>
            <div class="field">
                <label>Current Residence Country</label>
                <select name="country" required>
                    <option value="" disabled <?= empty($_POST['country']) ? 'selected' : '' ?>>Select country</option>
                    <?php foreach ($countries as $c): ?>
                        <option value="<?= htmlspecialchars($c) ?>"
                            <?= (($_POST['country'] ?? '') === $c) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row-2">
            <div class="field">
                <label>Phone number</label>
                <input type="tel" name="phone" placeholder="+66 98 765 4321"
                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" required>
            </div>
            <div class="field">
                <label>Telegram</label>
                <input type="text" name="telegram" placeholder="@username"
                       value="<?= htmlspecialchars($_POST['telegram'] ?? '') ?>" required>
            </div>
        </div>

        <!-- ── Account credentials ── -->
        <div class="section-label">Account credentials</div>

        <div class="field">
            <label>Email address</label>
            <input type="email" name="email" placeholder="you@example.com"
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label>Password</label>
            <input type="password" name="passcode" id="passcode"
                   placeholder="Minimum 8 characters" required minlength="8"
                   autocomplete="new-password">
            <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
            <div class="strength-text" id="strength-text"></div>
        </div>

        <div class="field">
            <label>Confirm password</label>
            <input type="password" name="passcode_confirm" id="passcode-confirm"
                   placeholder="Repeat your password" required
                   autocomplete="new-password">
            <div class="match-msg" id="match-msg"></div>
        </div>

        <hr class="divider">

        <div class="submit-row">
            <button type="submit" class="btn-register" id="submit-btn">
                Create account <span class="arrow">→</span>
            </button>
            <p class="terms">By registering you agree to our terms of service and privacy policy.</p>
        </div>

    </form>
</div>


<script>
// ── Image preview ──
const input    = document.getElementById('profile-input');
const prevWrap = document.getElementById('preview-wrap');
const prevImg  = document.getElementById('preview-img');
const fileName = document.getElementById('file-name');
const uploadBox= document.getElementById('upload-box');

input.addEventListener('change', () => {
    const file = input.files[0];
    if (!file) { prevWrap.style.display = 'none'; return; }
    fileName.textContent = file.name;
    const reader = new FileReader();
    reader.onload = e => { prevImg.src = e.target.result; prevWrap.style.display = 'block'; };
    reader.readAsDataURL(file);
});

// drag-over visual
uploadBox.addEventListener('dragover',  e => { e.preventDefault(); uploadBox.style.background='#f3eeff'; uploadBox.style.borderColor='#c4aff0'; });
uploadBox.addEventListener('dragleave', () => { uploadBox.style.background=''; uploadBox.style.borderColor=''; });
uploadBox.addEventListener('drop',      () => { uploadBox.style.background=''; uploadBox.style.borderColor=''; });

// ── Password strength ──
const passInput  = document.getElementById('passcode');
const fillEl     = document.getElementById('strength-fill');
const textEl     = document.getElementById('strength-text');

function scorePassword(p) {
    let s = 0;
    if (p.length >= 8)  s++;
    if (p.length >= 12) s++;
    if (/[A-Z]/.test(p)) s++;
    if (/[0-9]/.test(p)) s++;
    if (/[^A-Za-z0-9]/.test(p)) s++;
    return s;
}

passInput.addEventListener('input', () => {
    const v = passInput.value;
    if (!v) { fillEl.style.width = '0'; textEl.textContent = ''; return; }
    const s = scorePassword(v);
    const map = [
        { w: '15%', c: '#c0392b', t: 'Very weak'  },
        { w: '30%', c: '#e67e22', t: 'Weak'        },
        { w: '55%', c: '#f1c40f', t: 'Fair'        },
        { w: '75%', c: '#27ae60', t: 'Strong'      },
        { w: '100%',c: '#1a7a3a', t: 'Very strong' },
    ];
    const d = map[Math.min(s, 4)];
    fillEl.style.width     = d.w;
    fillEl.style.background= d.c;
    textEl.textContent     = d.t;
    textEl.style.color     = d.c;
});

// ── Password match ──
const confInput = document.getElementById('passcode-confirm');
const matchMsg  = document.getElementById('match-msg');
const submitBtn = document.getElementById('submit-btn');

function checkMatch() {
    if (!confInput.value) { matchMsg.textContent = ''; return; }
    if (passInput.value === confInput.value) {
        matchMsg.textContent = '✓ Passwords match';
        matchMsg.style.color = '#1a7a3a';
    } else {
        matchMsg.textContent = '✗ Passwords do not match';
        matchMsg.style.color = '#c0392b';
    }
}
passInput.addEventListener('input',  checkMatch);
confInput.addEventListener('input',  checkMatch);

// ── Submit guard ──
document.getElementById('reg-form').addEventListener('submit', function(e) {
    if (passInput.value !== confInput.value) {
        e.preventDefault();
        confInput.focus();
        matchMsg.textContent  = '✗ Passwords do not match — please fix before continuing';
        matchMsg.style.color  = '#c0392b';
        return;
    }
    submitBtn.disabled    = true;
    submitBtn.innerHTML = 'Creating account…';
});
</script>
</body>
</html>
<?php include './footer.php' ?>