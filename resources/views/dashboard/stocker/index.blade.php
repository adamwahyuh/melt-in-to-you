<x-dlayout title="Stocker">
    <div class="">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 border-b border-gray-100 pb-5">
    
            <!-- Bagian Kiri: Judul -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900" style="font-family: 'Sora', sans-serif;">Produk</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola semua daftar menu dan produk Anda.</p>
            </div>

            <!-- Bagian Kanan: Counter & Tombol -->
            <div class="flex items-center gap-3">
                <!-- Badge Jumlah Item -->
                <div class="hidden sm:flex items-center px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Total: <span class="font-bold text-gray-900 ml-1">{{ $products->count() ?? count($products) }}</span>
                </div>

                <!-- Tombol Tambah Menu -->
                <a href="{{ route('page.product.create') }}" 
                class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow-emerald-500/30 focus:ring-4 focus:ring-emerald-100 active:scale-95 w-full sm:w-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Menu
                </a>
            </div>
            
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach ($products as $product)
                <div class="group bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg hover:border-emerald-300 transition-all duration-300">
                    <div class="relative aspect-square bg-gray-50 overflow-hidden">
                        <img
                            src="{{ $product->foto_url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        >
                        <span class="absolute top-2 right-2 bg-amber-500 text-white text-xs font-semibold px-2 py-1 rounded-full shadow">
                            Rp {{ number_format($product->current_price, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="p-4">
                        <p class="font-semibold text-gray-900 truncate" style="font-family: 'Inter', sans-serif;">
                            {{ $product->name }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2 h-10">
                            {{ $product->deskripsi }}
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            <!-- Harga -->
                            <span class="text-lg font-bold text-emerald-600" style="font-family: 'JetBrains Mono', monospace;">
                                Rp {{ number_format($product->current_price, 0, ',', '.') }}
                            </span>

                            <!-- Kumpulan Tombol Aksi -->
                            <div class="flex items-center gap-2">
                                <!-- Tombol Edit -->
                                <a
                                    href="{{ route('page.product.edit', ['product' => $product->id]) }}"
                                    class="inline-flex items-center gap-1.5 text-sm font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors"
                                    title="Edit Produk"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('delete.product.delete', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center gap-1.5 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors"
                                        title="Hapus Produk"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($products) === 0)
            <div class="text-center py-16 bg-gray-50 border border-dashed border-gray-200 rounded-2xl mt-4">
                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <p class="mt-4 text-gray-500 font-medium">Belum ada produk</p>
                <p class="text-sm text-gray-400">Tambahkan produk baru untuk mulai berjualan.</p>
            </div>
        @endif
    </div>
</x-dlayout>