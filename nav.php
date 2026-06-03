<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=Cormorant+Garamond:wght@500;600&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    #oscord-nav *, #oscord-nav *::before, #oscord-nav *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    #oscord-nav {
        --nav-height: 68px;
        --font-brand: 'Cormorant Garamond', Georgia, serif;
        --font-ui: 'DM Sans', sans-serif;
        --color-bg: #ffffff;
        --color-ink: #111111;
        --color-muted: #555555;
        --color-border: #e5e5e5;
        --color-hover-bg: #f5f5f5;
        --color-overlay: rgba(0, 0, 0, 0.45);
        --radius: 8px;
        --transition: 0.22s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ---- Bar ---- */
    #oscord-nav .nav-bar {
        background: var(--color-bg);
        border-bottom: 1px solid var(--color-border);
        height: var(--nav-height);
        display: flex;
        align-items: center;
        padding: 0 40px;
        position: sticky;
        top: 0;
        z-index: 1000;
        gap: 0;
    }

    /* ---- Brand ---- */
    #oscord-nav .brand {
        font-family: var(--font-brand);
        font-weight: 600;
        font-size: 1.5rem;
        letter-spacing: -0.01em;
        color: var(--color-ink) !important;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
        line-height: 1;
        transition: opacity var(--transition);
    }
    #oscord-nav .brand:hover { opacity: 0.7; }

    /* ---- Spacer ---- */
    #oscord-nav .nav-spacer { flex: 1; }

    /* ---- Desktop links ---- */
    #oscord-nav .nav-desktop {
        display: flex;
        align-items: center;
        gap: 2px;
        list-style: none;
    }

    #oscord-nav .nav-desktop .nav-link {
        font-family: var(--font-ui);
        font-weight: 450;
        font-size: 0.92rem;
        letter-spacing: 0.015em;
        color: var(--color-muted) !important;
        text-decoration: none;
        padding: 7px 16px;
        border-radius: var(--radius);
        transition: color var(--transition), background var(--transition);
        white-space: nowrap;
    }
    #oscord-nav .nav-desktop .nav-link:hover,
    #oscord-nav .nav-desktop .nav-link.active {
        color: var(--color-ink) !important;
        background: var(--color-hover-bg);
    }

    /* ---- CTA button ---- */
    #oscord-nav .nav-desktop .nav-cta .nav-link {
        color: var(--color-ink) !important;
        font-weight: 600;
        font-size: 0.88rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        border: 1.5px solid var(--color-ink);
        padding: 7px 20px;
        border-radius: 6px;
        background: transparent;
        margin-left: 10px;
        transition: background var(--transition), color var(--transition);
    }
    #oscord-nav .nav-desktop .nav-cta .nav-link:hover {
        background: var(--color-ink);
        color: #ffffff !important;
    }

    /* ---- Divider before CTA ---- */
    #oscord-nav .nav-divider {
        width: 1px;
        height: 22px;
        background: var(--color-border);
        margin: 0 12px;
        flex-shrink: 0;
    }

    /* ---- Hamburger button ---- */
    #oscord-nav .hamburger-btn {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 40px;
        height: 40px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        border-radius: var(--radius);
        transition: background var(--transition);
        -webkit-tap-highlight-color: transparent;
        flex-shrink: 0;
    }
    #oscord-nav .hamburger-btn:hover { background: var(--color-hover-bg); }

    #oscord-nav .hamburger-btn span {
        display: block;
        width: 22px;
        height: 1.5px;
        background: var(--color-ink);
        border-radius: 2px;
        transition: transform var(--transition), opacity var(--transition), width var(--transition);
        transform-origin: center;
    }

    /* Animated X state */
    #oscord-nav .hamburger-btn.is-open span:nth-child(1) {
        transform: translateY(6.5px) rotate(45deg);
    }
    #oscord-nav .hamburger-btn.is-open span:nth-child(2) {
        opacity: 0;
        width: 0;
    }
    #oscord-nav .hamburger-btn.is-open span:nth-child(3) {
        transform: translateY(-6.5px) rotate(-45deg);
    }

    /* ---- Mobile overlay (FIXED) ---- */
    #oscord-nav .nav-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: var(--color-overlay);
        z-index: 998;
        opacity: 0;
        transition: opacity var(--transition);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        pointer-events: none;
    }
    #oscord-nav .nav-overlay.is-visible {
        display: block;
        opacity: 1;
        pointer-events: auto;
    }

    /* ---- Mobile drawer (FIXED) ---- */
    #oscord-nav .nav-drawer {
        display: none;
        position: fixed;
        top: var(--nav-height);
        left: 0;
        right: 0;
        background: var(--color-bg);
        z-index: 999;
        border-bottom: 1px solid var(--color-border);
        padding: 12px 0 20px;
        transform: translateY(-10px);
        opacity: 0;
        transition: transform var(--transition), opacity var(--transition);
        pointer-events: none;
    }
    #oscord-nav .nav-drawer.is-open {
        display: block;
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    #oscord-nav .nav-mobile-list {
        list-style: none;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    #oscord-nav .nav-mobile-list .nav-link {
        display: block;
        font-family: var(--font-ui);
        font-weight: 450;
        font-size: 1rem;
        color: var(--color-muted) !important;
        text-decoration: none;
        padding: 12px 16px;
        border-radius: var(--radius);
        letter-spacing: 0.01em;
        transition: color var(--transition), background var(--transition);
    }
    #oscord-nav .nav-mobile-list .nav-link:hover,
    #oscord-nav .nav-mobile-list .nav-link.active {
        color: var(--color-ink) !important;
        background: var(--color-hover-bg);
    }

    #oscord-nav .nav-mobile-list .nav-cta {
        margin-top: 8px;
        padding-top: 16px;
        border-top: 1px solid var(--color-border);
    }
    #oscord-nav .nav-mobile-list .nav-cta .nav-link {
        color: var(--color-ink) !important;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        border: 1.5px solid var(--color-ink);
        text-align: center;
        padding: 12px 16px;
    }
    #oscord-nav .nav-mobile-list .nav-cta .nav-link:hover {
        background: var(--color-ink);
        color: #ffffff !important;
    }

    /* ---- Responsive breakpoint ---- */
    @media (max-width: 768px) {
        #oscord-nav .nav-bar {
            padding: 0 20px;
        }
        #oscord-nav .nav-desktop,
        #oscord-nav .nav-divider {
            display: none;
        }
        #oscord-nav .hamburger-btn {
            display: flex;
        }
        /* Do NOT force display:block on overlay and drawer here */
    }

    /* ---- Body scroll lock ---- */
    body.nav-open {
        overflow: hidden;
    }
</style>

<div id="oscord-nav">
    <!-- Sticky bar -->
    <nav class="nav-bar" role="navigation" aria-label="Main navigation">
        <a class="brand" href="index.php">Oscord Code Academy</a>
        <div class="nav-spacer"></div>

        <!-- Desktop links -->
        <ul class="nav-desktop" aria-label="Site navigation">
            <li><a class="nav-link" href="courses.php">Courses</a></li>
            <li><a class="nav-link" href="batches.php">Group Classes</a></li>
            <li><a class="nav-link" href="profile.php">Profile</a></li>
        </ul>
        <div class="nav-divider" aria-hidden="true"></div>
        <ul class="nav-desktop">
            <li class="nav-cta"><a class="nav-link" href="register.php">Register</a></li>
        </ul>

        <!-- Hamburger -->
        <button class="hamburger-btn" id="oscordHamburger" aria-label="Toggle menu" aria-expanded="false" aria-controls="oscordDrawer">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- Backdrop -->
    <div class="nav-overlay" id="oscordOverlay" aria-hidden="true"></div>

    <!-- Mobile drawer -->
    <div class="nav-drawer" id="oscordDrawer" role="menu" aria-hidden="true">
        <ul class="nav-mobile-list">
            <li><a class="nav-link" href="courses.php" role="menuitem">Courses</a></li>
            <li><a class="nav-link" href="batches.php" role="menuitem">Group Classes</a></li>
            <li><a class="nav-link" href="profile.php" role="menuitem">Profile</a></li>
            <li class="nav-cta"><a class="nav-link" href="register.php" role="menuitem">Register</a></li>
        </ul>
    </div>
</div>

<script>
(function () {
    if (window.__oscordNavInit) return;
    window.__oscordNavInit = true;

    function initNav() {
        var btn      = document.getElementById('oscordHamburger');
        var drawer   = document.getElementById('oscordDrawer');
        var overlay  = document.getElementById('oscordOverlay');
        if (!btn || !drawer || !overlay) return;

        var page = window.location.pathname.split('/').pop() || 'index.php';
        document.querySelectorAll('#oscord-nav .nav-link').forEach(function (a) {
            var href = a.getAttribute('href');
            if (href && href === page) a.classList.add('active');
        });

        function openMenu() {
            btn.classList.add('is-open');
            btn.setAttribute('aria-expanded', 'true');
            drawer.classList.add('is-open');
            drawer.setAttribute('aria-hidden', 'false');
            overlay.classList.add('is-visible');
            document.body.classList.add('nav-open');
        }

        function closeMenu() {
            btn.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
            drawer.classList.remove('is-open');
            drawer.setAttribute('aria-hidden', 'true');
            overlay.classList.remove('is-visible');
            document.body.classList.remove('nav-open');
        }

        btn.addEventListener('click', function () {
            btn.classList.contains('is-open') ? closeMenu() : openMenu();
        });

        overlay.addEventListener('click', closeMenu);

        drawer.querySelectorAll('.nav-link').forEach(function (a) {
            a.addEventListener('click', closeMenu);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) closeMenu();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNav);
    } else {
        initNav();
    }
})();
</script>