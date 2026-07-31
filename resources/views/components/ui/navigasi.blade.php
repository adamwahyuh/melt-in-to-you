<nav class="sticky top-0 z-50 bg-[#160b04]/80 backdrop-blur-xl border-b border-amber-100/10 shadow-xl shadow-black/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-[72px]">
            
            <!-- Kiri: Logo dan Nama Aplikasi -->
            <a href="/" class="flex items-center gap-3 transition-transform hover:scale-105 duration-300">
                <img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('app.name') }}" class="h-12 w-auto object-contain drop-shadow-md">
                <span class="font-bold text-xl text-transparent bg-clip-text bg-gradient-to-r from-amber-50 to-[#d89a4e] tracking-wide hidden sm:block">
                    {{ config('app.name', 'Coffee App') }}
                </span>
            </a>

            <!-- Kanan: Menu Navigasi & Autentikasi -->
            <div class="flex items-center gap-2 sm:gap-4">
                @auth
                    <!-- Kumpulan Menu dengan Icon -->
                    <div class="flex items-center gap-1 sm:gap-2 mr-1 sm:mr-2">
                        
                        <!-- Menu: Pesanan -->
                        @if (auth()->user()->peran->isNotEmpty())
                            
                        <a href="{{ route('page.dashboard.index') }}" 
                           class="flex items-center gap-2 text-amber-100/70 hover:text-[#d89a4e] hover:bg-black/40 px-3 py-2.5 rounded-xl transition-all duration-300 group" 
                           title="Riwayat Pesanan">
                            <span class="text-sm font-medium hidden md:block">Dashboard</span>
                        </a>
                        @endif


                        <a href="{{ route('page.order.index') }}" 
                           class="flex items-center gap-2 text-amber-100/70 hover:text-[#d89a4e] hover:bg-black/40 px-3 py-2.5 rounded-xl transition-all duration-300 group" 
                           title="Riwayat Pesanan">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="text-sm font-medium hidden md:block">Pesanan</span>
                        </a>

                        <!-- Menu: Cup -->
                        <a href="{{ route('page.cup.index') }}" 
                           class="flex items-center gap-2 text-amber-100/70 hover:text-[#d89a4e] hover:bg-black/40 px-3 py-2.5 rounded-xl transition-all duration-300 group relative" 
                           title="Cup Belanja">
                            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-sm font-medium hidden md:block">Cup</span>
                        </a>

                    </div>

                    <!-- Garis Pemisah (Divider) -->
                    <div class="h-8 w-px bg-amber-100/10 hidden sm:block"></div>

                    <!-- Profil & Logout -->
                    <div class="flex items-center gap-3 pl-1 sm:pl-2">
                        <!-- Lingkaran Inisial -->
                        <form action="{{ route('page.myprofile') }}">
                            <button class="cursor-pointer">
                                <div class="cursor-pointer w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-[#9b5000] to-[#d89a4e] text-[#2b1508] flex items-center justify-center font-bold text-sm shadow-lg shadow-[#d89a4e]/20 border border-[#d89a4e]/30 ring-2 ring-transparent hover:ring-[#d89a4e]/50 transition-all" 
                                    title="{{ auth()->user()->name ?? 'User' }}">
                                    {{ auth()->user()->initials ?? 'U' }}
                                </div>
                            </button>
                        </form>

                        <!-- Tombol Logout -->
                        <form action="{{ route('post.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center justify-center text-amber-100/50 hover:text-red-400 hover:bg-red-500/10 p-2 sm:px-4 sm:py-2.5 rounded-xl transition-all duration-300 group" title="Logout">
                                <!-- Icon muncul di mobile -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <!-- Text muncul di layar lebih besar -->
                                <span class="text-sm font-medium hidden sm:block">Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Tombol Login -->
                    <a href="{{ route('login') }}" class="flex items-center gap-2 text-sm font-bold text-[#2b1508] bg-gradient-to-r from-[#9b5000] to-[#d89a4e] px-6 py-2.5 rounded-full transition-all duration-300 shadow-[0_0_15px_rgba(216,154,78,0.3)] hover:shadow-[0_0_25px_rgba(216,154,78,0.5)] hover:-translate-y-0.5 active:translate-y-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </a>
                @endauth
            </div>
            
        </div>
    </div>
</nav>