<!-- OUR IMPACT - Minimalist Black & White -->
<div class="py-20 bg-white border-t border-b">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-light text-center mb-16 tracking-tight">Our Impact</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Courses -->
            <div class="text-center">
                <div class="text-7xl font-light text-black mb-3">13</div>
                <div class="uppercase tracking-widest text-sm text-gray-500">Courses Offered</div>
            </div>
            
            <!-- Students -->
            <div class="text-center">
                <?php
                $studentCount = 0;
                if ($conn) {
                    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM student");
                    if ($res) {
                        $row = mysqli_fetch_assoc($res);
                        $studentCount = (int)$row['total'];
                    }
                }
                $displayStudents = $studentCount + 200;   // Add 200 as requested
                ?>
                <div class="text-7xl font-light text-black mb-3"><?= number_format($displayStudents) ?></div>
                <div class="uppercase tracking-widest text-sm text-gray-500">Students Enrolled</div>
            </div>
            
            <!-- Videos -->
            <div class="text-center">
                <div class="text-7xl font-light text-black mb-3">4</div>
                <div class="uppercase tracking-widest text-sm text-gray-500">Instructors</div>
            </div>
            
        </div>
    </div>
</div>