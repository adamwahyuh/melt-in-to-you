<x-dlayout title="Dashboard">
    <!-- Container utama di-set ke tengah (centered) -->
    <div class="min-h-[60vh] flex flex-col items-center justify-center p-4 sm:p-6">
        
        <div class="w-full max-w-4xl">
            <!-- Judul Halaman -->
            <h1 class="text-2xl font-bold text-gray-800 mb-8 text-center">Pilih Akses Dashboard</h1>
            
            <!-- Grid untuk kotak-kotak menu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                
                @can('kasir')
                    <!-- Kotak Menu Kasir (Hover Biru) -->
                    <a href="{{ route('page.dashboard.kasir.index') }}" 
                       class="flex items-center justify-center h-40 bg-white rounded-2xl shadow-sm border border-gray-200 hover:bg-blue-50 hover:border-blue-400 hover:shadow-md transition-all duration-300 group">
                        <span class="text-xl font-bold text-gray-700 group-hover:text-blue-700">
                            Kasir
                        </span>
                    </a>
                @endcan

                @can('stocker')
                    <!-- Kotak Menu Stocker (Hover Hijau) -->
                    <a href="{{ route('page.dashboard.stocker.index') }}" 
                       class="flex items-center justify-center h-40 bg-white rounded-2xl shadow-sm border border-gray-200 hover:bg-green-50 hover:border-green-400 hover:shadow-md transition-all duration-300 group">
                        <span class="text-xl font-bold text-gray-700 group-hover:text-green-700">
                            Stocker
                        </span>
                    </a>
                @endcan

                @can('owner')
                    <!-- Kotak Menu Owner (Hover Ungu) -->
                    <a href="{{ route('page.dashboard.owner.index') }}" 
                       class="flex items-center justify-center h-40 bg-white rounded-2xl shadow-sm border border-gray-200 hover:bg-purple-50 hover:border-purple-400 hover:shadow-md transition-all duration-300 group">
                        <span class="text-xl font-bold text-gray-700 group-hover:text-purple-700">
                            Owner
                        </span>
                    </a>
                @endcan
                
            </div>
        </div>
        
    </div>
</x-dlayout>