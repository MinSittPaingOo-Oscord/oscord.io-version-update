<?php

$sql = "SELECT r.review, a.name AS studentName, c.name AS courseName 
        FROM review r
        JOIN student s ON r.studentID = s.id
        JOIN account a ON s.accountID = a.id
        JOIN course c ON r.courseID = c.id
        WHERE r.isShown = 1
        ORDER BY r.id DESC";

$result = $conn->query($sql);
?>

<div class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-5xl font-light tracking-tight text-black">Student Reviews</h1>
            <p class="mt-4 text-xl text-gray-600">What our students say about Oscord</p>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="overflow-hidden">
                <div id="review-scroll" class="review-scroll flex gap-8">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="review-card min-w-[460px] max-w-[460px] bg-white border border-gray-100 rounded-3xl p-10 shadow-sm hover:shadow-xl transition-all">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-11 h-11 bg-black text-white rounded-2xl flex items-center justify-center text-2xl flex-shrink-0">
                                    👨‍🎓
                                </div>
                                <div class="pt-1">
                                    <h3 class="font-medium text-lg text-black"><?= htmlspecialchars($row['studentName']) ?></h3>
                                    <p class="text-sm text-gray-500"><?= htmlspecialchars($row['courseName']) ?></p>
                                </div>
                            </div>
                            <p class="review-text text-gray-700 leading-relaxed text-[16.5px]">
                                "<?= nl2br(htmlspecialchars($row['review'])) ?>"
                            </p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-20 text-gray-500">No reviews available yet.</div>
        <?php endif; ?>

    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('review-scroll');
    if (!container) return;

    const cards = container.querySelectorAll('.review-card');
    if (cards.length === 0) return;

    const cardWidth = 460 + 32; 
    const clones = Math.ceil((window.innerWidth * 2.8) / cardWidth);

    for (let i = 0; i < clones; i++) {
        cards.forEach(card => {
            const clone = card.cloneNode(true);
            container.appendChild(clone);
        });
    }

    let position = 0;
    const speed = 0.8;
    let paused = false;
    let rafId;

    function scrollLoop() {
        if (!paused) {
            position -= speed;
            if (Math.abs(position) >= cardWidth * cards.length) {
                position += cardWidth * cards.length;
            }
            container.style.transform = `translateX(${position}px)`;
        }
        rafId = requestAnimationFrame(scrollLoop);
    }

    scrollLoop();

    container.addEventListener('mouseenter', () => paused = true);
    container.addEventListener('mouseleave', () => paused = false);
    window.addEventListener('beforeunload', () => cancelAnimationFrame(rafId));
});
</script>

<style>
    .review-scroll {
        display: flex;
        will-change: transform;
        padding: 30px 0;
    }
    .review-card {
        flex-shrink: 0;
        transition: all 0.4s ease;
    }
    .review-card:hover {
        transform: translateY(-10px);
    }
    
    .review-text {
        line-height: 2.1 !important;  
    }
</style>