<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Szczegóły zamówienia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/sidebar_script.js') }}"></script>
</head>
<body>
@include('fragments.animated')
<header>
    @include('fragments.menu')
</header>
<div class="wrapper">
    <nav id="sidebar">
        @include('fragments.side_menu')
    </nav>

    <div id="content">
        @include('fragments.side_menu_collapse')
        <div id="content-main">
            <div class="container">
                <h2>Zamówienia użytkownika {{ auth()->user()->name }}</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Zakupiono</th>
                        <th scope="col">Adres</th>
                        <th scope="col">Faktura</th>
                        <th scope="col">Telefon</th>
                        <th scope="col">Dostawa</th>
                        <th scope="col">Płatność</th>
                        <th scope="col">Zapłacono</th>
                        <th scope="col">Komentarz</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr style="@php if($order->is_completed) echo 'background: green'; else echo 'background: red'; @endphp">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $order->purchase_date }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->invoice }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->delivery }}</td>
                        <td>{{ $order->payment }}</td>
                        <td>{{ $order->total_price }} zł</td>
                        <td>{{ $order->comment }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('fragments.standard_modal')
</body>
</html>
