<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Koszyk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="{{ asset('js/app.js') }}"></script>
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
                <p>Koszyk użytkownika: {{ Auth::user()->name }}</p>
                <div class="row m-1">
                    <div class="col-lg-8">
                        @php if($cart == null) { @endphp
                            <p class="alert alert-info">Brak produktów w koszyku.</p>
                        @php } else { @endphp
                            @foreach($cart as $item)
    {{--                            <div class="row border rounded" th:with="product = ${item.product}" th:id="'row' + ${status.count}">--}}
                                <div class="row border rounded" id="<?php echo 'row'.$loop->index ?>">
                                    <div class="col-lg-1">
    {{--                                    <div class="mt-2">[[${status.count}]]</div>--}}
                                        <div class="mt-2">
{{--                                            <a class="link-remove" href="{{ '/cart/remove/'.$item->product->id.'/'.$item->amount }}" id="{{ $loop->index }}">--}}
                                            <a class="link-remove" href="{{ route('cart_remove', ['productId' => $item->product->id, 'amount' => $item->amount]) }}" id="{{ $loop->index }}">
                                                <img src="{{ asset('/img/removeFromCart.png') }}" alt="remove"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <img src="{{ asset('uploads/images/'.$item->product->image) }}" alt="obrazek" style="width: 250px; height: 250px;">
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <a href="{{ route('show_product_info', $item->product->id) }}"><b>{{ $item->product->name }}</b></a>
                                        </div>
                                        <div>
    {{--                                        <div th:replace="/fragments/amount_control :: amount_control(${item.amount}, ${item.product.id})">Ilość</div>--}}
                                            @include('fragments.amount_control', ['product' => $item->product, 'amountValue' => $item->amount])
                                        </div>
                                        <div>
                                            <span>x</span>
                                            <span>{{ $item->product->price }}&nbsp;zł</span>
                                        </div>
                                        <div>
                                            <span>=&nbsp;</span><span class="h4 productSubtotal" id="<?php echo 'subtotal'.$item->product->id?>">{{ $item->getSubtotal() }}</span><span class="h4">&nbsp;zł</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-1">&nbsp;</div>
                            @endforeach
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <span class="h3">Podsumowanie:</span>
                        </div>
                        <div class="mt-2">
                            <span class="h2" id="totalAmount"></span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('show_order_info') }}"><button class="btn btn-danger p-3 mt-2">Zakup</button></a>
                        </div>
                    </div>
                    @php } @endphp
                </div>
            </div>
        </div>
    </div>
</div>
@include('fragments.standard_modal')
<script type="text/javascript" src="{{ asset('/js/shopping_cart_update_total.js') }}"></script>
<script>
    const url_plus_minus = "{{ route('cart_update') }}"
</script>
</body>
</html>
