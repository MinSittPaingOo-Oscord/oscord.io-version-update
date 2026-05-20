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
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:    #111111;
            --paper:  #ffffff;
            --muted:  #888888;
            --border: #d4d4d4;
            --light:  #f5f5f5;
            --error:  #c0392b;
            --ok:     #1a7a3a;
        }

        body {
            font-family: 'Georgia', serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
        }

        :root {
            --ink:    #111111;
            --paper:  #ffffff;
            --muted:  #888888;
            --border: #d4d4d4;
            --light:  #f5f5f5;
            --error:  #c0392b;
            --ok:     #1a7a3a;
        }

        .page-wrap {
            font-family: 'Georgia', serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* ── page shell ── */
        .page-wrap {
            max-width: 1300px;
            margin: 0 auto;
            padding: 56px 40px 80px;
        }

        /* ── masthead ── */
        .masthead {
            border-bottom: 2px solid var(--ink);
            padding-bottom: 20px;
            margin-bottom: 36px;
        }
        .masthead-label {
            font-family: system-ui, sans-serif;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .masthead h1 {
            font-size: clamp(1.6rem, 4vw, 2.2rem);
            font-weight: 400;
            letter-spacing: -.02em;
            line-height: 1.15;
        }
        .masthead p {
            margin-top: 8px;
            font-family: system-ui, sans-serif;
            font-size: .85rem;
            color: var(--muted);
        }
        .masthead p a {
            color: var(--ink);
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        /* ── alerts ── */
        .alert {
            font-family: system-ui, sans-serif;
            font-size: .85rem;
            padding: 12px 16px;
            border: 1.5px solid;
            margin-bottom: 28px;
            line-height: 1.5;
        }
        .alert-error   { border-color: var(--error); color: var(--error); background: #fff5f5; }
        .alert-success { border-color: var(--ok);    color: var(--ok);    background: #f4fdf6; }

        /* ── fieldsets ── */
        .section-label {
            font-family: system-ui, sans-serif;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--muted);
            border-top: 1px solid var(--border);
            padding-top: 24px;
            margin: 32px 0 20px;
        }
        .section-label:first-of-type { margin-top: 0; border-top: none; padding-top: 0; }

        /* ── form rows ── */
        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-family: system-ui, sans-serif;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .field label .opt {
            font-weight: 400;
            color: var(--muted);
            text-transform: none;
            letter-spacing: 0;
            font-size: .78rem;
        }
        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1.5px solid var(--border);
            background: var(--paper);
            font-family: system-ui, sans-serif;
            font-size: .92rem;
            color: var(--ink);
            outline: none;
            transition: border-color .15s;
            -webkit-appearance: none;
            border-radius: 0;
        }
        .field input:focus,
        .field select:focus,
        .field textarea:focus { border-color: var(--ink); }
        .field input::placeholder,
        .field textarea::placeholder { color: #bbb; }
        .field select { cursor: pointer; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23111'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 13px center; padding-right: 32px; }

        .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }

        @media (max-width: 640px) { 
            .row-2 { grid-template-columns: 1fr; } 
            .page-wrap { padding: 40px 20px 60px; }
        }

        .upload-box {
            border: 1.5px dashed var(--border);
            padding: 32px 24px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
            position: relative;
            overflow: hidden;
        }
        .upload-box:hover { border-color: var(--ink); background: var(--light); }
        .upload-box input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer;
            width: 100%; height: 100%; border: none; padding: 0;
        }
        .upload-icon {
            font-size: 1.9rem;
            margin-bottom: 10px;
            display: block;
        }
        .upload-box p {
            font-family: system-ui, sans-serif;
            font-size: .84rem;
            color: var(--muted);
            line-height: 1.5;
        }
        .upload-box strong { color: var(--ink); }
        #preview-wrap { margin-top: 18px; display: none; }
        #preview-wrap img {
            width: 88px; height: 88px;
            object-fit: cover;
            border: 2px solid var(--ink);
            display: block;
            margin: 0 auto 8px;
        }
        #file-name {
            font-family: system-ui, sans-serif;
            font-size: .8rem;
            color: var(--muted);
        }

        /* ── password strength ── */
        .strength-bar {
            height: 3px;
            background: var(--border);
            margin-top: 8px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            width: 0;
            transition: width .3s, background .3s;
        }
        .strength-text {
            font-family: system-ui, sans-serif;
            font-size: .74rem;
            color: var(--muted);
            margin-top: 4px;
            min-height: 1em;
        }

        /* ── password match ── */
        .match-msg {
            font-family: system-ui, sans-serif;
            font-size: .74rem;
            margin-top: 5px;
            min-height: 1em;
        }

        /* ── submit ── */
        .submit-row { margin-top: 40px; }
        .btn-register {
            width: 100%;
            padding: 16px;
            background: var(--ink);
            color: var(--paper);
            border: 2px solid var(--ink);
            font-family: system-ui, sans-serif;
            font-size: .88rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background .15s, color .15s;
            border-radius: 0;
        }
        .btn-register:hover { background: var(--paper); color: var(--ink); }
        .btn-register:disabled { opacity: .5; cursor: not-allowed; }

        .terms {
            font-family: system-ui, sans-serif;
            font-size: .75rem;
            color: var(--muted);
            text-align: center;
            margin-top: 16px;
            line-height: 1.6;
        }

        /* ── divider ── */
        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 36px 0;
        }
    </style>
</head>
<body>
<?php include './nav.php'; ?>

<div class="page-wrap">

    <div class="masthead">
        <p class="masthead-label">Oscord Code Academy</p>
        <h1>Create your account</h1>
        <p>Already a member? <a href="profile.php">Sign in here</a></p>
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
                <span class="upload-icon">⊕</span>
                <p><strong>Click to upload</strong> or drag &amp; drop<br>Leave blank to use a default avatar</p>
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
                <label>Country</label>
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
            <button type="submit" class="btn-register" id="submit-btn">Create account →</button>
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
uploadBox.addEventListener('dragover',  e => { e.preventDefault(); uploadBox.style.background='#f5f5f5'; uploadBox.style.borderColor='#111'; });
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
    submitBtn.textContent = 'Creating account…';
});
</script>
</body>
</html>
<?php include './footer.php' ?>