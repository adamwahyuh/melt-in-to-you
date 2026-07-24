<x-layout title="Cup">
    <div class="min-h-screen bg-[#FFF9F2] py-10 md:py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            
            <!-- Header Keranjang -->
            <div class="mb-8 flex flex-col md:flex-row items-center md:items-start gap-4 text-center md:text-left">
                <div class="w-16 h-16 bg-[#F3D9B1] rounded-2xl flex items-center justify-center text-4xl shadow-sm shrink-0">
                    🍨
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#4A2C2A] tracking-tight">Cup Es Krim Kamu</h1>
                    <p class="text-[#8B7355] mt-1 text-lg">Cek kembali pilihan manismu sebelum memesan.</p>
                </div>
            </div>

            <!-- List Produk di dalam Cup -->
            <div class="space-y-5">
                @forelse ($cupDetails as $detail)
                    <div id="{{ $detail->id }}" class="bg-white rounded-2xl shadow-sm hover:shadow-lg border border-[#F0E0CC] p-4 flex flex-col md:flex-row items-center gap-5 transition-all duration-300 relative group">
                        
                        <!-- Gambar Produk -->
                        <div class="w-full md:w-28 h-40 md:h-28 shrink-0 overflow-hidden rounded-xl border border-[#F3D9B1] bg-[#FFF9F2]">
                            <img src="{{ $detail->product->foto_url }}" alt="{{ $detail->product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Info Produk -->
                        <div class="flex-grow text-center md:text-left w-full flex flex-col justify-center">
                            <h3 class="text-xl font-bold text-[#4A2C2A]">{{ $detail->product->name }}</h3>
                            <p class="text-[#8B5A4A] font-bold text-lg mt-1">
                                Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Aksi (Kuantitas & Hapus) -->
                        <div class="flex items-center gap-4 shrink-0 w-full md:w-auto justify-center mt-2 md:mt-0">
                            
                            <!-- Kontrol Kuantitas -->
                            <div class="flex items-center justify-between border-2 border-[#F3D9B1] rounded-xl overflow-hidden bg-white shrink-0 shadow-sm">
                                <!-- Form Kurang 1 -->
                                <form action="{{ route('post.cup.subtract_one_from_cup', $detail->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-11 h-11 flex items-center justify-center text-[#8B5A4A] hover:bg-[#F3D9B1] hover:text-[#4A2C2A] transition-colors duration-200 font-bold text-xl active:bg-[#E8C9A0]" title="Kurangi 1">
                                        &minus;
                                    </button>
                                </form>
                                
                                <!-- Angka Jumlah -->
                                <div class="w-10 text-center text-[#4A2C2A] font-extrabold text-lg select-none">
                                    {{ $detail->quantity }}
                                </div>

                                <!-- Form Tambah 1 -->
                                <form action="{{ route('post.cup.increase_one_to_cup', $detail->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-11 h-11 flex items-center justify-center text-[#8B5A4A] hover:bg-[#F3D9B1] hover:text-[#4A2C2A] transition-colors duration-200 font-bold text-xl active:bg-[#E8C9A0]" title="Tambah 1">
                                        &plus;
                                    </button>
                                </form>
                            </div>

                            <!-- Tombol Hapus (Opsional jika Anda sudah punya route delete_cup_detail) -->
                            <form action="{{ route('delete.cup.delete_cup_detail', $detail->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-11 h-11 flex items-center justify-center bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-colors duration-200 shadow-sm" title="Hapus Item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </div>
                @empty
                    <!-- Tampilan jika Cup kosong -->
                    <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-[#D2A679] shadow-sm">
                        <div class="text-7xl mb-4 animate-bounce">🥄</div>
                        <h3 class="text-2xl font-bold text-[#4A2C2A]">Cup kamu masih kosong!</h3>
                        <p class="text-[#8B7355] mt-2 mb-8 text-lg">Yuk, isi dengan es krim favoritmu sekarang.</p>
                        <a href="{{ route('page.home') }}" class="inline-flex items-center gap-2 bg-[#D2A679] hover:bg-[#C19660] text-white font-bold py-3 px-8 rounded-full transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Lihat Menu Es Krim
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Bagian Checkout / Order -->
            @if(count($cupDetails) > 0)
                <div class="mt-10 bg-white rounded-3xl shadow-lg border border-[#F3D9B1] p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
                    
                    <!-- Dekorasi Background Checkout -->
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-[#F3D9B1]/30 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="text-center md:text-left w-full md:w-auto flex-grow relative z-10">
                        <h3 class="text-sm font-bold text-[#8B7355] uppercase tracking-wider mb-1">Total Pembayaran</h3>
                        <div class="text-3xl md:text-4xl font-black text-[#8B5A4A]">
                            Rp {{ number_format($cup->total_harga ?? 0, 0, ',', '.') }}
                        </div>
                    </div>

                    <form action="{{ route('post.order.transfer_cup_to_order') }}" method="POST" class="w-full md:w-auto relative z-10">
                        @csrf
                        <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 bg-[#8B5A4A] hover:bg-[#6A4135] text-white font-bold py-3.5 px-10 rounded-2xl transition-all duration-300 shadow-md hover:shadow-xl active:scale-95 text-lg group">
                            <span>Pesan Sekarang</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</x-layout>