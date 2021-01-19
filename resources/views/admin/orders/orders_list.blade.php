<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista zamówień</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('/js/sidebar_script.js') }}"></script>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Użytkownik</th>
                            <th>Zakupiono</th>
                            <th>Zrealizowano</th>
                            <th>Adres</th>
                            <th>Faktura</th>
                            <th>Telefon</th>
                            <th>Dostawa</th>
                            <th>Płatność</th>
                            <th>Zapłacono</th>
                            <th>Komentarz</th>
                            <th>Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr style="cursor: pointer" onclick="showDetails([[${order.user.getId()}]],[[${order.purchase_date}]])">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->purchase_date }}</td>
                            <td>{{ $order->is_completed }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->invoice }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->delivery }}</td>
                            <td>{{ $order->payment }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->comment }}</td>
                            <td>
                                <a href="{{ route('completeOrder', ['id' => $order->id]) }}">@php if($order->is_completed) echo 'Cofnij realizację'; else echo 'Zrealizuj' @endphp</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
