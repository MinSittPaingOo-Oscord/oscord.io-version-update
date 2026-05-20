<?php
session_start();
include 'includes/connectdb.php';

// ── Only accept POST ──────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// ── Collect & sanitise inputs ─────────────────────────────────────────────────
$name     = trim($_POST['name']     ?? '');
$country  = trim($_POST['country']  ?? '');
$email    = trim($_POST['email']    ?? '');
$passcode = $_POST['passcode']         ?? '';
$confirm  = $_POST['passcode_confirm'] ?? '';
$telegram = trim($_POST['telegram'] ?? '');
$birthday = trim($_POST['birthday'] ?? '');
$phone    = trim($_POST['phone']    ?? '');

// ── Server-side validation ────────────────────────────────────────────────────
$errors = [];

if ($name     === '') $errors[] = 'Full name is required.';
if ($country  === '') $errors[] = 'Country is required.';
if ($telegram === '') $errors[] = 'Telegram handle is required.';
if ($phone    === '') $errors[] = 'Phone number is required.';
if ($birthday === '') $errors[] = 'Birthday is required.';

// Email
if ($email === '') {
    $errors[] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

// Password
if ($passcode === '') {
    $errors[] = 'Password is required.';
} elseif (strlen($passcode) < 8) {
    $errors[] = 'Password must be at least 8 characters.';
} elseif ($passcode !== $confirm) {
    $errors[] = 'Passwords do not match.';
}

// Birthday basic format check
if ($birthday !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
    $errors[] = 'Birthday format is invalid.';
}

// ── Abort early if validation failed ─────────────────────────────────────────
if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);
    // Preserve form data (except passwords) for repopulation
    $_POST = array_filter($_POST, fn($k) => !in_array($k, ['passcode','passcode_confirm']), ARRAY_FILTER_USE_KEY);
    header('Location: register.php');
    exit;
}

// ── Duplicate email check ─────────────────────────────────────────────────────
$stmt = $conn->prepare("SELECT id FROM account WHERE email = ? LIMIT 1");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    $_SESSION['error'] = 'That email address is already registered. Please log in or use a different email.';
    header('Location: register.php');
    exit;
}
$stmt->close();

// ── Profile picture upload (optional) ────────────────────────────────────────
$photoID = null;

$fileUploaded = isset($_FILES['profile'])
             && $_FILES['profile']['error'] !== UPLOAD_ERR_NO_FILE
             && $_FILES['profile']['error'] === UPLOAD_ERR_OK;

if ($fileUploaded) {

    $file     = $_FILES['profile'];
    $maxBytes = 5 * 1024 * 1024; // 5 MB

    // Size check
    if ($file['size'] > $maxBytes) {
        $_SESSION['error'] = 'Profile picture must be smaller than 5 MB.';
        header('Location: register.php');
        exit;
    }

    // MIME check via finfo (more reliable than extension alone)
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mime     = $finfo->file($file['tmp_name']);
    $allowed  = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];

    if (!array_key_exists($mime, $allowed)) {
        $_SESSION['error'] = 'Profile picture must be a JPG, PNG, GIF, or WEBP image.';
        header('Location: register.php');
        exit;
    }

    // Build a unique, safe filename
    $ext      = $allowed[$mime];
    $safeName = bin2hex(random_bytes(12)) . '.' . $ext;   // e.g. a3f8c12d90bc4e.jpg
    $destDir  = __DIR__ . '/images/';
    $destPath = $destDir . $safeName;

    // Create directory if it doesn't exist
    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], $destPath)) {
        $_SESSION['error'] = 'Could not save the profile picture. Please try again.';
        header('Location: register.php');
        exit;
    }

    // Insert into photo table
    $stmt = $conn->prepare("INSERT INTO photo (name) VALUES (?)");
    $stmt->bind_param('s', $safeName);
    if (!$stmt->execute()) {
        $_SESSION['error'] = 'Database error while saving photo. Please try again.';
        $stmt->close();
        header('Location: register.php');
        exit;
    }
    $photoID = (int) $conn->insert_id;
    $stmt->close();
}

// ── Hash password ─────────────────────────────────────────────────────────────
$hashedPass = password_hash($passcode, PASSWORD_DEFAULT);

// ── Insert into account ───────────────────────────────────────────────────────
$stmt = $conn->prepare(
    "INSERT INTO account (name, profile, country, email, passcode, telegram, birthday, phone, registerDateTime)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())"
);
$stmt->bind_param(
    'sissssss',
    $name,
    $photoID,   // null if no upload
    $country,
    $email,
    $hashedPass,
    $telegram,
    $birthday,
    $phone
);

if (!$stmt->execute()) {
    $_SESSION['error'] = 'Could not create your account. Please try again.';
    $stmt->close();
    header('Location: register.php');
    exit;
}

$newAccountID = (int) $conn->insert_id;
$stmt->close();

// ── Insert into student ───────────────────────────────────────────────────────
$stmt = $conn->prepare("INSERT INTO student (accountID) VALUES (?)");
$stmt->bind_param('i', $newAccountID);
if (!$stmt->execute()) {
    // Non-fatal: account was created; log the inconsistency but don't block the user
    error_log("Warning: student row not created for accountID={$newAccountID} — " . $stmt->error);
}
$stmt->close();

// ── Success ───────────────────────────────────────────────────────────────────
$_SESSION['success'] = 'Your account has been created! Please log in to continue.';
header('Location: register.php');
exit;