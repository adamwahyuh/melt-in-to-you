{{--
    Kontrak buat backend:

    return view('customer.cup', [
        'cupDetails' => $cup->cupDetails()->with('product.currentPrice')->get(), // butuh Cup::cupDetails() hasMany
        'total'      => $total, // total belanja dalam rupiah
    ]);

    Route yang dibutuhkan halaman ini:
    - PATCH  route('customer.cup.update', $cupDetail)  -> update quantity 1 item
    - DELETE route('customer.cup.remove', $cupDetail)  -> hapus 1 item dari cup
    - POST   route('customer.cup.checkout')            -> cup -> jadi Order (set dipesan_pada), kosongkan cup
--}}
<x-clayout title="Keranjang - melt in to you" active-nav="keranjang" :cup-item-count="$cupDetails->count()">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-amber-50 sm:text-3xl">Keranjang</h1>
        <p class="mt-1 text-sm text-amber-50/60">Cek lagi pesananmu sebelum checkout.</p>
    </div>

    @if ($cupDetails->isEmpty())
        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-amber-50/20 py-20 text-center">
            <svg class="h-10 w-10 text-amber-50/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="mt-3 text-sm font-medium text-amber-50/70">Keranjang kamu masih kosong</p>
            <a href="{{ route('index') }}" class="mt-4 rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-black transition-colors hover:bg-amber-400">
                Lihat Menu
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            {{-- List item --}}
            <div class="space-y-3 lg:col-span-2">
                @foreach ($cupDetails as $cupDetail)
                    <div class="flex items-center gap-4 rounded-xl border border-amber-50/10 bg-amber-50/5 p-3">
                        <img
                            src="{{ $cupDetail->product->foto ? asset('storage/' . $cupDetail->product->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($cupDetail->product->name) . '&background=9b5000&color=fff7ed' }}"
                            alt="{{ $cupDetail->product->name }}"
                            class="h-16 w-16 flex-shrink-0 rounded-lg object-cover"
                        >

                        <div class="min-w-0 flex-1">
                            <h3 class="truncate font-medium text-amber-50">{{ $cupDetail->product->name }}</h3>
                            <p class="text-sm text-amber-300">
                                Rp{{ number_format($cupDetail->product->currentPrice->harga_dalam_rupiah ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Ubah quantity --}}
                        <form action="{{ route('customer.cup.update', $cupDetail) }}" method="POST" class="flex items-center gap-1">
                            @csrf
                            @method('PATCH')
                            <input
                                type="number"
                                name="quantity"
                                value="{{ $cupDetail->quantity }}"
                                min="1"
                                onchange="this.form.submit()"
                                class="w-14 rounded-lg border border-amber-50/20 bg-black/20 px-2 py-1.5 text-center text-sm text-amber-50 focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                            >
                        </form>

                        {{-- Hapus item --}}
                        <form action="{{ route('customer.cup.remove', $cupDetail) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" class="rounded-lg p-2 text-amber-50/40 transition-colors hover:bg-red-500/10 hover:text-red-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Ringkasan --}}
            <div class="h-fit rounded-2xl border border-amber-50/10 bg-amber-50/5 p-5">
                <h3 class="font-semibold text-amber-50">Ringkasan Belanja</h3>

                <div class="mt-4 space-y-2 border-t border-amber-50/10 pt-4 text-sm">
                    <div class="flex justify-between text-amber-50/60">
                        <span>Total Item</span>
                        <span>{{ $cupDetails->sum('quantity') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-amber-50">
                        <span>Total Belanja</span>
                        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('customer.cup.checkout') }}" method="POST" class="mt-5">
                    @csrf
                    <button type="submit" class="w-full rounded-lg bg-amber-500 py-2.5 text-sm font-semibold text-black transition-colors hover:bg-amber-400">
                        Checkout
                    </button>
                </form>
            </div>
        </div>
    @endif

</x-clayout>
