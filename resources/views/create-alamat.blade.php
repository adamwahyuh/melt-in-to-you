<x-layout title="Alamat {{ $user->name }}">
    <div class="relative min-h-screen flex  justify-center overflow-hidden mt-10">

        {{-- ambient chocolate chip dots --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
        </div>

        <div class="relative z-10 w-full max-w-4xl px-4 sm:px-6">
            
            {{-- scalloped "cup rim" sitting on top of the card --}}
            <div class="scallop-rim mx-6"></div>

            <!-- Card Container -->
            <div class="rounded-b-[2rem] overflow-hidden border border-amber-100/10 shadow-2xl shadow-black/80 bg-[#2b1508]/80 backdrop-blur-xl">
                
                <!-- Header Section -->
                <div class="px-8 py-6 sm:px-10 sm:py-8 border-b border-amber-100/10 bg-gradient-to-b from-[#3b1f0e]/60 to-transparent">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#9b5000] to-[#d89a4e] flex items-center justify-center shadow-lg shadow-[#d89a4e]/20">
                            <svg class="w-6 h-6 text-[#2b1508]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-amber-50">Detail Alamat</h2>
                            <p class="text-sm text-amber-100/60 mt-1">Silakan lengkapi informasi alamat pengiriman untuk <span class="font-semibold text-[#d89a4e]">{{ $user->name }}</span>.</p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="px-8 py-8 sm:px-10 sm:py-10">
                    <form id="addressForm" action="{{ route('post.address.store', Auth::id()) }}" method="POST" class="flex flex-col">
                        @csrf
                        
                        <!-- Grid untuk field pendek (RT & RW) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                            <x-form.input type="number" name="rt" label="RT" required />
                            <x-form.input type="number" name="rw" label="RW" required />
                        </div>

                        <!-- Grid untuk wilayah administratif -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                            <x-form.input name="kelurahan" label="Kelurahan / Desa" required />
                            <x-form.input name="kecamatan" label="Kecamatan" required />
                        </div>

                        <!-- Grid untuk Kota dan Kode Pos -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                            <x-form.input name="kota" label="Kota / Kabupaten" required />
                            <x-form.input type="number" name="kode_pos" label="Kode Pos" required />
                        </div>

                        <!-- Full width untuk alamat lengkap -->
                        <x-form.input name="alamat" label="Alamat Lengkap (Nama Jalan, Gedung, No. Rumah)" required />

                        <!-- Action Button -->
                        <div class="pt-2 flex justify-end">
                            <button 
                                id="submitBtn"
                                type="submit" 
                                class="relative rounded-xl bg-gradient-to-r from-[#9b5000] to-[#d89a4e] px-8 py-3.5 font-semibold text-[#2b1508] transition-all duration-300 hover:shadow-[0_0_20px_rgba(216,154,78,0.3)] hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed flex items-center justify-center min-w-[200px]"
                            >
                                <div id="btnText" class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Simpan Alamat
                                </div>
                                <span id="btnLoading" class="hidden items-center justify-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:0ms"></span>
                                    <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:150ms"></span>
                                    <span class="h-2 w-2 rounded-full bg-[#2b1508] animate-bounce" style="animation-delay:300ms"></span>
                                </span>
                            </button>
                        </div>
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
                radial-gradient(circle at 10px 0, transparent 10px, rgba(43, 21, 8, 0.8) 10px) top left / 20px 20px repeat-x;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('addressForm');
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