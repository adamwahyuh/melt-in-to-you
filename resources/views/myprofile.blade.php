<x-layout title="Profil - {{ $user->name }}">
    <div class="relative min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center overflow-hidden bg-[#160b04]">
        
        {{-- ambient chocolate chip dots --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
        </div>

        <div class="relative z-10 w-full max-w-5xl">
            
            {{-- scalloped "cup rim" sitting on top of the card --}}
            <div class="scallop-rim mx-6"></div>

            <div class="rounded-b-[2rem] overflow-hidden border border-amber-100/10 shadow-2xl shadow-black/80 bg-[#2b1508]/80 backdrop-blur-xl p-6 md:p-10">
                
                <!-- Bagian Profil Info -->
                <div class="bg-black/30 border border-amber-100/10 rounded-2xl p-6 md:p-8 mb-10 flex flex-col sm:flex-row items-center sm:items-start gap-6 relative overflow-hidden transition-all duration-300 hover:border-amber-100/20">
                    
                    <!-- Initials (Bentuk Lingkaran/Foto Profil) -->
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#9b5000] to-[#d89a4e] text-[#2b1508] flex items-center justify-center text-3xl font-bold uppercase shadow-lg shadow-[#d89a4e]/20 shrink-0">
                        {{ $user->initials }}
                    </div>
                    
                    <!-- Detail User -->
                    <div class="text-center sm:text-left mt-2 sm:mt-2">
                        <h1 class="text-2xl md:text-3xl font-bold text-amber-50 tracking-wide">{{ $user->name }}</h1>
                        <p class="text-amber-100/60 mt-1.5 font-medium flex items-center justify-center sm:justify-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d89a4e]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            {{ $user->email }}
                        </p>
                    </div>
                </div>

                <!-- Bagian Daftar Alamat -->
                <div>
                    <!-- Header Alamat & Tombol Tambah -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 border-b border-amber-100/10 pb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#d89a4e]/10 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#d89a4e]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-amber-50">Daftar Alamat</h2>
                        </div>
                        
                        <a href="{{ route('page.address.create', $user->username) }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-[#9b5000] to-[#d89a4e] hover:shadow-[0_0_15px_rgba(216,154,78,0.4)] text-[#2b1508] text-sm font-semibold rounded-xl shadow-sm transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Alamat
                        </a>
                    </div>

                    <!-- Grid Kartu Alamat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($user->addresses as $address)
                            <div class="relative border rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:shadow-black/50 {{ $address->is_active ? 'border-[#d89a4e] bg-[#d89a4e]/10' : 'border-amber-100/10 bg-black/30 hover:border-amber-100/30' }}">
                                
                                <!-- Badge Aktif -->
                                @if ($address->is_active)
                                    <span class="absolute top-5 right-5 bg-gradient-to-r from-[#9b5000] to-[#d89a4e] text-[#2b1508] text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                        Utama
                                    </span>
                                @endif

                                <!-- Detail Alamat -->
                                <div class="mb-5 pr-16">
                                    <p class="text-amber-50 font-semibold mb-2 text-lg leading-snug">{{ $address->alamat }}</p>
                                    <p class="text-amber-100/60 text-sm mb-1">RT {{ $address->rt }} / RW {{ $address->rw }}</p>
                                    <p class="text-amber-100/60 text-sm mb-2">{{ $address->kelurahan }}, {{ $address->kecamatan }}</p>
                                    <p class="text-[#d89a4e] font-medium text-sm inline-block bg-black/40 px-2.5 py-1 rounded-lg border border-amber-100/5">{{ $address->kota }} - {{ $address->kode_pos }}</p>
                                </div>

                                <!-- Aksi (Edit & Set Utama) -->
                                <div class="mt-4 pt-4 border-t {{ $address->is_active ? 'border-[#d89a4e]/20' : 'border-amber-100/10' }} flex items-center justify-between gap-3">
                                    <a href="{{ route('page.address.edit', $address->id) }}" class="text-sm font-semibold text-[#d89a4e] hover:text-[#f3b973] transition-colors flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Tombol Jadikan Utama -->
                                    @if (!$address->is_active)
                                        <form action="{{ route('put.address.change_active_address', $address->id) }}" method="POST" class="m-0">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="text-xs sm:text-sm font-medium text-amber-100/60 bg-black/40 hover:bg-[#d89a4e]/20 hover:text-[#d89a4e] py-1.5 px-3 rounded-lg transition-colors border border-amber-100/5 hover:border-[#d89a4e]/30">
                                                Jadikan Utama
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <!-- Tampilan jika tidak ada alamat -->
                            <div class="col-span-1 md:col-span-2 text-center py-12 bg-black/20 border border-dashed border-amber-100/20 rounded-2xl">
                                <div class="mx-auto w-16 h-16 bg-black/40 rounded-full flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-100/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <p class="text-amber-100/60 font-medium text-sm">Belum ada alamat yang tersimpan.</p>
                            </div>
                        @endforelse
                    </div>
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
</x-layout>