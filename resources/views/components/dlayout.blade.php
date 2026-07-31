@props([
    'title' => 'Dashboard POS'
])

@php
$menus = [
    [
        'label' => 'Kasir',
        'url' => route('page.dashboard.kasir.index'),
        'active' => request()->is('*kasir*'),
        'show' => Auth::user()?->can('kasir') ?? true,
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>'
    ],
    [
        'label' => 'Stocker',
        'url' => route('page.dashboard.stocker.index'),
        'active' => request()->is('*stocker*'),
        'show' => Auth::user()?->can('stocker') ?? true,
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>'
    ],
    [
        'label' => 'Owner',
        'url' => route('page.dashboard.owner.index'),
        'active' => request()->is('*owner*'),
        'show' => Auth::user()?->can('owner') ?? true,
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>'
    ]
];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}</title>
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased">
    <x-flash-msg />

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 flex-shrink-0 bg-white border-r border-slate-200 flex flex-col transition-all duration-300">
            <div class="h-16 flex items-center px-6 border-b border-slate-200">
                <span class="text-xl font-bold text-slate-800 tracking-tight">POS<span class="text-blue-600">{{ config('app.name') }}</span></span>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                @foreach($menus as $menu)
                    @if($menu['show'])
                        <a href="{{ $menu['url'] }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ $menu['active'] ? 'bg-blue-50 text-blue-700' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-700' }}">
                            <svg class="w-5 h-5 mr-3 {{ $menu['active'] ? 'text-blue-600' : 'text-slate-400 group-hover:text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $menu['icon'] !!}
                            </svg>
                            {{ $menu['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-10">
                <div class="flex-1">
                    <h1 class="text-lg font-semibold text-slate-800">{{ $title }}</h1>
                </div>

                <div class="relative ml-4">
                    <button type="button" id="profile-menu-button" class="flex items-center gap-2 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:bg-slate-50 py-1 px-1.5 transition-colors" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Buka menu pengguna</span>
                        <img class="h-9 w-9 rounded-full object-cover border border-slate-200 shadow-sm" src="https://ui-avatars.com/api/?name={{ Auth::user()->initials ?? 'U' }}&background=0D8ABC&color=fff" alt="User Profile">
                        <span class="hidden md:block font-medium text-slate-700">{{ Auth::user()->name ?? 'User' }}</span>
                        <svg class="w-4 h-4 text-slate-500 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="profile-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transition ease-out duration-100" role="menu" aria-orientation="vertical" aria-labelledby="profile-menu-button" tabindex="-1">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm text-slate-900 font-medium">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        </div>
                        
                        <form action="{{ route('post.logout') }}" method="POST">
                            @csrf
                            <button class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors" role="menuitem" tabindex="-1">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profile-menu-button');
            const profileDropdown = document.getElementById('profile-dropdown');
            let isDropdownOpen = false;

            function toggleDropdown(e) {
                e.stopPropagation();
                isDropdownOpen = !isDropdownOpen;
                if (isDropdownOpen) {
                    profileDropdown.classList.remove('hidden');
                } else {
                    profileDropdown.classList.add('hidden');
                }
            }

            profileButton.addEventListener('click', toggleDropdown);

            document.addEventListener('click', function(event) {
                if (isDropdownOpen && !profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add('hidden');
                    isDropdownOpen = false;
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && isDropdownOpen) {
                    profileDropdown.classList.add('hidden');
                    isDropdownOpen = false;
                    profileButton.focus();
                }
            });
        });
    </script>
</body>
</html>