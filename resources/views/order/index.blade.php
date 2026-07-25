<x-layout title="Daftar Pesanan">
    <div class="px-4 py-8 bg-white min-h-screen">
        <!-- Header Halaman -->
        <div class="mb-8 border-b border-amber-200 pb-4">
            <h1 class="text-3xl font-bold text-amber-600">Riwayat Pesanan</h1>
            <p class="text-stone-500 mt-2">Pantau status dan detail pesanan Anda di sini.</p>
        </div>

        @if($orders->count() > 0)
            <!-- List Pesanan Memanjang ke Bawah -->
            <div class="flex flex-col space-y-4">
                @foreach ($orders as $order)
                    <!-- Item List -->
                    <div class="bg-white rounded-xl border border-amber-100 border-l-4 border-l-amber-600 shadow-sm hover:shadow-md hover:border-amber-300 transition-all duration-300 p-5 group">
                        
                        <!-- Layout Dalam Item: Flexbox Responsif -->
                        <div class="flex flex-col md:flex-row gap-6 md:items-center justify-between">
                            
                            <!-- Kolom 1: Tanggal & Status (Kiri) -->
                            <div class="md:w-1/4 shrink-0">
                                <div class="flex md:flex-col items-center md:items-start justify-between md:justify-start gap-3">
                                    <p class="text-sm font-semibold text-amber-900">
                                        {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}
                                    </p>
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Kolom 2: Daftar Produk (Tengah) -->
                            <div class="md:w-2/4 grow bg-stone-50/50 rounded-lg p-3 border border-stone-100 group-hover:bg-stone-50 transition-colors">
                                <ul class="space-y-2">
                                    @foreach ($order->details as $detail)
                                        <li class="flex justify-between items-start text-sm">
                                            <div class="flex items-start gap-3">
                                                <span class="font-bold text-amber-700 bg-amber-200/50 px-1.5 py-0.5 rounded text-xs mt-0.5">
                                                    {{ $detail->quantity }}x
                                                </span>
                                                <span class="text-stone-700 font-medium">
                                                    {{ $detail->product->name }}
                                                </span>
                                            </div>
                                            <span class="font-semibold text-stone-500 text-xs whitespace-nowrap ml-4 mt-0.5">
                                                Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Kolom 3: Total & Tombol Aksi (Kanan) -->
                            <div class="md:w-1/4 shrink-0 flex flex-row md:flex-col justify-between md:justify-center items-center md:items-end gap-4 border-t md:border-t-0 border-stone-100 pt-4 md:pt-0">
                                <div class="text-left md:text-right">
                                    <p class="text-xs text-stone-500 font-medium mb-1">Total Belanja</p>
                                    <p class="text-lg font-black text-amber-900">
                                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>
                                <a href="{{ route('page.order.show', $order->id) }}" 
                                   class="inline-flex items-center justify-center bg-amber-700 hover:bg-amber-800 text-white font-semibold py-2 px-5 rounded-lg transition-all duration-200 active:scale-95 text-sm shadow-sm hover:shadow">
                                    <span>Detail</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Tampilan jika tidak ada pesanan -->
            <div class="text-center py-16 bg-stone-50 rounded-2xl border border-dashed border-amber-300">
                <div class="text-amber-800/50 mb-4 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-amber-900">Belum ada riwayat pesanan</h3>
                <p class="text-stone-500 mt-1">Daftar pesanan Anda akan muncul di halaman ini.</p>
            </div>
        @endif
    </div>
</x-layout>