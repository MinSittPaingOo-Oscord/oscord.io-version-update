<?php
// profile-edit.php - WITH REMOVE PHOTO FEATURE

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'includes/auth.php';

if (!function_exists('isLoggedIn') || !isLoggedIn()) {
    echo '<div class="text-red-600 p-8 text-center">Please log in to edit your profile.</div>';
    exit;
}

$user = getCurrentUser();
$conn = $GLOBALS['conn'] ?? null;

if (!$conn || !$user || empty($user['id'])) {
    echo '<div class="text-red-600 p-8 text-center">Error loading profile data.</div>';
    exit;
}

// Current profile photo
$photoPath = null;
if (!empty($user['profile'])) {
    $photoRes = mysqli_query($conn, "SELECT name FROM photo WHERE id = " . (int)$user['profile']);
    if ($photoRes && mysqli_num_rows($photoRes) > 0) {
        $photoPath = "image/" . mysqli_fetch_assoc($photoRes)['name'];
    }
}

// Handle form submissions
$errorMsg = '';
$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ==================== REMOVE PHOTO ====================
    if (isset($_POST['remove_photo'])) {
        if (!empty($user['profile'])) {
            // Optional: delete the photo file if you want (uncomment if needed)
            // $oldFile = "image/" . $oldPhotoName; if(file_exists($oldFile)) unlink($oldFile);

            $stmt = mysqli_prepare($conn, "UPDATE account SET profile = NULL WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $user['id']);
            mysqli_stmt_execute($stmt);

            $successMsg = "✅ Profile photo removed successfully!";
            $user = getCurrentUser();           // refresh
            $photoPath = null;
        }
    }

    // ==================== UPDATE PERSONAL INFORMATION ====================
    if (isset($_POST['update_profile'])) {

        $name      = trim($_POST['name'] ?? '');
        $country   = trim($_POST['country'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $telegram  = trim($_POST['telegram'] ?? '');
        $birthday  = $_POST['birthday'] ?? '';
        $phone     = trim($_POST['phone'] ?? '');

        if (empty($name) || empty($email)) {
            $errorMsg = "Name and Email are required.";
        } else {
            $newProfileID = $user['profile'];

            // Profile photo upload (only if a new file is chosen)
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['profile_photo']['tmp_name'];
                $fileExt = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($fileExt, $allowed)) {
                    $newFileName = uniqid('profile_') . '.' . $fileExt;
                    $uploadPath  = 'image/' . $newFileName;

                    if (move_uploaded_file($fileTmp, $uploadPath)) {
                        mysqli_query($conn, "INSERT INTO photo (name) VALUES ('$newFileName')");
                        $newProfileID = mysqli_insert_id($conn);
                    } else {
                        $errorMsg = "Failed to upload photo.";
                    }
                } else {
                    $errorMsg = "Only JPG, PNG, GIF, WebP files are allowed.";
                }
            }

            if (empty($errorMsg)) {
                $sql = "UPDATE account SET name=?, country=?, email=?, telegram=?, birthday=?, phone=?, profile=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssssii", $name, $country, $email, $telegram, $birthday, $phone, $newProfileID, $user['id']);

                if (mysqli_stmt_execute($stmt)) {
                    $successMsg = "✅ Profile updated successfully!";
                    $user = getCurrentUser();
                } else {
                    $errorMsg = "Failed to update profile.";
                }
            }
        }
    }

    // ==================== UPDATE PASSWORD ====================
    if (isset($_POST['update_password'])) {
        // ... (your existing password code remains unchanged) ...
        $currentPass = $_POST['current_pass'] ?? '';
        $newPass     = $_POST['new_pass'] ?? '';
        $confirmPass = $_POST['confirm_pass'] ?? '';

        if (empty($currentPass) || empty($newPass) || empty($confirmPass)) {
            $errorMsg = "All password fields are required.";
        } elseif ($newPass !== $confirmPass) {
            $errorMsg = "New passwords do not match.";
        } elseif (strlen($newPass) < 6) {
            $errorMsg = "New password must be at least 6 characters long.";
        } elseif (password_verify($currentPass, $user['passcode'])) {
            $hashed = password_hash($newPass, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($conn, "UPDATE account SET passcode = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "si", $hashed, $user['id']);

            if (mysqli_stmt_execute($stmt)) {
                $successMsg = "✅ Password updated successfully!";
            } else {
                $errorMsg = "Failed to update password.";
            }
        } else {
            $errorMsg = "Current password is incorrect.";
        }
    }
}
?>

<!-- ====================== HTML PART ====================== -->
<div class="max-w-5xl mx-auto px-6 py-16">
    <h2 class="text-5xl font-light tracking-[-2px] mb-12">Edit Profile</h2>

    <?php if (!empty($successMsg)): ?>
        <div class="max-w-2xl mx-auto mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-none text-center">
            <?= htmlspecialchars($successMsg) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errorMsg)): ?>
        <div class="max-w-2xl mx-auto mb-8 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-none text-center">
            <?= htmlspecialchars($errorMsg) ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

        <!-- Personal Information -->
        <div class="lg:col-span-7">
            <div class="border-2 border-black p-10">
                <h3 class="text-3xl font-light mb-8">Personal Information</h3>

                <form method="POST" enctype="multipart/form-data" id="profileForm" class="space-y-8">
                    
                    <!-- Profile Photo with Remove Button -->
                    <div class="flex items-center gap-8">
                        <div class="relative w-28 h-28 border-2 border-black rounded-none overflow-hidden flex-shrink-0 bg-white">
                            <?php if ($photoPath): ?>
                                <img src="<?= htmlspecialchars($photoPath) ?>" alt="Profile" class="w-full h-full object-cover">
                                
                                <!-- Remove Photo Cross -->
                                <button type="submit" name="remove_photo" value="1"
                                        onclick="return confirm('Remove profile photo?');"
                                        class="absolute top-1 right-1 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-xl leading-none shadow-md transition-colors">
                                    ×
                                </button>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-5xl text-zinc-300">👤</div>
                            <?php endif; ?>
                        </div>

                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-2">Change Profile Photo</label>
                            <input type="file" name="profile_photo" accept="image/*" 
                                   class="block w-full text-sm text-zinc-500 file:mr-4 file:py-3 file:px-6 file:border-2 file:border-black file:bg-white file:text-black hover:file:bg-purple-600 hover:file:text-white cursor-pointer">
                            <p class="text-xs text-zinc-400 mt-1">JPG, PNG, GIF, WebP only</p>
                        </div>
                    </div>

                    <!-- Rest of the form remains the same -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Full Name</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" 
                                   class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600" required>
                        </div>
                        <!-- ... other fields (country, email, telegram, birthday, phone) ... -->
                        <div>
                            <label class="block text-sm font-medium mb-2">Country</label>
                            <input type="text" name="country" value="<?= htmlspecialchars($user['country'] ?? '') ?>" 
                                   class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Email Address</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                                   class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Telegram Username</label>
                            <input type="text" name="telegram" value="<?= htmlspecialchars($user['telegram'] ?? '') ?>" 
                                   class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Birthday</label>
                            <input type="date" name="birthday" value="<?= htmlspecialchars($user['birthday'] ?? '') ?>" 
                                   class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Phone Number</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" 
                                   class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600">
                        </div>
                    </div>

                    <button type="submit" name="update_profile" value="1"
                            class="w-full bg-black text-white hover:bg-purple-600 py-6 text-xl font-medium transition-colors">
                        SAVE CHANGES
                    </button>
                </form>
            </div>
        </div>

        <!-- Security Section (unchanged) -->
        <div class="lg:col-span-5">
            <div class="border-2 border-black p-10 h-full">
                <h3 class="text-3xl font-light mb-8">Security</h3>
                <p class="text-zinc-500 mb-8">Update your passcode</p>

                <form method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Current Password</label>
                        <input type="password" name="current_pass" class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">New Password</label>
                        <input type="password" name="new_pass" class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Confirm New Password</label>
                        <input type="password" name="confirm_pass" class="w-full border-2 border-black px-6 py-4 focus:outline-none focus:border-purple-600" required>
                    </div>

                    <button type="submit" name="update_password" value="1"
                            class="w-full border-2 border-black hover:bg-black hover:text-white py-6 text-xl font-medium transition-all">
                        UPDATE PASSWORD
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>