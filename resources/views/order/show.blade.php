<x-layout title="Detail Pesanan">
    <div class="relative min-h-screen bg-[#160b04] overflow-x-hidden py-10 md:py-16">
        
        {{-- Ambient floating dots & glow --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden z-0">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
            <div class="absolute top-[5%] right-[-10%] w-[30%] h-[30%] bg-[#d89a4e]/10 blur-[120px] rounded-full"></div>
        </div>

        <!-- Container Pembatas Lebar Konten -->
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6">
            
            <!-- Tombol Kembali -->
            <a href="{{ route('page.order.index') }}" class="inline-flex items-center text-sm font-medium text-amber-100/60 hover:text-[#d89a4e] mb-6 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Pesanan
            </a>

            <!-- Header Halaman Detail -->
            <div class="mb-8 border-b border-amber-100/10 pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-amber-50 via-amber-100 to-[#d89a4e] tracking-tight pb-1">
                        Detail Pesanan
                    </h1>
                    <p class="text-amber-100/60 mt-2 text-sm font-light">
                        ID Pesanan: <span class="font-bold text-[#d89a4e] tracking-wider">#{{ $order->id }}</span>
                    </p>
                </div>
                <div>
                    <!-- Badge Status -->
                    <span class="inline-flex px-4 py-1.5 text-xs font-bold uppercase tracking-wider rounded-full bg-[#d89a4e]/10 text-[#d89a4e] border border-[#d89a4e]/20 shadow-sm backdrop-blur-sm">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <!-- Card 1: Informasi Pesanan Utama -->
            <div class="bg-black/30 rounded-2xl border border-amber-100/10 p-6 md:p-8 shadow-lg backdrop-blur-md mb-8">
                <h3 class="text-lg font-bold text-amber-50 mb-5 border-b border-amber-100/10 pb-3">Informasi Pesanan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-amber-100/60 uppercase tracking-wider mb-1.5">Tanggal Pemesanan</p>
                        <p class="text-sm font-medium text-amber-50">
                            {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l, d F Y - H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Daftar Produk -->
            <div class="bg-black/30 rounded-2xl border border-amber-100/10 shadow-lg backdrop-blur-md overflow-hidden mb-8">
                <div class="bg-black/40 px-6 md:px-8 py-5 border-b border-amber-100/10">
                    <h3 class="text-lg font-bold text-amber-50">Daftar Produk</h3>
                </div>
                
                <div class="divide-y divide-amber-100/10">
                    @foreach ($order->details as $detail)
                        <div class="p-6 md:px-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:bg-black/40 transition-colors duration-300">
                            
                            <!-- Info Produk -->
                            <div class="flex items-start gap-5">
                                <div class="w-14 h-14 rounded-xl bg-[#d89a4e]/10 border border-[#d89a4e]/20 flex items-center justify-center shrink-0 text-[#d89a4e]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-amber-50">{{ $detail->product->name }}</h4>
                                    <p class="text-sm text-amber-100/60 mt-1.5 flex items-center gap-2 font-light">
                                        <span class="font-bold text-[#d89a4e] bg-[#d89a4e]/20 border border-[#d89a4e]/10 px-2 py-0.5 rounded-md text-xs">
                                            {{ $detail->quantity }}x
                                        </span> 
                                        @if($detail->quantity > 0)
                                            Rp {{ number_format($detail->sub_total / $detail->quantity, 0, ',', '.') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Subtotal Per Produk -->
                            <div class="text-left sm:text-right w-full sm:w-auto pl-19 sm:pl-0">
                                <p class="text-base font-bold text-[#d89a4e] drop-shadow-sm">
                                    Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                </p>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Card 3 & Aksi Tombol -->
            <div class="flex flex-col items-end">
                <!-- Rincian Pembayaran -->
                <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 bg-black/30 rounded-2xl border border-amber-100/10 p-6 shadow-lg backdrop-blur-md mb-6 relative overflow-hidden">
                    
                    <h3 class="text-lg font-bold text-amber-50 mb-4 border-b border-amber-100/10 pb-3 relative z-10">Rincian Pembayaran</h3>
                    
                    <div class="space-y-3 relative z-10">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-amber-100/60 font-medium">Subtotal Produk</span>
                            <span class="font-semibold text-amber-50">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-amber-100/10 mt-4">
                            <span class="text-base font-bold text-amber-50">Total Belanja</span>
                            <span class="text-xl font-black text-[#d89a4e] drop-shadow-sm">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi (Tampil jika status Sedang Dikirim) -->
                @if(strtolower($order->status) === 'sedang dikirim')
                    <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3">
                        <form action="{{ route('put.order.tandai_selesai', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <button type="submit" onclick="return confirm('Apakah Anda yakin telah menerima pesanan ini?')" 
                                    class="w-full flex justify-center items-center bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-bold py-3.5 px-6 rounded-xl transition-all duration-300 active:scale-95 shadow-md hover:shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                Pesanan Diterima & Selesai
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            
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