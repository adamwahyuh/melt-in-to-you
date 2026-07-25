<x-layout title="Detail Pesanan">
    <div class="px-4 py-8 bg-white min-h-screen">
        
        <!-- Container Pembatas Lebar Konten -->
        <div class="max-w-5xl mx-auto">
            
            <!-- Tombol Kembali -->
            <a href="{{ route('page.order.index') }}" class="inline-flex items-center text-sm font-medium text-amber-700 hover:text-amber-900 mb-6 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Pesanan
            </a>

            <!-- Header Halaman Detail -->
            <div class="mb-8 border-b border-amber-200 pb-5 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-amber-600">Detail Pesanan</h1>
                    <p class="text-stone-500 mt-2 text-sm">
                        ID Pesanan: <span class="font-bold text-amber-900">#{{ $order->id }}</span>
                    </p>
                </div>
                <div>
                    <!-- Badge Status -->
                    <span class="inline-flex px-4 py-1.5 text-sm font-bold uppercase tracking-wider rounded-full bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <!-- Card 1: Informasi Pesanan Utama -->
            <div class="bg-stone-50 rounded-xl border border-stone-200 p-6 shadow-sm mb-8">
                <h3 class="text-base font-bold text-amber-900 mb-4 border-b border-stone-200 pb-2">Informasi Pesanan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">Tanggal Pemesanan</p>
                        <p class="text-sm font-medium text-stone-800">
                            {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l, d F Y - H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Daftar Produk -->
            <div class="bg-white rounded-xl border border-amber-100 shadow-sm overflow-hidden mb-8">
                <div class="bg-amber-50 px-6 py-4 border-b border-amber-100">
                    <h3 class="text-base font-bold text-amber-900">Daftar Produk</h3>
                </div>
                
                <div class="divide-y divide-stone-100">
                    @foreach ($order->details as $detail)
                        <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:bg-stone-50/50 transition-colors duration-200">
                            
                            <!-- Info Produk -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-lg bg-amber-100/50 border border-amber-100 flex items-center justify-center shrink-0 text-amber-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-stone-800">{{ $detail->product->name }}</h4>
                                    <p class="text-sm text-stone-500 mt-1">
                                        <span class="font-bold text-amber-700 bg-amber-100 px-1.5 py-0.5 rounded text-xs mr-1">{{ $detail->quantity }}x</span> 
                                        @if($detail->quantity > 0)
                                            Rp {{ number_format($detail->sub_total / $detail->quantity, 0, ',', '.') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Subtotal Per Produk -->
                            <div class="text-left sm:text-right w-full sm:w-auto pl-16 sm:pl-0">
                                <p class="text-sm font-bold text-stone-800">
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
                <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 bg-stone-50 rounded-xl border border-stone-200 p-6 shadow-sm mb-6">
                    <h3 class="text-base font-bold text-amber-900 mb-4 border-b border-stone-200 pb-2">Rincian Pembayaran</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-stone-500 font-medium">Subtotal Produk</span>
                            <span class="font-semibold text-stone-800">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center pt-4 border-t border-stone-200 mt-4">
                            <span class="text-base font-bold text-stone-800">Total Belanja</span>
                            <span class="text-xl font-black text-amber-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>


                @if(strtolower($order->status) === 'sedang dikirim')
                    <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3">
                        <form action="{{ route('put.order.tandai_selesai', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <button type="submit" onclick="return confirm('Apakah Anda yakin telah menerima pesanan ini?')" 
                                    class="w-full flex justify-center items-center bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all duration-200 active:scale-95 shadow-md hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Pesanan Diterima & Selesai
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</x-layout>