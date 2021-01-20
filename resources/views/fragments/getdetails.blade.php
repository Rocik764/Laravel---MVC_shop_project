<div
    @foreach($orderDetails as $details)
        <p>#{{ $details->id }}, Produkt: {{ $details->product->name }}, Użytkownik: {{ $details->user->name }}, Ilość: {{ $details->amount }}</p>
    @endforeach
</div>
