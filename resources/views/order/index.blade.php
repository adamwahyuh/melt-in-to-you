<x-layout title="Daftar Pesanan">
    <div class="relative min-h-screen bg-[#160b04] overflow-x-hidden py-10 md:py-16">
        
        {{-- Ambient floating dots & glow --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden z-0">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
            <div class="absolute top-[5%] right-[-10%] w-[30%] h-[30%] bg-[#d89a4e]/10 blur-[120px] rounded-full"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 sm:px-6 max-w-5xl">
            
            <!-- Header Halaman -->
            <div class="mb-10 border-b border-amber-100/10 pb-6 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-amber-50 via-amber-100 to-[#d89a4e] tracking-tight">
                    Riwayat Pesanan
                </h1>
                <p class="text-amber-100/60 mt-2 font-light">Pantau status dan detail pesanan Anda di sini.</p>
            </div>

            @if($orders->count() > 0)
                <!-- List Pesanan Memanjang ke Bawah -->
                <div class="flex flex-col space-y-6">
                    @foreach ($orders as $order)
                        <!-- Item List -->
                        <div class="bg-black/30 rounded-2xl border border-amber-100/10 border-l-4 border-l-[#d89a4e] shadow-lg hover:shadow-black/50 hover:border-amber-100/30 hover:bg-black/40 backdrop-blur-md transition-all duration-300 p-5 md:p-6 group relative overflow-hidden">
                            
                            <!-- Layout Dalam Item: Flexbox Responsif -->
                            <div class="flex flex-col md:flex-row gap-6 md:items-center justify-between relative z-10">
                                
                                <!-- Kolom 1: Tanggal & Status (Kiri) -->
                                <div class="md:w-1/4 shrink-0">
                                    <div class="flex md:flex-col items-center md:items-start justify-between md:justify-start gap-3 md:gap-2">
                                        <p class="text-sm font-semibold text-amber-50 tracking-wide">
                                            {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}
                                        </p>
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-[#d89a4e]/10 text-[#d89a4e] border border-[#d89a4e]/20 backdrop-blur-sm uppercase tracking-wider">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Kolom 2: Daftar Produk (Tengah) -->
                                <div class="md:w-2/4 grow bg-black/40 rounded-xl p-4 border border-amber-100/5 group-hover:border-amber-100/10 transition-colors">
                                    <ul class="space-y-3">
                                        @foreach ($order->details as $detail)
                                            <li class="flex justify-between items-start text-sm">
                                                <div class="flex items-start gap-3">
                                                    <span class="font-bold text-[#d89a4e] bg-[#d89a4e]/20 border border-[#d89a4e]/10 px-2 py-0.5 rounded-lg text-xs mt-0.5">
                                                        {{ $detail->quantity }}x
                                                    </span>
                                                    <span class="text-amber-100/80 font-medium">
                                                        {{ $detail->product->name }}
                                                    </span>
                                                </div>
                                                <span class="font-semibold text-amber-100/50 text-xs whitespace-nowrap ml-4 mt-0.5">
                                                    Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Kolom 3: Total & Tombol Aksi (Kanan) -->
                                <div class="md:w-1/4 shrink-0 flex flex-row md:flex-col justify-between md:justify-center items-center md:items-end gap-4 border-t md:border-t-0 border-amber-100/10 pt-5 md:pt-0 mt-2 md:mt-0">
                                    <div class="text-left md:text-right">
                                        <p class="text-xs text-amber-100/60 font-medium mb-1 uppercase tracking-wider">Total Belanja</p>
                                        <p class="text-lg font-black text-[#d89a4e] drop-shadow-sm">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <a href="{{ route('page.order.show', $order->id) }}" 
                                       class="inline-flex items-center justify-center bg-gradient-to-r from-[#9b5000] to-[#d89a4e] text-[#2b1508] font-bold py-2.5 px-6 rounded-xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(216,154,78,0.4)] hover:-translate-y-0.5 active:translate-y-0 text-sm w-full md:w-auto">
                                        <span>Detail</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Tampilan jika tidak ada pesanan -->
                <div class="text-center py-20 bg-black/30 rounded-3xl border border-dashed border-amber-100/20 backdrop-blur-sm shadow-sm">
                    <div class="text-amber-100/40 mb-6 flex justify-center opacity-80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-amber-50">Belum ada riwayat pesanan</h3>
                    <p class="text-amber-100/60 mt-2 font-light">Daftar pesanan Anda akan muncul di halaman ini.</p>
                    <a href="{{ route('page.menu') }}" class="mt-6 inline-flex items-center justify-center px-6 py-2.5 border border-[#d89a4e] text-[#d89a4e] hover:bg-[#d89a4e]/10 font-medium rounded-xl transition-colors duration-300">
                        Mulai Belanja
                    </a>
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