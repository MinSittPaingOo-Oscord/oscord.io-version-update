<?php
// oscord_certificate.php - Minimalist Black & White Design
?>

<div class="max-w-6xl mx-auto px-6 py-24 bg-white">

    <div class="grid md:grid-cols-12 gap-16 items-center">

        <!-- Left: Text Content -->
        <div class="md:col-span-6">
            <h1 class="text-5xl md:text-6xl font-light tracking-tight text-black mb-8 leading-none dxx">
                Certificate of Completion
            </h1>
            
            <div class="text-lg text-gray-700 leading-relaxed max-w-lg dxv" >
                <p>
                    At Oscord Code Academy, we award digital certificates to students who successfully complete all assignments, projects, and exams for each of our courses. 
                    Our training focuses on building your programming and software development skills through hands-on assignments, exams, and practical projects, with expert instructors guiding you throughout the entire course.
                </p>
            </div>

            <a href="courses.php" 
               class="mt-10 inline-block px-10 py-5 bg-black text-white rounded-2xl font-medium hover:bg-gray-800 transition-all">
                Start Learning →
            </a>
        </div>

        <!-- Right: Certificate Image -->
        <div class="md:col-span-6">
            <div class="flex justify-center">
                <img src="./image/certificate.png" 
                     alt="Oscord Code Academy Certificate"
                     class="max-w-full h-auto shadow-xl">
            </div>
        </div>

    </div>
</div>
<style>
    .dxv{
        line-height : 40px;
    }

    .dxx{
        line-height : 60px;
    }
</style>