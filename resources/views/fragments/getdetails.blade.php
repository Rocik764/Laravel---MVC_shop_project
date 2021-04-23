<div>
{{--    @foreach($orderDetails as $details)--}}
{{--        <p>#{{ $details->id }}, Produkt: {{ $details->product->name }}, Użytkownik: {{ $details->user->name }}, Ilość: {{ $details->amount }}</p>--}}
{{--    @endforeach--}}
<table id="customers">
    <thead class="thead-dark">
        <tr>
            <th scope="col">@php echo 'Product'; @endphp</th>
            <th scope="col">@php echo 'User'; @endphp</th>
            <th scope="col">@php echo 'Quantity'; @endphp</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderDetails as $details)
        <tr>
            <td>{{ $details->product->name }}</td>
            <td>{{ $details->user->name }}</td>
            <td>{{ $details->amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</div>
