<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'connectdb.php';  

// Generate secure random token
function generateSessionToken() {
    return bin2hex(random_bytes(32));
}

// Validate token against database
function validateSessionToken($accountID, $sessionToken) {
    global $conn;
    if (!$conn) return false;

    $stmt = $conn->prepare("SELECT session_token FROM account WHERE id = ?");
    $stmt->bind_param("i", $accountID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row && $row['session_token'] === $sessionToken;
}

// Single-device isLoggedIn
function isLoggedIn() {
    if (!isset($_SESSION['accountID']) || empty($_SESSION['accountID']) || 
        !isset($_SESSION['session_token']) || empty($_SESSION['session_token'])) {
        return false;
    }

    return validateSessionToken($_SESSION['accountID'], $_SESSION['session_token']);
}

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

function getUserRole() {
    return isLoggedIn() ? 'student' : null;
}

// SINGLE DEVICE LOGIN FUNCTION
function loginUser($accountID) {
    global $conn;
    
    $token = generateSessionToken();
    
    $stmt = $conn->prepare("UPDATE account SET session_token = ? WHERE id = ?");
    $stmt->bind_param("si", $token, $accountID);
    $success = $stmt->execute();
    $stmt->close();
    
    if ($success) {
        session_regenerate_id(true);
        $_SESSION['accountID'] = $accountID;
        $_SESSION['session_token'] = $token;
        return true;
    }
    return false;
}

// Improved logout (clears token from DB + destroys session)
function logout() {
    if (isset($_SESSION['accountID'])) {
        global $conn;
        $accountID = $_SESSION['accountID'];
        
        $stmt = $conn->prepare("UPDATE account SET session_token = NULL WHERE id = ?");
        $stmt->bind_param("i", $accountID);
        $stmt->execute();
        $stmt->close();
    }
    
    session_destroy();
    header("Location: index.php");
    exit();
}

// Better requireLogin
function requireLogin() {
    if (!isset($_SESSION['accountID']) || empty($_SESSION['accountID'])) {
        $_SESSION['error'] = "Please login to access this page.";
        header("Location: profile.php");
        exit();
    }
    
    if (!isLoggedIn()) {
        $_SESSION['error'] = "You have been logged out because you signed in from another device.";
        session_destroy();
        header("Location: profile.php");
        exit();
    }
}
?>