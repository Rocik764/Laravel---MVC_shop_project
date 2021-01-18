<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista produktów</title>
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
            @if(\Illuminate\Support\Facades\Session::has('info'))
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('info') }}</p>
                    </div>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Obrazek</th>
                        <th>Nazwa</th>
                        <th>Opis</th>
                        <th>Ilość</th>
                        <th>Cena</th>
                        <th>Kategoria</th>
                        <th>Podkategoria</th>
                        <th>Producent</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr @foreach($products as $product)>
                        <td>
                            @php
                                ob_start();
                                fpassthru($product->image);
                                $contents = ob_get_contents();
                                ob_end_clean();

                                $dataUri = "data:image/jpeg;base64," . base64_encode($contents);
                                echo "<img src='$dataUri' style=\"width: 50px; height: 50px;\"/>";
                            @endphp
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>{{ $product->producent->name }}</td>
                        <td>
                            <a href="{{ route('update_product_get', ['id' => $product->id]) }}">Edit</a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('delete_product', ['id' => $product->id]) }}">Delete</a>
                        </td>
                    </tr @endforeach>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
