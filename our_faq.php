<?php
// oscord_faq.php - Two Column Layout (Left Title + Right Questions)
?>

<div class="max-w-6xl mx-auto px-6 py-20 bg-white">

    <div class="grid md:grid-cols-12 gap-16">

        <!-- LEFT COLUMN: Title + Chat Prompt -->
        <div class="md:col-span-5">
            <h1 class="text-5xl font-light tracking-tight text-black mb-6">Frequently Asked Questions</h1>
            
            <div class="mt-12">
                <p class="text-gray-500 mb-3">Can't find what you are looking for?</p>
                <h3 class="text-2xl font-light mb-6">We would like to chat with you.</h3>
                
                <a href="https://t.me/oscord_cs" target="_blank" 
                   class="inline-flex items-center gap-4 bg-black text-white px-8 py-5 rounded-2xl hover:bg-gray-800 transition-all">
                    <i class="fa-brands fa-telegram text-3xl"></i>
                    <span class="font-medium">Chat with us on Telegram</span>
                </a>
            </div>
        </div>

        <!-- RIGHT COLUMN: Search + Questions -->
        <div class="md:col-span-7">

            <!-- Search -->
            <div class="relative mb-10">
                <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="faq-search" 
                       class="w-full pl-14 pr-6 py-5 border border-gray-200 rounded-2xl focus:outline-none focus:border-black text-lg"
                       placeholder="What are you looking for?">
            </div>

            <!-- Questions List -->
            <div class="space-y-4" id="faq-accordion">

                <div class="faq-item border border-gray-100 rounded-3xl overflow-hidden">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center hover:bg-gray-50">
                        <span>Oscord မှာ Beginner တွေအတွက် ဘာသင်တန်းတွေရှိလဲ</span>
                        <span class="faq-icon text-2xl text-gray-400">+</span>
                    </button>
                    <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed burmese-text">
                        Oscord မှာ Programming စတင်လေ့လာမည့်သူများအတွက် Java Programming အတန်းနှင့် Python Programming (Basic to Advanced) အတန်းများရှိပါတယ်ခင်ဗျာ
                    </div>
                </div>

                <div class="faq-item border border-gray-100 rounded-3xl overflow-hidden">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center hover:bg-gray-50">
                        <span>Web Development ကိုအခြေခံမှစ၍ Project Development Level အထိသင်ယူချင်ရင် ဘယ် Course တွေကိုတက်ရောက်သင့်ပါသလဲ</span>
                        <span class="faq-icon text-2xl text-gray-400">+</span>
                    </button>
                    <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed burmese-text">
                        Oscord မှာ Web Development အတွက် Full Stack Developer Class လေးကနေစပြီးတက်ရောက်လိုရပါတယ် Full Stack အတန်းလေးပြီးရင် React + Laravel အတန်းလေး ထပ်မံတက်ရောက်နိုင်ပါတယ်
                    </div>
                </div>

                <div class="faq-item border border-gray-100 rounded-3xl overflow-hidden">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center hover:bg-gray-50">
                        <span>သင်တန်းပြီးရင် Certificate ပေးပါသလား</span>
                        <span class="faq-icon text-2xl text-gray-400">+</span>
                    </button>
                    <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed burmese-text">
                        မိမိတက်ရောက်သည့် အတန်းမှာ သတ်မှတ်ထားတဲ့ Assignment, Exam နှင့် Project တွေ Complete ဖြစ်ပြီး Instructor တွေဘက်မှလည်း သက်ဆိုင်ရာ Course ရဲ့အရည်အချင်းပြည့်မှီသည်ဟု ထောက်ခံချက်ပါပါက Digital Certificate လေး ပေးပါတယ်နော်
                    </div>
                </div>

                <div class="faq-item border border-gray-100 rounded-3xl overflow-hidden">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center hover:bg-gray-50">
                        <span>By One အတန်းအတွက်အတန်းချိန်ညှိနှိင်းပေးတာမျိုးရှိပါသလား</span>
                        <span class="faq-icon text-2xl text-gray-400">+</span>
                    </button>
                    <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed burmese-text">
                        By One အတန်းတိုင်းအတွက် အတန်းချိန်များညှိနှိင်းပေးပါတယ်
                    </div>
                </div>

                <div class="faq-item border border-gray-100 rounded-3xl overflow-hidden">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center hover:bg-gray-50">
                        <span>Data Science နှင့် Machine Learning Career အတွက် ဘယ် Course လေးတွေတတ်ရောက်သင့်ပါသလဲ</span>
                        <span class="faq-icon text-2xl text-gray-400">+</span>
                    </button>
                    <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed burmese-text">
                        Data Science, Machine Learning နှင့် AI modal engineering ပညာရပ်များအတွက် Oscord မှာ Python Programming (Basic to Advanced), Data Science Essential နှင့် Applied Mathematics အတန်းများရှိပါတယ်
                    </div>
                </div>

                <div class="faq-item border border-gray-100 rounded-3xl overflow-hidden">
                    <button class="faq-question w-full text-left px-8 py-6 flex justify-between items-center hover:bg-gray-50">
                        <span>သင်တန်းကြေးက တစ်လချင်းသွင်းရတာလား</span>
                        <span class="faq-icon text-2xl text-gray-400">+</span>
                    </button>
                    <div class="faq-answer hidden px-8 pb-8 text-gray-600 leading-relaxed burmese-text">
                        သင်တန်းကြေးက တစ်လချင်းသွင်းတာမျိုးမဟုတ်ပါခင်ဗျာ သက်ဆိုင်ရာ Course အတွက် သတ်မှတ်ထားသော သင်တန်းကြေးမှာ Course အစမှအဆုံးထိ အပြီးအစီးဖြစ်ပါတယ်
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('faq-search');
    const faqItems = document.querySelectorAll('.faq-item');

    searchInput.addEventListener('keyup', () => {
        const term = searchInput.value.toLowerCase().trim();
        faqItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = term === '' || text.includes(term) ? 'block' : 'none';
        });
    });

    // Accordion
    document.querySelectorAll('.faq-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const answer = btn.nextElementSibling;
            const icon = btn.querySelector('.faq-icon');
            const isOpen = !answer.classList.contains('hidden');

            document.querySelectorAll('.faq-answer').forEach(a => a.classList.add('hidden'));
            document.querySelectorAll('.faq-icon').forEach(i => i.textContent = '+');

            if (!isOpen) {
                answer.classList.remove('hidden');
                icon.textContent = '−';
            }
        });
    });
});
</script>

<style>
    .faq-answer, .burmese-text , .faq-question {
        line-height: 2.45 !important;
    }
    .faq-question:hover {
        background-color: #f9fafb;
    }
</style>