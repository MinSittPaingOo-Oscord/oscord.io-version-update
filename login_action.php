<?php
session_start();
require_once 'includes/auth.php';   // ← This is the key change

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: profile.php");
    exit();
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['error'] = "Please enter both email and password.";
    header("Location: profile.php");
    exit();
}

$stmt = $conn->prepare("SELECT id, passcode, name FROM account WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['passcode'])) {
        
        // === BLOCK ADMIN & INSTRUCTOR ACCOUNTS ===
        $blockStmt = $conn->prepare("
            SELECT 'admin' as type FROM admin WHERE accountID = ?
            UNION
            SELECT 'instructor' as type FROM instructor WHERE accountID = ?
        ");
        $blockStmt->bind_param("ii", $user['id'], $user['id']);
        $blockStmt->execute();
        $blockResult = $blockStmt->get_result();
        
        if ($blockResult->num_rows > 0) {
            $_SESSION['error'] = "Admin and Instructor accounts cannot log in through this portal.";
            header("Location: profile.php");
            exit();
        }
        
        // SINGLE DEVICE LOGIN
        if (loginUser($user['id'])) {
            $_SESSION['success'] = "Welcome back, " . htmlspecialchars($user['name']) . "!";
            
            if (isset($_POST['remember_me'])) {
                setcookie("remember_user", $user['id'], time() + (86400 * 30), "/", "", false, true);
            }
            
            header("Location: profile.php");
            exit();
        } else {
            $_SESSION['error'] = "Login failed. Please try again.";
        }
    }
}

$stmt->close();

$_SESSION['error'] = "Invalid email or password. Please try again.";
header("Location: profile.php");
exit();
?>