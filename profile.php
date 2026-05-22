<?php
session_start();
require_once 'includes/auth.php';
include './nav.php';
include 'login_modal.php';

// Determine active section (default = person-detail)
$activeSection = $_GET['section'] ?? 'person-detail';
$validSections = ['person-detail', 'your-courses', 'your-classes', 'edit-profile'];
if (!in_array($activeSection, $validSections)) {
    $activeSection = 'person-detail';
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    document.documentElement.setAttribute('data-tailwind-config', JSON.stringify({
        theme: { extend: { fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] } } }
    }));
</script>

<div class="bg-white text-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-16">
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="max-w-lg mx-auto mb-8 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-none text-center text-sm sm:text-base">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="max-w-lg mx-auto mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-none text-center text-sm sm:text-base">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (function_exists('isLoggedIn') && isLoggedIn()): ?>
            
            <?php
            $user = getCurrentUser();
            $photoPath = null;
            if (!empty($user['profile'])) {
                $conn = $GLOBALS['conn'] ?? null;
                $photoResult = mysqli_query($conn, "SELECT name FROM photo WHERE id = " . (int)$user['profile']);
                if ($photoResult && mysqli_num_rows($photoResult) > 0) {
                    $photoPath = "image/" . mysqli_fetch_assoc($photoResult)['name'];
                }
            }
            ?>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-12">
                
                <!-- Mobile: Horizontal Scrolling Nav | Desktop: Slim Sidebar -->
                <div class="lg:w-56 flex-shrink-0 lg:border-r-2 lg:border-black lg:py-8 lg:pr-8">
                    <div class="font-light text-xl sm:text-2xl mb-4 lg:mb-10 tracking-[-1px] hidden lg:block">My Account</div>
                    
                    <!-- Mobile horizontal nav -->
                    <div class="flex lg:hidden overflow-x-auto gap-2 pb-2 mb-4 border-b-2 border-black -mx-4 px-4 scrollbar-hide">
                        <a href="profile.php?section=person-detail"
                           class="flex-shrink-0 px-4 py-2.5 text-sm font-light whitespace-nowrap <?= $activeSection === 'person-detail' ? 'bg-black text-white' : 'border border-black' ?>">
                            Person Detail
                        </a>
                        <a href="profile.php?section=your-courses"
                           class="flex-shrink-0 px-4 py-2.5 text-sm font-light whitespace-nowrap <?= $activeSection === 'your-courses' ? 'bg-black text-white' : 'border border-black' ?>">
                            Courses
                        </a>
                        <a href="profile.php?section=your-classes"
                           class="flex-shrink-0 px-4 py-2.5 text-sm font-light whitespace-nowrap <?= $activeSection === 'your-classes' ? 'bg-black text-white' : 'border border-black' ?>">
                            Classes
                        </a>
                        <a href="profile.php?section=edit-profile"
                           class="flex-shrink-0 px-4 py-2.5 text-sm font-light whitespace-nowrap <?= $activeSection === 'edit-profile' ? 'bg-black text-white' : 'border border-black' ?>">
                            Edit Profile
                        </a>
                        <a href="logout.php"
                           class="flex-shrink-0 px-4 py-2.5 text-sm font-light whitespace-nowrap border border-black hover:bg-black hover:text-white transition-colors">
                            Log Out
                        </a>
                    </div>

                    <!-- Desktop vertical nav -->
                    <div class="hidden lg:block">
                        <a href="profile.php?section=person-detail" 
                           class="nav-item flex items-center gap-3 px-4 py-4 text-lg font-light hover:bg-zinc-100 <?= $activeSection === 'person-detail' ? 'border-l-4 border-black bg-zinc-100' : '' ?> cursor-pointer mb-1">
                            Person Detail
                        </a>
                        <a href="profile.php?section=your-courses" 
                           class="nav-item flex items-center gap-3 px-4 py-4 text-lg font-light hover:bg-zinc-100 <?= $activeSection === 'your-courses' ? 'border-l-4 border-black bg-zinc-100' : '' ?> cursor-pointer mb-1">
                            Your Courses
                        </a>
                        <a href="profile.php?section=your-classes" 
                           class="nav-item flex items-center gap-3 px-4 py-4 text-lg font-light hover:bg-zinc-100 <?= $activeSection === 'your-classes' ? 'border-l-4 border-black bg-zinc-100' : '' ?> cursor-pointer mb-1">
                            Your Classes
                        </a>
                        <a href="profile.php?section=edit-profile" 
                           class="nav-item flex items-center gap-3 px-4 py-4 text-lg font-light hover:bg-zinc-100 <?= $activeSection === 'edit-profile' ? 'border-l-4 border-black bg-zinc-100' : '' ?> cursor-pointer mb-8">
                            Edit Profile
                        </a>
                        
                        <div class="mt-auto pt-8">
                            <a href="logout.php" 
                               class="block px-6 py-4 text-lg font-light border-2 border-black hover:bg-black hover:text-white transition-colors text-center">
                                LOG OUT
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-1 min-w-0">
                    
                    <?php if ($activeSection === 'person-detail'): ?>
                        <div class="profile-section">
                            <?php include 'profile-info.php'; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($activeSection === 'your-courses'): ?>
                        <div class="profile-section">
                            <?php include 'profile-courses.php'; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($activeSection === 'your-classes'): ?>
                        <div class="profile-section">
                            <?php include 'profile-classes.php'; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($activeSection === 'edit-profile'): ?>
                        <div class="profile-section">
                            <?php include 'profile-edit.php'; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php else: ?>
            <!-- NOT LOGGED IN -->
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-12 sm:mb-20">
                    <h1 class="text-[2.8rem] sm:text-[4.5rem] md:text-[5.5rem] font-light tracking-[-2px] sm:tracking-[-3px] leading-none">Oscord Code Academy</h1>
                    <p class="text-lg sm:text-2xl text-zinc-500 mt-4 sm:mt-6 font-light">Master programming with elegance.</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-10">
                    <div class="bg-white border-2 border-black p-8 sm:p-12 md:p-16 flex flex-col items-center text-center hover:border-purple-600 transition-all">
                        <div class="mb-8 sm:mb-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 sm:w-28 sm:h-28 text-black mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl sm:text-5xl font-light mb-3">SIGN IN</h2>
                        <p class="text-base sm:text-xl text-zinc-600 mb-10 sm:mb-16">Welcome back to your account.</p>
                        <a onclick="openLoginModal(); return false;" class="block w-full bg-black text-white hover:bg-purple-700 font-medium text-xl sm:text-2xl py-5 sm:py-7 rounded-none transition-all text-center cursor-pointer">
                            LOGIN
                        </a>
                    </div>
                    
                    <div class="bg-white border-2 border-black p-8 sm:p-12 md:p-16 flex flex-col items-center text-center">
                        <div class="mb-8 sm:mb-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 sm:w-28 sm:h-28 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.25">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 01-5.356-1.857M12 20H4v-2a3 3 0 015.356-1.857M12 4v16m0-16a3 3 0 00-3 3v.341C8.67 9.165 6 11.388 6 14.236V20m6-16a3 3 0 013 3v.341c.418-.705.994-1.32 1.644-1.81" />
                            </svg>
                        </div>
                        <h2 class="text-3xl sm:text-5xl font-light mb-3">JOIN US</h2>
                        <p class="text-base sm:text-xl text-zinc-600 mb-10 sm:mb-16">Create a new account today.</p>
                        <a href="register.php" class="block w-full bg-black text-white hover:bg-purple-700 font-medium text-xl sm:text-2xl py-5 sm:py-7 rounded-none transition-all">
                            REGISTER
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<?php include 'footer.php'; ?>