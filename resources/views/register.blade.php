<x-layout title="Daftar">
    <div class="relative min-h-screen flex mt-20 justify-center overflow-hidden">

        {{-- ambient chocolate chip dots --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
        </div>

        <div class="relative z-10 w-full max-w-5xl px-4 sm:px-6">

            {{-- scalloped "cup rim" sitting on top of the card --}}
            <div class="scallop-rim mx-6"></div>

            <div class="grid grid-cols-1 md:grid-cols-5 rounded-b-[2rem] overflow-hidden border border-amber-100/10 shadow-2xl shadow-black/80 bg-[#2b1508]/80 backdrop-blur-xl">

                {{-- image side (ambil 2 kolom dari 5) --}}
                <div class="md:col-span-2 order-1 md:order-none relative flex flex-col items-center justify-center gap-4 bg-gradient-to-b from-[#3b1f0e] to-[#160b04] px-8 py-10 md:py-14">
                    <img
                        src="{{ asset('images/ice-cream.png') }}"
                        alt="Es krim coklat"
                        class="w-32 md:w-56 drop-shadow-[0_18px_25px_rgba(0,0,0,0.5)] animate-[float_4s_ease-in-out_infinite]"
                    >
                    <div class="text-center mt-4">
                        <p class="font-bold text-xl text-amber-50 tracking-widest uppercase">{{ config('app.name', 'NAMA APP') }}</p>
                    </div>
                </div>

                {{-- form side (ambil 3 kolom dari 5 agar form lebih luas) --}}
                <div class="md:col-span-3 order-2 px-6 py-10 sm:px-10 flex flex-col justify-center">

                    <div class="mb-6">
                        <h1 class="text-2xl font-semibold text-amber-50">Daftar Akun</h1>
                        <p class="text-amber-100/60 text-sm mt-1">Buat akun baru untuk memulai</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-400/30 bg-red-400/10 px-4 py-3 text-sm text-red-200 backdrop-blur-sm">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form id="registerForm" action="{{ route('post.register') }}" method="POST" class="flex flex-col gap-4">
                        @csrf

                        <!-- Baris 1: Nama & Username (Sejajar di desktop) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-form.input name="name" label="Nama Anda" required />
                            <x-form.input name="username" label="Username" required />
                        </div>

                        <!-- Baris 2: Email (Full width) -->
                        <x-form.input name="email" label="Email" required />

                        <!-- Baris 3: Password & Konfirmasi (Sejajar di desktop) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-form.input name="password" type="password" label="Password" required />
                            <x-form.input name="password_confirmation" type="password" label="Masukan password sekali lagi" required />
                        </div>

                        <button
                            id="submitBtn"
                            type="submit"
                            class="relative mt-4 rounded-xl bg-gradient-to-r from-[#9b5000] to-[#d89a4e] py-3.5 font-semibold text-[#2b1508] transition-all duration-300 hover:shadow-[0_0_20px_rgba(216,154,78,0.3)] hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed"
                        >
                            <span id="btnText">Daftar</span>
                            <span id="btnLoading" class="hidden items-center justify-center gap-1.5">
                                <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:0ms"></span>
                                <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:150ms"></span>
                                <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:300ms"></span>
                            </span>
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-amber-100/60">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#d89a4e] hover:text-[#f3b973] hover:underline transition-colors focus:outline-none focus:ring-2 focus:ring-[#d89a4e]/50 rounded px-1">
                            Login di sini
                        </a>
                    </p>
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
                radial-gradient(circle at 10px 0, transparent 10px, rgba(43, 21, 8, 0.8) 10px) top left / 20px 20px repeat-x;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Animasi Loading Submit saja (Script toggle password dihapus karena menggunakan komponen bawaan)
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');

            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
                btnLoading.classList.add('flex');
            });
        });
    </script>
</x-layout>