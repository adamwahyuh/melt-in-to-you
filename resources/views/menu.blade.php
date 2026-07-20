<x-layout title="{{ config('app.name') }}">

    <div class="min-h-screen ">

        <!-- Hero / Header -->
        <div class=" relative overflow-hidden">
            <!-- Dekorasi lingkaran ala scoop es krim -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#D2A679]/20 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-16 -left-10 w-56 h-56 bg-[#F3D9B1]/10 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-4 py-10 md:py-14 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <p class="text-[#F3D9B1] font-medium tracking-wide text-sm mb-1">🍦 Selamat Datang</p>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">Menu Es Krim Kami</h1>
                        <p class="text-[#E8C9A0] mt-1 text-sm">Manisnya hidup, semanis pilihanmu</p>
                    </div>

                    <div class="w-full md:w-1/3" x-data="productSearch()">
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#8B5A4A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input
                                type="search"
                                x-model="query"
                                placeholder="Cari es krim favoritmu..."
                                class="w-full pl-11 pr-4 py-3 rounded-full border-none shadow-lg focus:outline-none focus:ring-4 focus:ring-[#D2A679]/40 bg-white/95 text-[#4A2C2A] placeholder-[#B08968] transition"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="container mx-auto px-4 py-10" x-data="productSearch()">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($products as $product)
                    <div
                        x-show="matches('{{ Str::lower($product->name) }}', '{{ Str::lower($product->deskripsi) }}')"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="group bg-white rounded-2xl shadow-md hover:shadow-2xl overflow-hidden flex flex-col border border-[#F0E0CC] transition-all duration-300 hover:-translate-y-1"
                    >
                        <div class="relative overflow-hidden">
                            <img src="{{ $product->foto_url }}" alt="{{ $product->name }}"
                                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-[#4A2C2A] group-hover:text-[#8B5A4A] transition">
                                {{ $product->name }}
                            </h3>

                            <p class="text-sm text-[#8B7355] mt-2 flex-grow leading-relaxed">
                                {{ Str::limit($product->deskripsi, 60) }}
                            </p>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-lg font-extrabold text-[#8B5A4A]">
                                    Rp {{ number_format($product->current_price, 0, ',', '.') }}
                                </span>
                                <span class="text-xs bg-[#F3D9B1] text-[#4A2C2A] px-2 py-1 rounded-full font-medium">
                                    🍨 Fresh
                                </span>
                            </div>

                            <div class="mt-4">
                                @auth
                                    <!-- Tambahkan x-data="{ qty: 1 }" untuk mengatur state jumlah -->
                                    <form action="{{ route('post.cup.store_to_cup') }}" method="POST" x-data="{ qty: 1 }" class="flex flex-col gap-3">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <!-- Kontrol Plus Minus -->
                                        <div class="flex items-center justify-between border border-[#F3D9B1] rounded-xl overflow-hidden bg-[#FFF9F2]">
                                            <!-- Tombol Minus -->
                                            <button 
                                                type="button" 
                                                @click="if(qty > 1) qty--" 
                                                class="w-10 h-10 flex items-center justify-center text-[#8B5A4A] hover:bg-[#F3D9B1] hover:text-[#4A2C2A] transition-colors duration-200 font-bold text-xl"
                                            >
                                                &minus;
                                            </button>
                                            
                                            <!-- Input Quantity (Readonly agar user pakai tombol +/- saja, atau hapus readonly jika mau bisa diketik) -->
                                            <input 
                                                type="number" 
                                                name="quantity" 
                                                x-model="qty" 
                                                min="1" 
                                                class="w-12 text-center border-none focus:ring-0 text-[#4A2C2A] font-bold bg-transparent p-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" 
                                                readonly
                                            >

                                            <!-- Tombol Plus -->
                                            <button 
                                                type="button" 
                                                @click="qty++" 
                                                class="w-10 h-10 flex items-center justify-center text-[#8B5A4A] hover:bg-[#F3D9B1] hover:text-[#4A2C2A] transition-colors duration-200 font-bold text-xl"
                                            >
                                                &plus;
                                            </button>
                                        </div>

                                        <!-- Tombol Submit -->
                                        <button 
                                            type="submit" 
                                            class="w-full flex items-center justify-center gap-2 bg-[#8B5A4A] hover:bg-[#6A4135] text-white font-semibold py-2.5 px-4 rounded-xl transition shadow-md hover:shadow-lg active:scale-95"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Tambah ke Cup
                                        </button>
                                    </form>
                                @else
                                    <a href="/login" class="block text-center w-full bg-[#D2A679] hover:bg-[#C19660] text-white font-semibold py-2.5 px-4 rounded-xl transition shadow-sm hover:shadow-md">
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
                class="text-center py-16"
            >
                <div class="text-6xl mb-4">🍦</div>
                <p class="text-[#8B7355] font-medium">Es krim yang kamu cari nggak ketemu, coba kata kunci lain ya!</p>
            </div>

        </div>
    </div>

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
                },
                addToCup(productId, el) {
                    // Micro-interaction: tombol "mengecil lalu balik" sudah dihandle via active:scale-95
                    console.log('Menambahkan produk ID: ' + productId);
                    // Nanti diisi logic fetch/axios POST ke endpoint penambahan Cup
                }
            }
        }
    </script>
</x-layout>