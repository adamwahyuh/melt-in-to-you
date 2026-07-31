<x-layout title="{{ config('app.name') }}">
    
    <!-- BUNGKUS BARU: overflow-x-hidden agar web tidak bisa digeser ke kanan dan disesuaikan dengan tema gelap -->
    <div class="relative w-full min-h-screen overflow-x-hidden bg-[#160b04] flex items-center">
        
        {{-- Ambient floating dots (menjaga konsistensi dengan halaman login/register) --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
            
            <!-- Efek cahaya samar di sudut kanan atas -->
            <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[40%] bg-[#d89a4e]/10 blur-[120px] rounded-full"></div>
        </div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto px-6 py-12 lg:py-20">
            
            <!-- Kolom Kiri: Teks -->
            <div class="flex flex-col gap-6 md:gap-8 z-20">
                
                <!-- Tags/Badges -->
                <div class="flex flex-wrap gap-3 text-xs md:text-sm font-bold tracking-wider text-[#d89a4e] uppercase">
                    <span class="bg-[#d89a4e]/10 border border-[#d89a4e]/20 px-4 py-1.5 rounded-full backdrop-blur-sm">Freshly made</span>
                    <span class="bg-[#d89a4e]/10 border border-[#d89a4e]/20 px-4 py-1.5 rounded-full backdrop-blur-sm">Melt</span>
                    <span class="bg-[#d89a4e]/10 border border-[#d89a4e]/20 px-4 py-1.5 rounded-full backdrop-blur-sm">Premium</span>
                </div>

                <!-- Heading (Teks dengan gradien emas) -->
                <div class="leading-tight">
                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-amber-50 via-amber-100 to-[#d89a4e] drop-shadow-sm pb-2">
                        Melt in, to you
                    </h1>
                </div>

                <!-- Deskripsi (Baku, elegan, dan menggugah selera) -->
                <p class="text-lg md:text-xl text-amber-100/70 text-justify md:text-left leading-relaxed max-w-lg font-light">
                    Nikmati kelembutan es krim premium yang lumer di mulut sejak suapan pertama. Dibuat setiap hari dengan bahan-bahan pilihan berkualitas, diracik khusus untuk memberikan sensasi manis yang sempurna dan menyegarkan hari Anda.
                </p>

                <!-- Tombol CTA -->
                <div class="pt-2">
                    <a href="{{ route('page.menu') }}" 
                       class="group relative inline-flex items-center justify-center px-8 py-3.5 bg-gradient-to-r from-[#9b5000] to-[#d89a4e] text-[#2b1508] font-bold uppercase tracking-wider rounded-xl transition-all duration-300 hover:shadow-[0_0_25px_rgba(216,154,78,0.4)] hover:-translate-y-1 active:translate-y-0 overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">
                            Go to menu
                            <!-- Ikon Panah Berjalan saat Hover -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-300 group-hover:translate-x-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </a>
                </div>

            </div>

            <!-- Kolom Kanan: Gambar -->
            <div class="flex justify-center md:justify-end relative mt-8 md:mt-0 z-10">
                <!-- Backlight/Glow di belakang gambar agar es krim lebih menonjol -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[70%] h-[70%] bg-[#d89a4e]/20 blur-[80px] rounded-full pointer-events-none"></div>
                
                <!-- Gambar dengan animasi Float dan Hover Scale -->
                <img src="{{ asset('images/ice-cream.png') }}" 
                     alt="Es Krim {{ config('app.name') }}" 
                     class="relative w-[85%] sm:w-[70%] md:w-[110%] lg:w-[130%] max-w-none object-contain drop-shadow-[0_25px_35px_rgba(0,0,0,0.6)] animate-[float_5s_ease-in-out_infinite] transition-transform duration-700 hover:scale-105 cursor-pointer"
                >
            </div>
            
        </div>
        
    </div>

    <style>
        /* Animasi mengambang untuk ornamen dan es krim */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
    </style>
</x-layout>