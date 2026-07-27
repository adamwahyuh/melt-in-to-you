{{--
    Layout untuk halaman customer (katalog, keranjang, riwayat pesanan).

    Props yang dipakai:
    - title           : judul tab browser
    - activeNav        : 'katalog' | 'keranjang' | 'riwayat' -> buat nge-highlight menu aktif
    - cupItemCount     : jumlah item di keranjang (buat badge), default 0

    Butuh $user (auth()->user()) otomatis lewat Auth::check() di dalam,
    jadi controller gak wajib kirim variable user secara eksplisit.
--}}
@props([
    'title' => 'melt in to you',
    'activeNav' => null,
    'cupItemCount' => 0,
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title }}</title>
</head>
<body class="min-h-screen bg-gradient-to-br from-black to-[#9b5000] text-amber-50">

    <nav class="sticky top-0 z-40 border-b border-amber-50/10 bg-black/30 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6">
            <a href="{{ route('index') }}" class="flex items-center gap-2 text-lg font-semibold tracking-tight text-amber-50">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-amber-500 text-sm font-bold text-black">M</span>
                melt in to you
            </a>

            <div class="hidden items-center gap-1 sm:flex">
                <a href="{{ route('index') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ $activeNav === 'katalog' ? 'bg-amber-50/10 text-amber-50' : 'text-amber-50/60 hover:text-amber-50' }}">
                    Menu
                </a>
                <a href="{{ route('customer.orders.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ $activeNav === 'riwayat' ? 'bg-amber-50/10 text-amber-50' : 'text-amber-50/60 hover:text-amber-50' }}">
                    Riwayat Pesanan
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('customer.cup.index') }}" class="relative rounded-lg p-2 text-amber-50/80 transition-colors hover:bg-amber-50/10 hover:text-amber-50">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if ($cupItemCount > 0)
                        <span class="absolute -top-1 -right-1 flex h-4 min-w-4 items-center justify-center rounded-full bg-amber-500 px-1 text-[10px] font-bold text-black">
                            {{ $cupItemCount }}
                        </span>
                    @endif
                </a>

                @auth
                    <div class="flex items-center gap-2">
                        <span class="hidden h-8 w-8 items-center justify-center rounded-full bg-amber-50/10 text-xs font-semibold text-amber-50 sm:flex">
                            {{ auth()->user()->initials }}
                        </span>
                        <form action="{{ route('post.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-amber-50/60 transition-colors hover:text-amber-50">
                                Keluar
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>

        {{-- Nav mobile --}}
        <div class="flex items-center gap-1 border-t border-amber-50/10 px-4 py-2 sm:hidden">
            <a href="{{ route('index') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium {{ $activeNav === 'katalog' ? 'bg-amber-50/10 text-amber-50' : 'text-amber-50/60' }}">Menu</a>
            <a href="{{ route('customer.cup.index') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium {{ $activeNav === 'keranjang' ? 'bg-amber-50/10 text-amber-50' : 'text-amber-50/60' }}">Keranjang</a>
            <a href="{{ route('customer.orders.index') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium {{ $activeNav === 'riwayat' ? 'bg-amber-50/10 text-amber-50' : 'text-amber-50/60' }}">Riwayat</a>
        </div>
    </nav>

    {{-- Flash messages --}}
    <div class="mx-auto max-w-6xl px-4 pt-4 sm:px-6">
        @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-sm font-medium text-emerald-200">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-lg border border-red-400/30 bg-red-400/10 px-4 py-3 text-sm font-medium text-red-200">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <main class="mx-auto max-w-6xl px-4 py-6 sm:px-6">
        {{ $slot }}
    </main>

</body>
</html>
