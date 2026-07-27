{{--
    Kontrak buat backend:

    return view('customer.orders', [
        'orders' => auth()->user()->orders()->with('details.product')->latest()->get(),
    ]);
--}}
<x-clayout title="Riwayat Pesanan - melt in to you" active-nav="riwayat">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-amber-50 sm:text-3xl">Riwayat Pesanan</h1>
        <p class="mt-1 text-sm text-amber-50/60">Pantau status pesanan kamu di sini.</p>
    </div>

    @if ($orders->isEmpty())
        <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-amber-50/20 py-20 text-center">
            <svg class="h-10 w-10 text-amber-50/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="mt-3 text-sm font-medium text-amber-50/70">Belum ada pesanan</p>
            <a href="{{ route('index') }}" class="mt-4 rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-black transition-colors hover:bg-amber-400">
                Mulai Pesan
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                @php
                    // urutan step: dipesan -> diproses -> dikirim -> diterima
                    $steps = [
                        ['label' => 'Dipesan', 'done' => (bool) $order->dipesan_pada, 'at' => $order->dipesan_pada],
                        ['label' => 'Diproses', 'done' => (bool) $order->diproses_pada, 'at' => $order->diproses_pada],
                        ['label' => 'Dikirim', 'done' => (bool) $order->dikirim_pada, 'at' => $order->dikirim_pada],
                        ['label' => 'Diterima', 'done' => (bool) $order->diterima_pada, 'at' => $order->diterima_pada],
                    ];
                    $totalOrder = $order->details->sum(fn ($d) => $d->quantity * $d->harga_dalam_rupiah);
                @endphp

                <div class="rounded-2xl border border-amber-50/10 bg-amber-50/5 p-5">
                    <div class="flex flex-wrap items-center justify-between gap-2 border-b border-amber-50/10 pb-4">
                        <div>
                            <p class="text-xs text-amber-50/40">Pesanan</p>
                            <p class="font-mono text-sm text-amber-50/70">#{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::limit($order->id, 8, '')) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-amber-50/40">Total</p>
                            <p class="font-semibold text-amber-300">Rp{{ number_format($totalOrder, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Stepper status --}}
                    <div class="flex items-center justify-between py-5">
                        @foreach ($steps as $i => $step)
                            <div class="flex flex-1 items-center">
                                <div class="flex flex-col items-center gap-1.5 text-center">
                                    <div class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold
                                        {{ $step['done'] ? 'bg-amber-500 text-black' : 'bg-amber-50/10 text-amber-50/30' }}">
                                        @if ($step['done'])
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        @else
                                            {{ $i + 1 }}
                                        @endif
                                    </div>
                                    <span class="text-[11px] font-medium {{ $step['done'] ? 'text-amber-50' : 'text-amber-50/30' }}">{{ $step['label'] }}</span>
                                </div>

                                @if (!$loop->last)
                                    <div class="mx-1 h-0.5 flex-1 {{ $step['done'] ? 'bg-amber-500' : 'bg-amber-50/10' }}"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Item pesanan --}}
                    <div class="space-y-2 border-t border-amber-50/10 pt-4">
                        @foreach ($order->details as $detail)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-amber-50/70">{{ $detail->quantity }}x {{ $detail->product->name }}</span>
                                <span class="text-amber-50/50">Rp{{ number_format($detail->quantity * $detail->harga_dalam_rupiah, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</x-clayout>
