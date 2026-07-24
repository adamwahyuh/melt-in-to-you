<x-layout title="Order">
    @foreach ($orders as $order)
        <p>{{ $order->created_at }}</p>
        <p>{{ $order->status }}</p>
        @foreach ($order->details as $detail)
            <p>{{ $detail->quantity }} x {{ $detail->product->name }} : {{ $detail->sub_total }}</p>
        @endforeach
    @endforeach
</x-layout>