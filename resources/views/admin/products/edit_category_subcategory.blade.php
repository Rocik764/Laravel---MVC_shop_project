<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Nowe kategorie</title>
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
                <div class="row">
                    <div class="col-lg-4">
                        <h1>Kategorie</h1>
                        <ol>
                            @foreach($categories as $category)
                                <li>
                                    <div class="input-group mb-3">
                                        <input type="text" name="category" class="form-control " value="{{ $category->name }}" aria-label="" aria-describedby="basic-addon1" readonly="readonly" disabled>
                                        <div class="input-group-prepend">
                                            <a class="float-left btn btn-danger" href="{{ route('deleteCategory', ['id' => $category->id]) }}" >Usuń</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="col-lg-4">
                        <h1>Podkategorie</h1>
                        <ol>
                            @foreach($subcategories as $subcategory)
                                <li>
                                    <div class="input-group mb-3">
                                        <input type="text" name="subcategory" class="form-control " value="{{ $subcategory->name }}" aria-label="" aria-describedby="basic-addon1" readonly="readonly" disabled>
                                        <div class="input-group-prepend">
                                            <a class="float-left btn btn-danger" href="{{ route('deleteSubcategory', ['id' => $subcategory->id]) }}" >Usuń</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="col-lg-4">
                        <h1>Producenci</h1>
                        <ol>
                            @foreach($producents as $producent)
                                <li>
                                    <div class="input-group mb-3">
                                        <input type="text" name="producent" class="form-control " value="{{ $producent->name }}" aria-label="" aria-describedby="basic-addon1" readonly="readonly" disabled>
                                        <div class="input-group-prepend">
                                            <a class="float-left btn btn-danger" href="{{ route('deleteProducent', ['id' => $producent->id]) }}" >Usuń</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                @if($errors->any())
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <p class="alert alert-info">{{ $errors->first() }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
