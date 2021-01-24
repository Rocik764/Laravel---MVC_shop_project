<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Filtry</title>
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
                <h1>Filtrowanie</h1>
                <form action="{{ route('post_filtering') }}" method="POST">
                    <div class="form-group">
                        <label for="filter-word">Wpisz wyszukiwaną frazę</label>
                        <input type="text" class="form-control" id="filter-word" name="filterWord">
                    </div>
                    <div class="form-group">
                        <label for="filter-price-from">Cena od</label>
                        <input type="number" step="0.01" class="form-control" id="filter-price-from" name="filterPriceFrom" min="0" value="0">
                    </div>
                    <div class="form-group">
                        <label for="filter-price-to">Cena do</label>
                        <input type="number" step="0.01" class="form-control" id="filter-price-to" name="filterPriceTo" min="0">
                    </div>
                    <div class="form-group">
                        <label for="inputCategory">Kategoria</label>
                        <select id="inputCategory" name="category" class="form-control">
                            <option value="">Wszystko</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputProducent">Producent</label>
                        <select id="inputProducent" name="producent" class="form-control">
                            <option value="">Wszystko</option>
                            @foreach($producents as $producent)
                                <option value="{{ $producent->id }}">{{ $producent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputSubategory">Zwierzę</label>
                        <select id="inputSubategory" name="subcategory" class="form-control">
                            <option value="">Wszystko</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg text-center">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Szukaj</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
