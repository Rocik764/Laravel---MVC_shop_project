<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Nowy produkt</title>
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
                <h1>Dodaj nowy produkt</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('create_product')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputFirstName" class="col-sm col-form-label text-center font-weight-bold">Nazwa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputFirstName" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputLastName" class="col-sm col-form-label text-center font-weight-bold">Opis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputLastName" name="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm col-form-label text-center font-weight-bold">Ilość</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputEmail" name="quantity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm col-form-label text-center font-weight-bold">Cena</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" class="form-control" id="inputPassword" name="price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputCategory" class="col-sm col-form-label text-center font-weight-bold">Kategoria</label>
                        <div class="col-sm-10">
                            <select id="inputCategory" class="selectpicker" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSubategory" class="col-sm col-form-label text-center font-weight-bold">Zwierzę</label>
                        <div class="col-sm-10">
                            <select id="inputSubategory" class="selectpicker" name="subcategory_id">
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputProducent" class="col-sm col-form-label text-center font-weight-bold">Producent</label>
                        <div class="col-sm-10">
                            <select id="inputProducent" class="selectpicker" name="producent_id">
                                @foreach($producents as $producent)
                                    <option value="{{ $producent->id }}">{{ $producent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm col-form-label text-center font-weight-bold">Obrazek</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" class="form-control-file" id="image" accept="image/png, image/jpeg" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg text-center">
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
