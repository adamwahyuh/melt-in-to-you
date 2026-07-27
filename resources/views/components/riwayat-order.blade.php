@props(['orders' => []])

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