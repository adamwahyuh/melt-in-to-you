<x-layout title="Login">
    <div class="relative min-h-screen flex items-center justify-center px-4 py-10 overflow-hidden">

        {{-- ambient chocolate chip dots --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
        </div>

        <div class="relative z-10 w-full max-w-4xl">

            {{-- scalloped "cup rim" sitting on top of the card --}}
            <div class="scallop-rim mx-6"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 rounded-b-[2rem] overflow-hidden border border-amber-100/10 shadow-2xl shadow-black/50 bg-[#2b1508]/60 backdrop-blur-xl">

                {{-- image side --}}
                <div class="order-1 md:order-none relative flex flex-col items-center justify-center gap-4 bg-gradient-to-b from-[#3b1f0e] to-[#160b04] px-8 py-8 md:py-14">
                    <img
                        src="{{ asset('images/ice-cream.png') }}"
                        alt="Es krim coklat"
                        class="w-32 md:w-56 drop-shadow-[0_18px_25px_rgba(0,0,0,0.45)] animate-[float_4s_ease-in-out_infinite]"
                    >
                    <div class="text-center">
                        <p class="font-semibold text-amber-50 tracking-wide">SistemSurat</p>
                        <p class="text-xs text-amber-100/50 mt-1">Manis dan rapi, seperti suratmu</p>
                    </div>
                </div>

                {{-- form side --}}
                <div class="order-2 px-8 py-10 sm:px-12 sm:py-14 flex flex-col justify-center">

                    <h1 class="text-2xl font-semibold text-amber-50">Selamat datang kembali</h1>
                    <p class="text-sm text-amber-100/50 mb-8">Masuk untuk lanjut kelola suratmu</p>

                    @if ($errors->any())
                        <div class="mb-5 rounded-xl border border-red-400/30 bg-red-400/10 px-4 py-3 text-sm text-red-200">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Tambahkan id="loginForm" -->
                    <form id="loginForm" action="{{ route('post.login') }}" method="POST" class="flex flex-col gap-5">
                        @csrf

                        <div>
                            <label for="username" class="text-xs uppercase tracking-wide text-amber-100/60">Username</label>
                            <input
                                id="username"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                autocomplete="username"
                                class="mt-1.5 w-full rounded-xl border border-amber-100/10 bg-black/20 px-4 py-3 text-amber-50 placeholder-amber-100/30 outline-none transition focus:border-[#d89a4e] focus:ring-2 focus:ring-[#d89a4e]/30"
                            >
                            @error('username')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="text-xs uppercase tracking-wide text-amber-100/60">Password</label>
                            <div class="relative mt-1.5">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    autocomplete="current-password"
                                    class="w-full rounded-xl border border-amber-100/10 bg-black/20 px-4 py-3 pr-11 text-amber-50 placeholder-amber-100/30 outline-none transition focus:border-[#d89a4e] focus:ring-2 focus:ring-[#d89a4e]/30"
                                >
                                <!-- Tambahkan id="togglePasswordBtn" -->
                                <button
                                    id="togglePasswordBtn"
                                    type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-100/40 hover:text-amber-100 transition"
                                    tabindex="-1"
                                >
                                    <!-- Ikon mata terbuka (default tampil) -->
                                    <svg id="iconEyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12S6 5 12 5s9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                    <!-- Ikon mata tertutup/coret (default sembunyi) -->
                                    <svg id="iconEyeClosed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.7a3 3 0 0 0 4.24 4.24M6.5 6.7C4 8.3 2.5 12 2.5 12s3.5 7 9.5 7c1.8 0 3.3-.5 4.6-1.3M17.6 17.6C19.9 15.9 21.5 12 21.5 12s-1.3-2.6-3.7-4.5" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-2 text-xs text-amber-100/50 select-none">
                            <input type="checkbox" name="remember" class="rounded border-amber-100/20 bg-black/20 text-[#d89a4e] focus:ring-[#d89a4e]/40">
                            Ingat saya
                        </label>

                        <!-- Tambahkan id="submitBtn" -->
                        <button
                            id="submitBtn"
                            type="submit"
                            class="relative mt-2 rounded-xl bg-gradient-to-r from-[#9b5000] to-[#d89a4e] py-3 font-semibold text-[#2b1508] transition hover:shadow-lg hover:shadow-[#d89a4e]/25 active:scale-[0.98] disabled:opacity-70"
                        >
                            <span id="btnText">Masuk</span>
                            <span id="btnLoading" class="hidden items-center justify-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:0ms"></span>
                                <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:150ms"></span>
                                <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:300ms"></span>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .scallop-rim {
            height: 18px;
            background:
                radial-gradient(circle at 10px 0, transparent 10px, #2b1508 10px) top left / 20px 20px repeat-x;
        }
    </style>

    <!-- PURE JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua elemen yang dibutuhkan
            const form = document.getElementById('loginForm');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const iconEyeOpen = document.getElementById('iconEyeOpen');
            const iconEyeClosed = document.getElementById('iconEyeClosed');
            
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');

            // Logika Toggle Password
            togglePasswordBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    iconEyeOpen.classList.add('hidden');
                    iconEyeClosed.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    iconEyeOpen.classList.remove('hidden');
                    iconEyeClosed.classList.add('hidden');
                }
            });

            // Logika Animasi Loading saat Submit
            form.addEventListener('submit', function () {
                // Matikan tombol agar tidak di-klik 2x
                submitBtn.disabled = true;
                
                // Sembunyikan teks "Masuk" dan tampilkan animasi loading
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
                btnLoading.classList.add('flex'); // Tambahkan flex agar titik-titiknya sejajar
            });
        });
    </script>
</x-layout>