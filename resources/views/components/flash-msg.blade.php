@if (session('success') || session('error'))
<div id="flash-message-container" class="fixed top-6 right-4 sm:right-6 z-[9999] w-full max-w-sm flex flex-col gap-4 pointer-events-none">

    @if (session('success'))
        <div
            class="flash-message pointer-events-auto opacity-0 translate-x-10 transition-all duration-300 relative overflow-hidden bg-black/60 backdrop-blur-xl border border-emerald-500/30 shadow-[0_8px_30px_rgba(16,185,129,0.15)] rounded-2xl p-4 sm:p-5 flex items-start gap-4"
        >
            <!-- Ikon Berhasil -->
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <!-- Teks -->
            <div class="flex-1 pt-0.5">
                <p class="text-base font-bold text-emerald-400 tracking-wide">Berhasil</p>
                <p class="text-sm text-amber-100/70 mt-0.5 leading-relaxed">{{ session('success') }}</p>
            </div>
            
            <!-- Tombol Tutup -->
            <button type="button" class="flash-close text-amber-100/40 hover:text-amber-50 hover:bg-white/10 p-1.5 rounded-lg transition-colors duration-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Progress Bar Mengikuti Tema -->
            <div class="flash-progress absolute bottom-0 left-0 h-1 bg-gradient-to-r from-emerald-600 to-teal-400 w-full shadow-[0_-2px_10px_rgba(16,185,129,0.5)]"></div>
        </div>
    @endif

    @if (session('error'))
        <div
            class="flash-message pointer-events-auto opacity-0 translate-x-10 transition-all duration-300 relative overflow-hidden bg-black/60 backdrop-blur-xl border border-rose-500/30 shadow-[0_8px_30px_rgba(244,63,94,0.15)] rounded-2xl p-4 sm:p-5 flex items-start gap-4"
        >
            <!-- Ikon Gagal -->
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-rose-500/10 flex items-center justify-center border border-rose-500/20 shadow-[0_0_15px_rgba(244,63,94,0.2)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            
            <!-- Teks -->
            <div class="flex-1 pt-0.5">
                <p class="text-base font-bold text-rose-400 tracking-wide">Gagal</p>
                <p class="text-sm text-amber-100/70 mt-0.5 leading-relaxed">{{ session('error') }}</p>
            </div>
            
            <!-- Tombol Tutup -->
            <button type="button" class="flash-close text-amber-100/40 hover:text-amber-50 hover:bg-white/10 p-1.5 rounded-lg transition-colors duration-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Progress Bar Mengikuti Tema -->
            <div class="flash-progress absolute bottom-0 left-0 h-1 bg-gradient-to-r from-rose-600 to-red-400 w-full shadow-[0_-2px_10px_rgba(244,63,94,0.5)]"></div>
        </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const duration = 5000; // 5 detik
        const messages = document.querySelectorAll('.flash-message');

        messages.forEach(function (msg) {
            // Animasi masuk yang mulus
            requestAnimationFrame(() => {
                setTimeout(() => {
                    msg.classList.remove('opacity-0', 'translate-x-10');
                }, 50); // Sedikit jeda agar transisi Tailwind merender dengan baik
            });

            // Animasi progress bar menyusut
            const progressBar = msg.querySelector('.flash-progress');
            if (progressBar) {
                progressBar.style.transition = `width ${duration}ms linear`;
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        progressBar.style.width = '0%';
                    }, 50);
                });
            }

            // Auto hilang setelah 5 detik
            const timeout = setTimeout(() => {
                closeMessage(msg);
            }, duration);

            // Tombol close manual
            const closeBtn = msg.querySelector('.flash-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    clearTimeout(timeout);
                    closeMessage(msg);
                });
            }
        });

        function closeMessage(msg) {
            msg.classList.add('opacity-0', 'translate-x-10');
            setTimeout(() => {
                msg.remove();
            }, 300);
        }
    });
</script>
@endif