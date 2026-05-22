<?php require_once('includes/connectdb.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* ── Global mobile overflow fix ──────────────────────────────────
           Prevents ANY included section from blowing out the page width.
           Fixes the "content narrower than screen" bug on mobile.
        ──────────────────────────────────────────────────────────────── */
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        img, video, iframe, table {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <?php 
include './nav.php'; 
include './welcome.php';
include './our_diversity.php';
include './our_faq.php';
include './our_certificate.php';
include './footer.php';
?>
</body>
</html>