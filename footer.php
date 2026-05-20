<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    /* ==================== OSCORD FOOTER - MINIMALIST & SCOPED ==================== */
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
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #111111;
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
        color: #444444;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.2s;
    }

    #oscord-footer .footer-col a:hover {
        color: #111111;
    }

    /* Social Icons */
    #oscord-footer .footer-socials {
        margin-top: 20px;
    }

    #oscord-footer .footer-socials a {
        color: #111111;
        font-size: 1.5rem;
        margin-right: 18px;
        transition: all 0.2s ease;
    }

    #oscord-footer .footer-socials a:hover {
        color: #222222;
        transform: translateY(-2px);
    }

    /* Copyright */
    #oscord-footer .footer-bottom {
        text-align: center;
        margin-top: 60px;
        padding-top: 20px;
        border-top: 1px solid #eeeeee;
        color: #666666;
        font-size: 0.85rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #oscord-footer .footer-columns {
            flex-direction: column;
            text-align: center;
            gap: 40px;
        }
        #oscord-footer footer {
            padding: 50px 20px 30px;
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
                    <li><a href="articles.php">Articles</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </div>

            <!-- Column 3: Explore / Social -->
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="footer-socials">
                    <a href="https://www.facebook.com/share/19u16vW5KQ/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="www.youtube.com/@oscord.code.academy" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://t.me/oscord_cs" target="_blank"><i class="fab fa-telegram"></i></a>
                    <a href="https://www.instagram.com/oscord.code.academy/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@oscord.code.academy?is_from_webapp=1&sender_device=pc" target="_blank"><i class="fab fa-tiktok"></i></a>

                </div>
            </div>

        </div>

        <div class="footer-bottom">
            © OSCORD Code Academy — All Rights Reserved 2022
        </div>
    </footer>
</div>