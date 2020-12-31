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
            <h1>Dodaj nowy produkt</h1>
            <form action="@{/product/saveProduct}" object="${product}" method="post">
                <div class="form-group row">
                    <label for="inputFirstName" class="col-sm col-form-label text-center font-weight-bold">Nazwa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputFirstName" field="*{name}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLastName" class="col-sm col-form-label text-center font-weight-bold">Opis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputLastName" field="*{description}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm col-form-label text-center font-weight-bold">Ilość</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputEmail" field="*{quantity}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm col-form-label text-center font-weight-bold">Cena</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputPassword" field="*{price}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputCategory" class="col-sm col-form-label text-center font-weight-bold">Kategoria</label>
                    <div class="col-sm-10">
                        <select id="inputCategory" class="selectpicker" field="*{category}">
                            <option value="${category.id}">[[${category.name}]]</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSubategory" class="col-sm col-form-label text-center font-weight-bold">Podkategoria</label>
                    <div class="col-sm-10">
                        <select id="inputSubategory" class="selectpicker" field="*{subcategory}">
                            <option value="${subcategory.id}">[[${subcategory.name}]]</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputProducent" class="col-sm col-form-label text-center font-weight-bold">Producent</label>
                    <div class="col-sm-10">
                        <select id="inputProducent" class="selectpicker" field="*{producent}">
                            <option value="${producent.id}">[[${producent.name}]]</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg text-center">
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
