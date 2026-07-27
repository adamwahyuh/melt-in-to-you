{{--
    Kontrak buat backend (PagesController@index):

    return view('customer.catalog', [
        'products' => Product::with('currentPrice')->latest()->get(),
    ]);

    Route yang dibutuhkan halaman ini:
    - POST route('customer.cup.add', $product)  -> tambah 1 produk ke cup milik user login
--}}
<x-clayout title="Menu - melt in to you" active-nav="katalog">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-amber-50 sm:text-3xl">Menu Kami</h1>
        <p class="mt-1 text-sm text-amber-50/60">Pilih es krim favoritmu, langsung tambahin ke keranjang.</p>
    </div>

    @if ($products->isEmpty())
        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-amber-50/20 py-20 text-center">
            <svg class="h-10 w-10 text-amber-50/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="mt-3 text-sm font-medium text-amber-50/70">Menu belum tersedia</p>
            <p class="text-sm text-amber-50/40">Coba cek lagi nanti ya.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="group overflow-hidden rounded-2xl border border-amber-50/10 bg-amber-50/5 transition-colors hover:border-amber-50/20">
                    <div class="aspect-square overflow-hidden bg-black/20">
                        <img
                            src="{{ $product->foto ? asset('storage/' . $product->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($product->name) . '&background=9b5000&color=fff7ed&size=256' }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-amber-50">{{ $product->name }}</h3>
                        <p class="mt-1 line-clamp-2 text-sm text-amber-50/50">{{ $product->deskripsi }}</p>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="font-semibold text-amber-300">
                                @if ($product->currentPrice)
                                    Rp{{ number_format($product->currentPrice->harga_dalam_rupiah, 0, ',', '.') }}
                                @else
                                    <span class="text-amber-50/30">Belum ada harga</span>
                                @endif
                            </span>
                        </div>

                        <form action="{{ route('customer.cup.add', $product) }}" method="POST" class="mt-4 flex items-center gap-2">
                            @csrf
                            <input
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                class="w-16 rounded-lg border border-amber-50/20 bg-black/20 px-2 py-2 text-center text-sm text-amber-50 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                            >
                            <button
                                type="submit"
                                @if (!$product->currentPrice) disabled @endif
                                class="flex-1 rounded-lg bg-amber-500 px-3 py-2 text-sm font-semibold text-black transition-colors hover:bg-amber-400 disabled:cursor-not-allowed disabled:bg-amber-50/10 disabled:text-amber-50/30"
                            >
                                + Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</x-clayout>
