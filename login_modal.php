<?php
// login_modal.php - COMPACT on mobile • WIDER on desktop
?>

<!-- Login Modal -->
<div id="loginModal" 
     onclick="if(event.target === this) closeLoginModal()" 
     class="hidden fixed inset-0 z-[9999] bg-black/70 flex items-center justify-center px-4">
    
    <div onclick="event.stopImmediatePropagation()" 
         class="bg-white w-full max-w-sm md:max-w-md border-2 border-black shadow-2xl overflow-hidden">
        
        <!-- Header -->
        <div class="px-8 md:px-10 py-6 border-b border-black flex items-center justify-between">
            <h2 class="text-3xl font-light tracking-tight">Sign In</h2>
            <button onclick="closeLoginModal()" 
                    class="text-4xl leading-none text-black/40 hover:text-black transition-colors">×</button>
        </div>

        <!-- Form -->
        <form action="login_action.php" method="POST" class="px-8 md:px-10 pt-6 pb-8 space-y-6">
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium tracking-widest text-black mb-2">EMAIL ADDRESS *</label>
                <input type="email" 
                       name="email" 
                       id="modal_email"
                       required
                       class="w-full px-5 py-4 border-2 border-black focus:outline-none focus:border-black text-base placeholder:text-black/40">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium tracking-widest text-black mb-2">PASSWORD *</label>
                <input type="password" 
                       name="password" 
                       id="modal_password"
                       required
                       class="w-full px-5 py-4 border-2 border-black focus:outline-none focus:border-black text-base">
            </div>

            <!-- Remember me -->
            <div class="flex items-center">
                <input type="checkbox" 
                       name="remember_me" 
                       id="remember_me"
                       class="w-5 h-5 border-2 border-black accent-black cursor-pointer">
                <label for="remember_me" class="ml-3 text-sm font-medium cursor-pointer select-none">Remember me</label>
            </div>

            <!-- Log In Button -->
            <button type="submit" 
                    class="w-full bg-black hover:bg-zinc-900 text-white py-5 text-lg font-medium tracking-widest transition-all">
                LOG IN
            </button>
        </form>

        <!-- Footer -->
        <div class="px-8 md:px-10 py-5 border-t border-black text-center text-sm">
            Don't have an account? 
            <a href="register.php" onclick="closeLoginModal();" 
               class="font-medium underline hover:text-black/70">Register</a>
        </div>
    </div>
</div>

<script>
// Open Login Modal
function openLoginModal() {
    const modal = document.getElementById('loginModal');
    if (!modal) return;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Auto-focus email field
    setTimeout(() => {
        const emailField = document.getElementById('modal_email');
        if (emailField) emailField.focus();
    }, 150);
}

// Close Login Modal
function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") {
        const modal = document.getElementById('loginModal');
        if (modal && modal.classList.contains('flex')) {
            closeLoginModal();
        }
    }
});
</script>