<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
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
            <h1>Edytuj produkt z ID:</h1>
            @if(!isset($formType))
            @elseif($formType === 'update')
            <form action="{{ route('manage.update', ['id' => $productId]) }}" method="post">
                <input type="input" name="id" value="{{ $productId }}">
                <div class="form-group row">
                    <label for="inputName" class="col-sm col-form-label text-center font-weight-bold">Nazwa</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDescription" class="col-sm col-form-label text-center font-weight-bold">Opis</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputQuantity" class="col-sm col-form-label text-center font-weight-bold">Ilość</label>
                    <div class="col-sm-11">
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNumber" class="col-sm col-form-label text-center font-weight-bold">Cena</label>
                    <div class="col-sm-11">
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNumber" class="col-sm col-form-label text-center font-weight-bold">Kategoria</label>
                    <div class="col-sm-11">
                        <input type="number" class="form-control" id="category_id" name="category_id" value="{{ $product->category_id }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNumber" class="col-sm col-form-label text-center font-weight-bold">Producent</label>
                    <div class="col-sm-11">
                        <input type="number" class="form-control" id="producent_id" name="producent_id" value="{{ $product->producent_id }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNumber" class="col-sm col-form-label text-center font-weight-bold">Podkategoria</label>
                    <div class="col-sm-11">
                        <input type="number" class="form-control" id="subcategory_id" name="subcategory_id" value="{{ $product->subcategory_id }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg text-center">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
</body>
</html>
