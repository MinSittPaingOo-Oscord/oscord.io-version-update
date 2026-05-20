<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
<meta charset="UTF-8">

<style>
    /* ==================== OSCORD NAV - STRONG MOBILE FIX ==================== */
    

    #oscord-nav * { box-sizing: border-box; }

    #oscord-nav .navbar-custom {
        background: #ffffff;
        border-bottom: 1px solid #e8e8e8;
        padding: 0 40px;
        position: sticky;
        top: 0;
        z-index: 1000;
        height: 72px;
        display: flex;
        align-items: center;
        box-shadow: 0 1px 0 #f0f0f0;
    }

    #oscord-nav .nav-left { display: flex; align-items: center; }
    #oscord-nav .nav-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }

    #oscord-nav .brand {
        color: #111111 !important;
        font-family: 'Playfair Display', Georgia, serif !important;
        font-weight: 600 !important;
        font-size: 1.45rem !important;
        letter-spacing: -0.02em !important;
        text-decoration: none;
        padding: 8px 0;
        margin-right: 60px;
        white-space: nowrap;
    }

    #oscord-nav .nav-list {
        display: flex;
        align-items: center;
        gap: 6px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #oscord-nav .nav-link {
        color: #444444 !important;
        font-family: 'DM Sans', sans-serif !important;
        font-weight: 500 !important;
        font-size: 1.05rem !important;
        letter-spacing: 0.01em;
        text-decoration: none;
        padding: 8px 18px;
        border-radius: 8px;
        transition: all 0.25s ease;
    }

    #oscord-nav .nav-link:hover,
    #oscord-nav .nav-link.active {
        color: #111111 !important;
        background: #f8f8f8;
    }

    #oscord-nav .nav-item:last-child .nav-link {
        color: #111111 !important;
        background: transparent;
        border: 1.8px solid #222222;
        border-radius: 8px;
        padding: 7px 22px;
        font-weight: 600;
        font-size: 1.02rem !important;
        margin-left: 12px;
    }

    #oscord-nav .nav-item:last-child .nav-link:hover {
        background: #111111;
        color: #ffffff !important;
    }


</style>

<div id="oscord-nav">
    <nav class="navbar-custom" role="navigation" aria-label="Main navigation">
        <div class="nav-left">
            <a class="brand nav-link" href="index.php">Oscord Code Academy</a>
        </div>
        
        <div class="nav-right">
            <ul class="nav-list">
                <li class="nav-item"><a class="nav-link" href="courses.php">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="batches.php">Group Classes</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            </ul>

            <button id="hamburgerBtn" class="navbar-toggler" aria-label="Toggle menu">
                <span class="hamburger"></span>
            </button>
        </div>
    </nav>

</div>

