<x-layout title="Cup">
    <div class="relative min-h-screen bg-[#160b04] overflow-x-hidden py-10 md:py-16">
        
        {{-- Ambient floating dots & glow --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden z-0">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
            <div class="absolute top-[20%] left-[-10%] w-[30%] h-[30%] bg-[#d89a4e]/10 blur-[120px] rounded-full"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 sm:px-6 max-w-4xl">
            
            <!-- Header Keranjang -->
            <div class="mb-10 flex flex-col md:flex-row items-center md:items-start gap-5 text-center md:text-left">
                <div class="w-16 h-16 bg-gradient-to-br from-[#9b5000] to-[#d89a4e] rounded-2xl flex items-center justify-center text-4xl shadow-lg shadow-[#d89a4e]/20 shrink-0">
                    🍨
                </div>
                <div class="pt-1">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-amber-50 via-amber-100 to-[#d89a4e] tracking-tight pb-1">
                        Cup Es Krim Kamu
                    </h1>
                    <p class="text-amber-100/60 mt-1 text-lg font-light">Cek kembali pilihan manismu sebelum memesan.</p>
                </div>
            </div>

            <!-- List Produk di dalam Cup -->
            <div class="space-y-6">
                @forelse ($cupDetails as $detail)
                    <div id="{{ $detail->id }}" class="bg-black/30 rounded-3xl shadow-lg border border-amber-100/10 p-5 flex flex-col md:flex-row items-center gap-6 transition-all duration-300 hover:border-amber-100/30 hover:bg-black/40 backdrop-blur-md relative group">
                        
                        <!-- Gambar Produk -->
                        <div class="w-full md:w-32 h-48 md:h-32 shrink-0 overflow-hidden rounded-2xl border border-amber-100/10 bg-black/50">
                            <img src="{{ $detail->product->foto_url }}" alt="{{ $detail->product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>

                        <!-- Info Produk -->
                        <div class="flex-grow text-center md:text-left w-full flex flex-col justify-center">
                            <h3 class="text-2xl font-bold text-amber-50 group-hover:text-[#d89a4e] transition-colors duration-300">{{ $detail->product->name }}</h3>
                            <p class="text-[#d89a4e] font-bold text-lg mt-1 drop-shadow-sm">
                                Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Aksi (Kuantitas & Hapus) -->
                        <div class="flex items-center gap-4 shrink-0 w-full md:w-auto justify-center mt-4 md:mt-0">
                            
                            <!-- Kontrol Kuantitas -->
                            <div class="flex items-center justify-between border border-amber-100/10 rounded-xl overflow-hidden bg-black/40 shrink-0 shadow-sm transition-colors focus-within:border-[#d89a4e]/50">
                                <!-- Form Kurang 1 -->
                                <form action="{{ route('post.cup.subtract_one_from_cup', $detail->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-11 h-11 flex items-center justify-center text-amber-100/60 hover:bg-[#d89a4e]/20 hover:text-[#d89a4e] transition-colors duration-200 font-bold text-xl active:scale-95" title="Kurangi 1">
                                        &minus;
                                    </button>
                                </form>
                                
                                <!-- Angka Jumlah -->
                                <div class="w-10 text-center text-amber-50 font-extrabold text-lg select-none">
                                    {{ $detail->quantity }}
                                </div>

                                <!-- Form Tambah 1 -->
                                <form action="{{ route('post.cup.increase_one_to_cup', $detail->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-11 h-11 flex items-center justify-center text-amber-100/60 hover:bg-[#d89a4e]/20 hover:text-[#d89a4e] transition-colors duration-200 font-bold text-xl active:scale-95" title="Tambah 1">
                                        &plus;
                                    </button>
                                </form>
                            </div>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('delete.cup.delete_cup_detail', $detail->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-11 h-11 flex items-center justify-center bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-colors duration-200 shadow-sm active:scale-95" title="Hapus Item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </div>
                @empty
                    <!-- Tampilan jika Cup kosong -->
                    <div class="text-center py-20 bg-black/30 rounded-3xl border border-dashed border-amber-100/20 shadow-sm backdrop-blur-sm">
                        <div class="text-7xl mb-6 opacity-80 animate-bounce">🥄</div>
                        <h3 class="text-2xl font-bold text-amber-50">Cup kamu masih kosong!</h3>
                        <p class="text-amber-100/60 mt-2 mb-8 text-lg font-light">Yuk, isi dengan es krim favoritmu sekarang.</p>
                        <a href="{{ route('page.home') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#9b5000] to-[#d89a4e] hover:shadow-[0_0_20px_rgba(216,154,78,0.4)] text-[#2b1508] font-bold py-3.5 px-8 rounded-full transition-all duration-300 hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Lihat Menu Es Krim
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Bagian Checkout / Order -->
            @if(count($cupDetails) > 0)
                <div class="mt-10 bg-black/30 rounded-3xl shadow-xl border border-[#d89a4e]/30 p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden backdrop-blur-xl">
                    
                    <!-- Dekorasi Background Checkout -->
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#d89a4e]/20 rounded-full blur-[80px] pointer-events-none"></div>

                    <div class="text-center md:text-left w-full md:w-auto flex-grow relative z-10">
                        <h3 class="text-sm font-semibold text-amber-100/60 uppercase tracking-widest mb-1">Total Pembayaran</h3>
                        <div class="text-3xl md:text-4xl font-black text-[#d89a4e] drop-shadow-sm">
                            Rp {{ number_format($cup->total_harga ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <form action="{{ route('post.order.transfer_cup_to_order') }}" method="POST" class="w-full md:w-auto relative z-10">
                        @csrf
                        <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 bg-gradient-to-r from-[#9b5000] to-[#d89a4e] text-[#2b1508] font-bold py-4 px-10 rounded-2xl transition-all duration-300 hover:shadow-[0_0_25px_rgba(216,154,78,0.4)] hover:-translate-y-1 active:translate-y-0 text-lg group">
                            <span>Pesan Sekarang</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>

    <!-- Animasi Float -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</x-layout>