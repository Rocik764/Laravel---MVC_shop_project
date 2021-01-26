<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Informacje o produkcie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/sidebar_script.js') }}"></script>
    <script src="{{ asset('/js/amount_control.js') }}"></script>
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
                <span>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h2>{{ $product->name }}</h2>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="row">
                        <img src="{{ asset('uploads/images/'.$product->image) }}" alt="obrazek" style="width: 250px; height: 250px;">
                        <div class="col-md-7">
                            <p class="small text-white mb-0">
                                Opis: {{ $product->description }}<br/>
                                Ilość: {{ $product->quantity }}<br/>
                                Cena: {{ $product->price }}<br/>
                                Kategoria: {{ $product->category->name }}<br/>
                                Zwierzę: {{ $product->subcategory->name }}<br/>
                                Producent: {{ $product->producent->name }}
                            </p>
                        </div>
                        <div class="col-md-2">
                            <div>
                                @include('fragments.amount_control', ['amountValue' => 1])
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary" id="buttonAddToCart">Dodaj do koszyka</button>
                            </div>
                        </div>
                    </div>
                </div>
            </span>
            </div>
        </div>
    </div>
</div>
@include('fragments.standard_modal')
<script type="text/javascript" src="{{ asset('/js/add_to_cart.js') }}"></script>
<script type="text/javascript">
    const productId = "{{ $product->id }}";
    const url_route = "{{ route('cart_add') }}"
</script>
</body>
</html>
