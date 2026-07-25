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

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-stone-200 pb-5">
            <div>
                <h1 class="text-3xl font-bold text-stone-800 tracking-tight">Pesanan</h1>

            </div>
        </div>

        <div class="">
            @foreach ($orders as $order )
                <p>{{ $order->created_at }}</p>
                <p>{{ $order->user->name }}</p>
                <p>{{ $order->status }}</p>
                @foreach ($order->details as $detail)
                    <p>{{ $detail->quantity }} x {{ $detail->product->name }} : {{ $detail->sub_total }}</p>
                @endforeach
                <p>Total {{  $order->total_harga }}</p>
                
                @if (strtolower($order->status) === 'dipesan')
                    <form action="{{ route('put.dashboard.kasir.order.tandai_diproses', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button>Tandai sedang diproses</button>
                    </form>
                @endif
                
                @if (strtolower($order->status) === 'diproses')
                    <form action="{{ route('put.dashboard.kasir.order.tandai_dikirim', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button>Tandai dikirim</button>
                    </form>
                @endif


            @endforeach
        </div>
    </div>
</x-dlayout>