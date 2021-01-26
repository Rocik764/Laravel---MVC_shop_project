<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Produkty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
                <div class="row">
                    @if(\Illuminate\Support\Facades\Session::has('info'))
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <p class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('info') }}</p>
                            </div>
                        </div>
                    @endif
                        @if(count($products) == 0)
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <p class="alert alert-info">Nie ma takich kategorii.</p>
                            </div>
                        </div>
                        @endif
                    @foreach($products as $product)
                    @if($loop->index < 4)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="rounded shadow-sm productItem">
                                <a href="{{ route('show_product_info', $product->id) }}">
                                    <img src="{{ asset('uploads/images/'.$product->image) }}" alt="obrazek" style="width: 250px; height: 250px;">
                                    <div class="p-4">
                                        <p class="small text-white mb-0">
                                            <b>{{ $product->name }}</b><br/>
                                            Ilość: {{ $product->quantity }}<br/>
                                            Cena: {{ $product->price }}<br/>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
                <div class="row">
                    @foreach($products as $product)
                    @if($loop->index >= 4)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="rounded shadow-sm productItem">
                                <a href="{{ route('show_product_info', $product->id) }}">
                                    <img src="{{ asset('uploads/images/'.$product->image) }}" alt="obrazek" style="width: 250px; height: 250px;">
                                    <div class="p-4">
                                        <p class="small text-white mb-0">
                                            <b>{{ $product->name }}</b><br/>
                                            Ilość: {{ $product->quantity }}<br/>
                                            Cena: {{ $product->price }}<br/>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
                <div class="row">
                    <div>{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
