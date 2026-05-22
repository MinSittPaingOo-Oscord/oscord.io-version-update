<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* ==================== OSCORD FOOTER ==================== */
    #oscord-footer * { box-sizing: border-box; }

    #oscord-footer {
        margin-top: 80px;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    #oscord-footer footer {
        background: #ffffff;
        border-top: 1px solid #111111;
        color: #111111;
        padding: 60px 20px 30px;
    }

    #oscord-footer .footer-columns {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        gap: 40px;
        padding: 0 20px;
    }

    #oscord-footer .footer-col {
        flex: 1 1 240px;
        min-width: 240px;
    }

    #oscord-footer .footer-col h4 {
        font-size: 0.72rem;
        font-weight: 600;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #111111;
    }

    #oscord-footer .footer-col p {
        font-size: 0.93rem;
        line-height: 1.65;
        color: #555555;
    }

    #oscord-footer .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #oscord-footer .footer-col li {
        margin-bottom: 10px;
    }

    #oscord-footer .footer-col a {
        color: #555555;
        text-decoration: none;
        font-size: 0.93rem;
        transition: color 0.2s;
    }

    #oscord-footer .footer-col a:hover {
        color: #111111;
    }

    /* Social Icons */
    #oscord-footer .footer-socials {
        margin-top: 16px;
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
    }

    #oscord-footer .footer-socials a {
        color: #111111;
        font-size: 1.35rem;
        transition: opacity 0.2s ease, transform 0.2s ease;
        display: inline-flex;
    }

    #oscord-footer .footer-socials a:hover {
        opacity: 0.6;
        transform: translateY(-2px);
    }

    /* Copyright */
    #oscord-footer .footer-bottom {
        text-align: center;
        margin-top: 60px;
        padding-top: 20px;
        border-top: 1px solid #eeeeee;
        color: #888888;
        font-size: 0.83rem;
        letter-spacing: 0.01em;
    }

    /* ── Mobile ─────────────────────────────────────────── */
    @media (max-width: 768px) {
        #oscord-footer {
            margin-top: 60px;
        }

        #oscord-footer footer {
            padding: 48px 24px 32px;
        }

        #oscord-footer .footer-columns {
            flex-direction: column;
            gap: 32px;
            padding: 0;
        }

        #oscord-footer .footer-col {
            min-width: unset;
            flex: none;
            width: 100%;
        }

        /* Hairline separator between columns on mobile */
        #oscord-footer .footer-col + .footer-col {
            padding-top: 28px;
            border-top: 1px solid #eeeeee;
        }

        #oscord-footer .footer-col p {
            max-width: 100%;
            font-size: 0.92rem;
        }

        #oscord-footer .footer-col li {
            margin-bottom: 14px;
        }

        #oscord-footer .footer-col a {
            font-size: 0.97rem;
        }

        #oscord-footer .footer-socials {
            margin-top: 14px;
            gap: 22px;
        }

        #oscord-footer .footer-socials a {
            font-size: 1.45rem;
        }

        #oscord-footer .footer-bottom {
            margin-top: 36px;
            text-align: left;
            font-size: 0.8rem;
        }
    }
</style>

<div id="oscord-footer">
    <footer>
        <div class="footer-columns">

            <!-- Column 1: About -->
            <div class="footer-col">
                <h4>Oscord Code Academy</h4>
                <p>Helping students master programming through clean, practical education. Start your journey today.</p>
            </div>

            <!-- Column 2: Navigation -->
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="courses.php">Courses</a></li>
                    <li><a href="batches.php">Group Classes</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </div>

            <!-- Column 3: Social -->
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="footer-socials">
                    <a href="https://www.facebook.com/share/19u16vW5KQ/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.youtube.com/@oscord.code.academy" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://t.me/oscord_cs" target="_blank" aria-label="Telegram"><i class="fab fa-telegram"></i></a>
                    <a href="https://www.instagram.com/oscord.code.academy/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@oscord.code.academy?is_from_webapp=1&sender_device=pc" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            © OSCORD Code Academy — All Rights Reserved Since 2022
        </div>
    </footer>
</div>