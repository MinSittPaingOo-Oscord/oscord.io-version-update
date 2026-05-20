<?php
// oscord_diversity.php - Full Clean Version (Percentage Only on Hover)
?>

<div class="max-w-6xl mx-auto px-6 py-20 bg-white">

    <div class="text-center mb-16">
        <h2 class="text-5xl font-light tracking-tight text-black"><b>Our Global Diversity</b></h2>
      
    </div>

    <div class="grid md:grid-cols-12 gap-12 items-center">

        <!-- Globe -->
        <div class="md:col-span-5">
            <div class="flex justify-center">
                <img src="./image/globe.png" 
                     alt="Global Students" 
                     class="max-h-[420px] w-auto drop-shadow-sm">
            </div>
        </div>

        <!-- Right Side -->
        <div class="md:col-span-7">
            <div class="prose text-lg text-gray-700 leading-relaxed max-w-prose">
                Oscord Code Academy brings together students from Myanmar and many countries around the world. 
                Our flexible scheduling allows meaningful learning experiences across different time zones.
            </div>

            <!-- Chart -->
            <div class="mt-12">
                <h3 class="text-2xl font-light mb-8 text-black">Student Distribution by Country</h3>
                <div style="height: 420px;">
                    <canvas id="studentDiversityChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('studentDiversityChart').getContext('2d');
    const rawData = [128, 48, 89, 24, 19, 13, 11, 9, 8, 7, 6];
    const total = rawData.reduce((a, b) => a + b, 0);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Myanmar','Singapore','Thailand','Japan','Korea','Sweden','USA','Finland','Kuwait','Qatar','Vietnam'],
            datasets: [{
                label: 'Students',
                data: rawData,
                backgroundColor: [
                    '#1E40AF', '#D97706', '#10B981', '#7C3AED', '#DB2777',
                    '#0F766E', '#6366F1', '#EA580C', '#22D3EE', '#A78BFA', '#4ADE80'
                ],
                borderColor: '#ffffff',
                borderWidth: 2,
                borderRadius: 6,
                barThickness: 22,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${percentage}%`;
                        }
                    }
                },
                datalabels: {
                    color: '#ffffff',
                    font: { weight: 'bold', size: 13 },
                    anchor: 'end',
                    align: 'end',
                    offset: 8,
                    formatter: (value) => {
                        const percentage = ((value / total) * 100).toFixed(1);
                        return percentage + '%';
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { color: '#555', font: { size: 14 } },
                    grid: { color: '#f5f5f5' }
                },
                y: {
                    ticks: { color: '#222', font: { size: 15 } },
                    grid: { display: false }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
});
</script>