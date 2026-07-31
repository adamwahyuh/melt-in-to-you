<x-dlayout title="Penjualan">
    <div class="p-4 sm:p-6 max-w-7xl mx-auto space-y-6">
        
        <!-- Header & Filter Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-800">Ringkasan Penjualan</h1>
            
            <form action="" method="GET" class="flex items-center gap-3">
                <div class="relative">
                    <select name="filter" id="filter" class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out cursor-pointer">
                        <option value="semua">Semua Waktu</option>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                    <!-- Ikon panah bawah custom untuk select -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow-sm transition ease-in-out duration-150">
                    Filter
                </button>
            </form>
        </div>

        <!-- Statistik Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1: Total Pendapatan -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Total Pendapatan</h3>
                <!-- Opsional: Tambahkan format rupiah di sini jika nilainya belum diformat di controller -->
                <p class="text-2xl font-bold text-gray-900">{{ $totalHargaPenjualan }}</p>
            </div>

            <!-- Card 2: Total Pembeli Unik -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Total Pembeli Unik</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalPembeliUnik }} <span class="text-sm font-normal text-gray-400 ml-1">Orang</span></p>
            </div>

            <!-- Card 3: Total Produk Terjual -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Produk Terjual</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalProdukTerjual }} <span class="text-sm font-normal text-gray-400 ml-1">Item</span></p>
            </div>
        </div>

        <!-- Riwayat Order Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-semibold text-gray-800">Riwayat Pesanan</h2>
            </div>
            <div class="p-6">
                <!-- Pastikan penulisan prop di Blade benar (tanda kutip) -->
                <x-riwayat-order :orders="$ordersDone" />
            </div>
        </div>

    </div>
</x-dlayout>