<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Order's details</title>
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
                <h2>{{ auth()->user()->name }}'s orders</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bought</th>
                        <th scope="col">Address</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Delivery</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr onclick="showDetails( new Date('{{ $order->purchase_date }}') )" style="cursor: pointer; @php if($order->is_completed) echo 'background: green'; else echo 'background: red'; @endphp">
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
@include('fragments.order_details_modal')
<script>
    function showDetails(date) {
        const url_route = "{{ route('get_details') }}"
        showDetailsModal(url_route, date)
    }

    function showDetailsModal(url, date) {
        console.log("showDetailsModal ", url)
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            type: "POST",
            url: url,
            data:{
                _token: CSRF_TOKEN,
                date: formatDate(date)
            },
        }).done(function (response) {
            // let array = response.split("  ")
            // array.forEach(function(item) {
            //     $('#resultGetAllCustomerDiv .list-group').append("<li class=\"list-group-item\">" + item + "</li>");
            // })
            $("#modalDetailsTitle").text("Products details")
            $("#modalDetailsBody").html(response)
            $("#myDetailsModal").modal()
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log("failed: ");
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
            $("#modalDetailsTitle").text("Products details")
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
