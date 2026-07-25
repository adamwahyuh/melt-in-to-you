<x-dlayout title="Kasir">
    <div class="p-6 md:p-8 max-w-7xl mx-auto space-y-8">
        
        <!-- Header Dashboard -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-stone-200 pb-5">
            <div>
                <h1 class="text-3xl font-bold text-stone-800 tracking-tight">Kasir</h1>
            </div>
            <div class="shrink-0 bg-white px-4 py-2 rounded-lg border border-stone-200 shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-sm font-medium text-stone-700">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
        </div>

        <!-- Grid Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Card 1: Pendapatan Hari Ini -->
            <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-semibold text-stone-500 uppercase tracking-wider mb-1">Pendapatan Hari Ini</p>
                    <h3 class="text-2xl font-black text-stone-800">
                        Rp {{ number_format($todayEarnings, 0, ',', '.') }}
                    </h3>
                    <p class="text-xs text-green-600 font-medium mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Pesanan Selesai
                    </p>
                </div>
            </div>

            <!-- Card 2: Pesanan Hari Ini -->
            <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-semibold text-stone-500 uppercase tracking-wider mb-1">Pesanan Hari Ini</p>
                    <h3 class="text-3xl font-black text-stone-800">
                        {{ $todayOrders->count() }} <span class="text-sm font-medium text-stone-400">Order</span>
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Total pesanan masuk hari ini
                    </p>
                </div>
            </div>

            <!-- Card 3: Pelanggan Hari Ini -->
            <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-semibold text-stone-500 uppercase tracking-wider mb-1">Pelanggan Hari Ini</p>
                    <h3 class="text-3xl font-black text-stone-800">
                        {{ $todayCustomers }} <span class="text-sm font-medium text-stone-400">Orang</span>
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Pelanggan unik yang bertransaksi
                    </p>
                </div>
            </div>
            
        </div>

        <!-- ==================== PESANAN AKTIF ==================== -->
        <!-- Header Daftar Pesanan -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-stone-200 pb-4 mt-10">
            <div>
                <h2 class="text-2xl font-bold text-stone-800 tracking-tight">Pesanan Aktif</h2>
                <p class="text-stone-500 mt-1 text-sm">Kelola status pesanan pelanggan yang sedang berlangsung di sini.</p>
            </div>
        </div>

        <!-- List Pesanan Kasir (Aktif) -->
        <div class="flex flex-col space-y-5">
            @forelse ($orders->whereNull('diterima_pada') as $order)
                <div class="bg-white rounded-xl border border-stone-200 shadow-sm hover:shadow-md transition-shadow duration-300 p-6">
                    
                    <!-- Top: Info User, Tanggal, dan Status -->
                    <div class="flex flex-col md:flex-row justify-between md:items-center border-b border-stone-100 pb-4 mb-4 gap-4">
                        <div class="flex items-start gap-4">
                            <!-- Avatar Initial Pelanggan -->
                            <div class="w-12 h-12 rounded-full bg-stone-100 text-stone-600 border border-stone-200 flex items-center justify-center font-bold text-lg shrink-0">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-stone-800">{{ $order->user->name }}</h3>
                                <p class="text-sm text-stone-500">
                                    {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y - H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        <div>
                            <!-- Badge Status -->
                            <span class="inline-flex px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-md bg-amber-100 text-amber-700 border border-amber-200">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Middle: Daftar Produk yang Dipesan -->
                    <div class="bg-stone-50 rounded-lg p-4 border border-stone-100 mb-5">
                        <ul class="space-y-3">
                            @foreach ($order->details as $detail)
                                <li class="flex justify-between items-start text-sm">
                                    <div class="flex items-start gap-3">
                                        <span class="font-bold text-amber-700 bg-amber-100 px-2 py-0.5 rounded text-xs mt-0.5">
                                            {{ $detail->quantity }}x
                                        </span>
                                        <span class="text-stone-700 font-medium">
                                            {{ $detail->product->name }}
                                        </span>
                                    </div>
                                    <span class="font-semibold text-stone-600 whitespace-nowrap ml-4 mt-0.5">
                                        Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Bottom: Total & Aksi -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-2">
                        <div class="text-left w-full sm:w-auto">
                            <p class="text-[11px] uppercase tracking-wider text-stone-400 font-bold mb-1">Total Pesanan</p>
                            <p class="text-xl font-black text-amber-900">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <!-- Tombol Aksi Berdasarkan Status -->
                        <div class="w-full sm:w-auto flex gap-3">
                            @if (strtolower($order->status) === 'dipesan')
                                <form action="{{ route('put.dashboard.kasir.order.tandai_diproses', $order->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Proses pesanan ini sekarang?')" class="w-full inline-flex justify-center items-center bg-amber-600 hover:bg-amber-700 text-white font-medium py-2.5 px-5 rounded-lg transition-colors duration-200 text-sm shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        Tandai Diproses
                                    </button>
                                </form>
                            @endif
                            
                            @if (strtolower($order->status) === 'diproses')
                                <form action="{{ route('put.dashboard.kasir.order.tandai_dikirim', $order->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Tandai pesanan ini sebagai dikirim/siap diambil?')" class="w-full inline-flex justify-center items-center bg-stone-800 hover:bg-stone-900 text-white font-medium py-2.5 px-5 rounded-lg transition-colors duration-200 text-sm shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                        </svg>
                                        Tandai Dikirim
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-xl border border-dashed border-stone-300">
                    <div class="text-stone-300 mb-4 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-stone-700">Belum ada pesanan aktif</h3>
                    <p class="text-stone-500 mt-1 text-sm">Pesanan dari pelanggan akan otomatis muncul di sini.</p>
                </div>
            @endforelse
        </div>

        <!-- ==================== RIWAYAT PESANAN ==================== -->
        <!-- Header Riwayat -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-stone-200 pb-4 mt-16">
            <div>
                <h2 class="text-2xl font-bold text-stone-800 tracking-tight">Riwayat Pesanan</h2>
                <p class="text-stone-500 mt-1 text-sm">Lihat pesanan yang sudah selesai berdasarkan tanggal.</p>
            </div>
            <!-- Input Filter Tanggal -->
            <div class="w-full sm:w-64">
                <label for="historyDateSearch" class="block text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">Cari berdasarkan tanggal</label>
                <div class="relative">
                    <input type="date" id="historyDateSearch" class="w-full border border-stone-300 text-stone-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors">
                </div>
            </div>
        </div>

        <!-- List Riwayat Pesanan -->
        <div class="flex flex-col space-y-5" id="historyListContainer">
            @forelse ($orders->whereNotNull('diterima_pada') as $order)
                <!-- Attribute data-date ditambahkan untuk memudahkan filter JS -->
                <div class="history-card bg-white/60 rounded-xl border border-stone-200 shadow-sm p-6" data-date="{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}">
                    
                    <div class="flex flex-col md:flex-row justify-between md:items-center border-b border-stone-100 pb-4 mb-4 gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-stone-200 text-stone-500 border border-stone-300 flex items-center justify-center font-bold text-lg shrink-0">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-stone-700">{{ $order->user->name }}</h3>
                                <p class="text-sm text-stone-500">
                                    {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y - H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        <div>
                            <span class="inline-flex px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-md bg-green-100 text-green-700 border border-green-200">
                                Selesai
                            </span>
                        </div>
                    </div>

                    <div class="bg-stone-100/50 rounded-lg p-4 mb-4">
                        <ul class="space-y-2 text-sm">
                            @foreach ($order->details as $detail)
                                <li class="flex justify-between items-start">
                                    <div class="flex items-start gap-2">
                                        <span class="text-stone-500">{{ $detail->quantity }}x</span>
                                        <span class="text-stone-600">{{ $detail->product->name }}</span>
                                    </div>
                                    <span class="text-stone-500 ml-4">
                                        Rp {{ number_format($detail->sub_total, 0, ',', '.') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <div>
                            <p class="text-[11px] uppercase tracking-wider text-stone-400 font-bold mb-1">Total Transaksi</p>
                            <p class="text-lg font-bold text-stone-700">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-white rounded-xl border border-dashed border-stone-300">
                    <p class="text-stone-500 text-sm">Belum ada riwayat pesanan yang selesai.</p>
                </div>
            @endforelse
            
            <!-- Empty State untuk Search -->
            <div id="noResultState" class="hidden text-center py-10 bg-white rounded-xl border border-dashed border-stone-300">
                <p class="text-stone-500 text-sm">Tidak ada riwayat pesanan pada tanggal tersebut.</p>
            </div>
        </div>
        
    </div>

    <!-- Script Filter Tanggal Pure JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('historyDateSearch');
            const historyCards = document.querySelectorAll('.history-card');
            const noResultState = document.getElementById('noResultState');

            dateInput.addEventListener('change', function(e) {
                const selectedDate = e.target.value; // Format: YYYY-MM-DD
                let visibleCount = 0;

                historyCards.forEach(card => {
                    const cardDate = card.getAttribute('data-date');
                    
                    // Jika tidak ada tanggal yang dipilih, atau tanggal cocok dengan data-date
                    if (!selectedDate || cardDate === selectedDate) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Menampilkan state kosong jika pencarian tidak menemukan hasil
                if (visibleCount === 0 && historyCards.length > 0) {
                    noResultState.classList.remove('hidden');
                } else {
                    noResultState.classList.add('hidden');
                }
            });
        });
    </script>
</x-dlayout>