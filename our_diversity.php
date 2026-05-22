<?php
// oscord_diversity.php - Mobile Responsive Version
?>

<style>
    #oscord-diversity * { box-sizing: border-box; }

    #oscord-diversity {
        width: 100%;
        max-width: 1152px;
        margin: 0 auto;
        padding: 80px 24px;
        background: #ffffff;
        overflow: hidden;
    }

    #oscord-diversity .section-title {
        text-align: center;
        font-size: 2.4rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #111111;
        margin-bottom: 56px;
        line-height: 1.2;
    }

    #oscord-diversity .diversity-grid {
        display: grid;
        grid-template-columns: 5fr 7fr;
        gap: 48px;
        align-items: center;
        width: 100%;
    }

    #oscord-diversity .globe-wrap {
        display: flex;
        justify-content: center;
        overflow: hidden;
    }

    #oscord-diversity .globe-wrap img {
        max-height: 360px;
        max-width: 100%;
        width: 100%;
        object-fit: contain;
        display: block;
    }

    #oscord-diversity .diversity-desc {
        font-size: 1rem;
        color: #555555;
        line-height: 1.75;
        margin-bottom: 36px;
    }

    #oscord-diversity .chart-title {
        font-size: 1.25rem;
        font-weight: 400;
        color: #111111;
        margin-bottom: 20px;
        letter-spacing: -0.01em;
    }

    #oscord-diversity .chart-wrap {
        position: relative;
        width: 100%;
        /* height set by JS based on screen size */
    }

    /* ── Mobile ─────────────────────────────────── */
    @media (max-width: 768px) {
        #oscord-diversity {
            padding: 48px 16px;
        }

        #oscord-diversity .section-title {
            font-size: 1.65rem;
            margin-bottom: 28px;
        }

        #oscord-diversity .diversity-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        #oscord-diversity .globe-wrap img {
            max-height: 200px;
        }

        #oscord-diversity .chart-title {
            font-size: 1rem;
        }
    }
</style>

<div id="oscord-diversity">

    <h2 class="section-title">Our Global Diversity</h2>

    <div class="diversity-grid">

        <!-- Globe -->
        <div class="globe-wrap">
            <img src="./image/globe.png" alt="Global Students">
        </div>

        <!-- Right side -->
        <div>
            <p class="diversity-desc">
                Oscord Code Academy brings together students from Myanmar and many countries around the world.
                Our flexible scheduling allows meaningful learning experiences across different time zones.
            </p>

            <h3 class="chart-title">Student Distribution by Country</h3>
            <div class="chart-wrap" id="diversityChartWrap">
                <canvas id="studentDiversityChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var isMobile = window.innerWidth <= 768;
    var wrap = document.getElementById('diversityChartWrap');

    // Set chart height based on viewport
    wrap.style.height = isMobile ? '300px' : '380px';

    var ctx = document.getElementById('studentDiversityChart').getContext('2d');
    var labels = ['Myanmar','Singapore','Thailand','Japan','Korea','Sweden','USA','Finland','Kuwait','Qatar','Vietnam'];
    var rawData = [128, 48, 89, 24, 19, 13, 11, 9, 8, 7, 6];
    var total = rawData.reduce(function(a, b) { return a + b; }, 0);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: rawData,
                backgroundColor: [
                    '#1E40AF','#D97706','#10B981','#7C3AED','#DB2777',
                    '#0F766E','#6366F1','#EA580C','#22D3EE','#A78BFA','#4ADE80'
                ],
                borderColor: '#ffffff',
                borderWidth: 2,
                borderRadius: 4,
                barThickness: isMobile ? 14 : 20,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                // No extra right padding — labels removed to prevent overflow
                padding: { right: 0, left: 0 }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var pct = ((context.raw / total) * 100).toFixed(1);
                            return context.raw + ' students (' + pct + '%)';
                        }
                    }
                },
                // No datalabels plugin — was causing right-side overflow
            },
            scales: {
                x: {
                    beginAtZero: true,
                    max: 140,
                    ticks: {
                        color: '#888',
                        font: { size: isMobile ? 10 : 12 },
                        maxTicksLimit: isMobile ? 5 : 8
                    },
                    grid: { color: '#f0f0f0' }
                },
                y: {
                    ticks: {
                        color: '#333',
                        font: { size: isMobile ? 11 : 13 }
                    },
                    grid: { display: false }
                }
            }
        }
        // ChartDataLabels NOT registered — removed to fix overflow
    });
});
</script>