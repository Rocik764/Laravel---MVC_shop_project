<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Orders list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/sidebar_script.js') }}"></script>
    <script src="{{ asset('/js/amount_control.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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
                            <th>User</th>
                            <th>Bought</th>
                            <th>Realized</th>
                            <th>Address</th>
                            <th>Invoice</th>
                            <th>Phone</th>
                            <th>Delivery</th>
                            <th>Payment</th>
                            <th>Paid</th>
                            <th>Comment</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr style="cursor: pointer" onclick="showDetails( {{ $order->user->id }}, new Date('{{ $order->purchase_date }}'), {{ $order->id }} )">
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
                                <a href="{{ route('completeOrder', ['id' => $order->id]) }}"><span>@php if($order->is_completed) echo 'undo'; else echo 'realize' @endphp</span></a>
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
@include('fragments.order_details_modal')
<script>

    function showDetails(uId, date, id) {
        console.log(formatDate(date))
        const url_route = "{{ route('get_orders_details') }}"
        showDetailsModal(url_route, uId, date, id)
    }

    function showDetailsModal(url, uId, date, id) {
        console.log("showDetailsModal " + url + " : " + date)
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            type: "POST",
            url: url,
            data:{
                _token: CSRF_TOKEN,
                uId: uId,
                date: formatDate(date)
            },
        }).done(function (response) {
            $("#modalDetailsTitle").text("Order details with ID = " + id)
            $("#modalDetailsBody").html(response)
            $("#myDetailsModal").modal()
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("failed: ");
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
            $("#modalDetailsTitle").text("Order details")
            $("#modalDetailsBody").text("Something went wrong")
            $("#myDetailsModal").modal()
        });
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('.');
    }
</script>
</body>
</html>
