<x-layout title="{{ config('app.name') }} - Menu">
    
    <!-- BUNGKUS UTAMA: x-data diletakkan di elemen terluar agar search input & grid saling terhubung -->
    <div class="relative min-h-screen bg-[#160b04] overflow-x-hidden" x-data="productSearch()">

        {{-- ambient floating dots & glow --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden z-0">
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[12%] left-[8%] animate-[float_6s_ease-in-out_infinite]"></span>
            <span class="absolute w-3 h-3 rounded-full bg-amber-100/10 top-[70%] left-[15%] animate-[float_7s_ease-in-out_infinite_.5s]"></span>
            <span class="absolute w-2 h-2 rounded-full bg-amber-100/10 top-[20%] right-[10%] animate-[float_5s_ease-in-out_infinite_1s]"></span>
            <span class="absolute w-2.5 h-2.5 rounded-full bg-amber-100/10 top-[80%] right-[18%] animate-[float_8s_ease-in-out_infinite_.2s]"></span>
            <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[40%] bg-[#d89a4e]/10 blur-[120px] rounded-full"></div>
        </div>

        <!-- Hero / Header Section -->
        <div class="relative z-10 pt-16 pb-8 md:pt-24 md:pb-12 border-b border-amber-100/10 bg-gradient-to-b from-[#3b1f0e]/60 to-transparent backdrop-blur-sm">
            <div class="container mx-auto px-6 max-w-7xl">
                <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                    <!-- Judul -->
                    <div class="text-center md:text-left">
                        <p class="text-[#d89a4e] font-semibold tracking-widest text-xs uppercase mb-2">🍦 Kelezatan Autentik</p>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-amber-50 via-amber-100 to-[#d89a4e] drop-shadow-sm pb-1">Menu Es Krim Kami</h1>
                        <p class="text-amber-100/60 mt-2 text-sm md:text-base font-light">Manisnya hidup, semanis pilihanmu.</p>
                    </div>

                    <!-- Search Input -->
                    <div class="w-full md:w-1/3">
                        <div class="relative group">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-100/40 group-focus-within:text-[#d89a4e] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input
                                type="search"
                                x-model="query"
                                placeholder="Cari es krim favoritmu..."
                                class="w-full pl-11 pr-4 py-3.5 rounded-2xl border border-amber-100/10 bg-black/40 text-amber-50 placeholder-amber-100/30 backdrop-blur-md outline-none transition-all duration-300 focus:border-[#d89a4e] focus:ring-2 focus:ring-[#d89a4e]/30 focus:bg-black/60 shadow-lg"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Produk Section -->
        <div class="relative z-10 container mx-auto px-6 py-12 max-w-7xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                
                @foreach($products as $product)
                    <div
                        x-show="matches('{{ Str::lower($product->name) }}', '{{ Str::lower($product->deskripsi) }}')"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="group bg-black/30 rounded-3xl overflow-hidden flex flex-col border border-amber-100/10 backdrop-blur-sm transition-all duration-500 hover:shadow-[0_15px_30px_rgba(0,0,0,0.8)] hover:border-[#d89a4e]/40 hover:-translate-y-2"
                    >
                        <!-- Foto Produk -->
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ $product->foto_url }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Overlay Gradien dari Bawah -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#160b04] via-[#160b04]/20 to-transparent opacity-80"></div>
                            
                            <!-- Badge Fresh (Dipindah ke Kiri Atas Gambar) -->
                            <span class="absolute top-4 left-4 text-xs bg-[#d89a4e]/20 text-[#d89a4e] border border-[#d89a4e]/30 px-3 py-1.5 rounded-full font-semibold backdrop-blur-md">
                                🍨 Fresh
                            </span>
                        </div>

                        <!-- Detail Produk -->
                        <div class="p-6 flex flex-col flex-grow relative -mt-6">
                            <h3 class="text-xl font-bold text-amber-50 group-hover:text-[#d89a4e] transition-colors duration-300">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-amber-100/60 mt-2 flex-grow leading-relaxed font-light">
                                {{ Str::limit($product->deskripsi, 60) }}
                            </p>

                            <div class="mt-5 mb-5 flex justify-between items-center">
                                <span class="text-xl font-extrabold text-[#d89a4e] drop-shadow-sm">
                                    Rp {{ number_format($product->current_price, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Area Action / Form -->
                            <div class="mt-auto border-t border-amber-100/10 pt-5">
                                @auth
                                    <form action="{{ route('post.cup.store_to_cup') }}" method="POST" x-data="{ qty: 1 }" class="flex flex-col gap-4">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <!-- Kontrol Plus Minus -->
                                        <div class="flex items-center justify-between border border-amber-100/10 rounded-xl overflow-hidden bg-black/40 transition-colors focus-within:border-[#d89a4e]/50 focus-within:ring-1 focus-within:ring-[#d89a4e]/50">
                                            <button type="button" @click="if(qty > 1) qty--" class="w-12 h-11 flex items-center justify-center text-amber-100/60 hover:bg-[#d89a4e]/20 hover:text-[#d89a4e] transition-colors duration-200 font-bold text-xl">
                                                &minus;
                                            </button>
                                            
                                            <input type="number" name="quantity" x-model="qty" min="1" class="w-12 text-center border-none focus:ring-0 text-amber-50 font-bold bg-transparent p-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" readonly>

                                            <button type="button" @click="qty++" class="w-12 h-11 flex items-center justify-center text-amber-100/60 hover:bg-[#d89a4e]/20 hover:text-[#d89a4e] transition-colors duration-200 font-bold text-xl">
                                                &plus;
                                            </button>
                                        </div>

                                        <!-- Tombol Tambah -->
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#9b5000] to-[#d89a4e] text-[#2b1508] font-bold py-3 px-4 rounded-xl transition-all duration-300 hover:shadow-[0_0_20px_rgba(216,154,78,0.3)] hover:-translate-y-0.5 active:translate-y-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Tambah ke Cup
                                        </button>
                                    </form>
                                @else
                                    <a href="/login" class="flex items-center justify-center w-full bg-black/40 border border-amber-100/20 hover:border-[#d89a4e]/50 hover:bg-[#d89a4e]/10 text-amber-50 hover:text-[#d89a4e] font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                                        Masuk untuk Memesan
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pesan jika pencarian tidak ditemukan -->
            <div
                x-show="!hasAnyMatch()"
                x-transition
                style="display: none;"
                class="text-center py-20 bg-black/20 rounded-3xl border border-dashed border-amber-100/10 mt-8"
            >
                <div class="text-6xl mb-4 opacity-70 animate-bounce">🍦</div>
                <p class="text-amber-100/60 font-medium text-lg">Es krim yang kamu cari nggak ketemu.</p>
                <p class="text-amber-100/40 text-sm mt-1">Coba kata kunci lain atau lihat menu unggulan kami!</p>
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

    <script>
        function productSearch() {
            return {
                query: '',
                products: [
                    @foreach($products as $product)
                        {
                            name: @json(Str::lower($product->name)),
                            desc: @json(Str::lower($product->deskripsi))
                        },
                    @endforeach
                ],
                matches(name, desc) {
                    if (!this.query) return true;
                    const q = this.query.toLowerCase();
                    return name.includes(q) || desc.includes(q);
                },
                hasAnyMatch() {
                    if (!this.query) return true;
                    const q = this.query.toLowerCase();
                    return this.products.some(p => p.name.includes(q) || p.desc.includes(q));
                }
            }
        }
    </script>
</x-layout>