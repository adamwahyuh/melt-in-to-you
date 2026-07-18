<nav class="sticky top-0 z-50 bg-black/40 backdrop-blur-md border-b border-[#9b5000]/50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Kiri: Logo dan Nama Aplikasi -->
            <a href="/" class="flex items-center gap-3 transition-transform hover:scale-105 duration-300">
                <img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('app.name') }}" class="h-9 w-auto object-contain drop-shadow-md">
                <span class="font-bold text-xl text-amber-100 tracking-wide hidden sm:block">
                    {{ config('app.name', 'Coffee App') }}
                </span>
            </a>

            <!-- Kanan: Menu Navigasi & Autentikasi -->
            <div class="flex items-center gap-4 sm:gap-6">
                @auth
                    <!-- Keranjang / Cups -->
                    <a href="/cups" class="relative text-amber-300 hover:text-amber-100 transition-colors p-1" title="Keranjang Cups">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <!-- Opsional: Jika ada fitur jumlah item, bisa letakkan badge bulat disini -->
                    </a>

                    <div class="h-6 w-px bg-[#9b5000]/50 hidden sm:block"></div>

                    <!-- Profil (Inisial) & Logout -->
                    <div class="flex items-center gap-3">
                        <!-- Lingkaran Inisial -->
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#9b5000] to-amber-500 text-white flex items-center justify-center font-bold text-sm shadow-md border border-amber-300/30 ring-2 ring-transparent hover:ring-amber-500 transition-all cursor-default" title="{{ auth()->user()->name }}">
                            {{ auth()->user()->initials }}
                        </div>

                        <!-- Tombol Logout -->
                        <form action="{{ route('post.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-amber-200 hover:text-white bg-[#9b5000]/20 hover:bg-[#9b5000]/60 px-4 py-2 rounded-lg border border-transparent hover:border-[#9b5000] transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Tombol Login -->
                    <a href="{{ route('post.login') }}" class="text-sm font-bold text-amber-950 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 px-6 py-2.5 rounded-full transition-all duration-300 shadow-[0_0_15px_rgba(251,191,36,0.3)] hover:shadow-[0_0_20px_rgba(251,191,36,0.5)]">
                        Masuk
                    </a>
                @endauth
            </div>
            
        </div>
    </div>
</nav>