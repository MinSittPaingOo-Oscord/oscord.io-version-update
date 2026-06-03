<?php require_once('includes/connectdb.php'); ?>

<?php
// Database connection $conn must be available
$sql = "SELECT r.review, a.name AS studentName, c.name AS courseName 
        FROM review r
        JOIN student s ON r.studentID = s.id
        JOIN account a ON s.accountID = a.id
        JOIN course c ON r.courseID = c.id
        WHERE r.isShown = 1
        ORDER BY r.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Reviews | Oscord Code Academy</title>
</head>
<body>

    <?php include 'nav.php'; ?>

    <!-- ==================== STUDENT REVIEWS SECTION ==================== -->
    <div style="background:#ffffff; padding:100px 0 80px;">
        <div style="max-width:1280px; margin:0 auto; padding:0 20px;">

            <div style="text-align:center; margin-bottom:60px;">
                <h1 style="font-size:48px; font-weight:300; letter-spacing:-1px; color:#111111; margin:0 0 12px 0;">
                    Student Reviews
                </h1>
                <p style="font-size:22px; color:#555555; margin:0;">
                    What our students say about Oscord
                </p>
            </div>

            <?php if ($result && $result->num_rows > 0): ?>
                
                <!-- Horizontal Scroll Container (Native Scrollbar Only) -->
                <div id="review-scroll" 
                     style="display:flex; gap:32px; overflow-x:auto; padding:30px 0 20px; 
                            scroll-behavior:smooth; scroll-snap-type:x mandatory; 
                            -webkit-overflow-scrolling:touch;">
                    
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="review-card" style="scroll-snap-align:center;">
                            <div style="display:flex; align-items:flex-start; gap:16px; margin-bottom:24px;">
                                <div style="width:48px; height:48px; background:#111111; color:#fff; border-radius:16px; 
                                            display:flex; align-items:center; justify-content:center; font-size:26px; flex-shrink:0;">
                                    👨‍🎓
                                </div>
                                <div style="padding-top:4px;">
                                    <h3 style="font-size:19px; font-weight:600; color:#111111; margin:0 0 4px 0;">
                                        <?= htmlspecialchars($row['studentName']) ?>
                                    </h3>
                                    <p style="margin:0; color:#777777; font-size:15px;">
                                        <?= htmlspecialchars($row['courseName']) ?>
                                    </p>
                                </div>
                            </div>
                            <p class="review-text">
                                "<?= nl2br(htmlspecialchars($row['review'])) ?>"
                            </p>
                        </div>
                    <?php endwhile; ?>

                </div>

            <?php else: ?>
                <div style="text-align:center; padding:80px 20px; color:#777777; font-size:18px;">
                    No reviews available yet.
                </div>
            <?php endif; ?>

        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- ==================== FIXED CARD STYLES ==================== -->
    <style>
        .review-card {
            width: 460px;
            min-width: 430px;
            height: 450px;
            flex-shrink: 0;
            background: #ffffff;
            border: 1px solid #f0f0f0;
            border-radius: 24px;
            padding: 40px 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
        }

        .review-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        .review-text {
            margin: 0;
            color: #374151;
            line-height: 2.1em;
            font-size: 16.5px;
            flex: 1;
            overflow-y: auto;
        }

        /* Native Horizontal Scrollbar - clearly visible */
        #review-scroll {
            scrollbar-width: thin;
            scrollbar-color: #111111 #f0f0f0;
        }
        
        #review-scroll::-webkit-scrollbar {
            height: 10px;
        }
        
        #review-scroll::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 20px;
        }
        
        #review-scroll::-webkit-scrollbar-thumb {
            background: #111111;
            border-radius: 20px;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .review-card {
                width: 340px;
                min-width: 340px;
                height: 380px;
                padding: 32px 24px;
            }
            
            #review-scroll {
                gap: 24px;
            }
        }
    </style>

</body>
</html>