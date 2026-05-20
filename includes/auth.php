<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'connectdb.php';  

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['accountID']) && !empty($_SESSION['accountID']);
}

// Get full user info (students only)
function getCurrentUser() {
    if (!isLoggedIn()) return null;

    global $conn;
    $accountID = $_SESSION['accountID'];

    $stmt = $conn->prepare("SELECT * FROM account WHERE id = ?");
    $stmt->bind_param("i", $accountID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
}

// Student-only role
function getUserRole() {
    return isLoggedIn() ? 'student' : null;
}

// Logout function
function logout() {
    session_destroy();
    header("Location: profile.php");
    exit();
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['error'] = "Please login to access this page.";
        header("Location: profile.php");
        exit();
    }
}
?>