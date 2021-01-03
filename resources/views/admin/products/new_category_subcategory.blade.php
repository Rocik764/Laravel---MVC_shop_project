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
@include('admin.products.resources.views.fragments.animated')
<header>
    @include('admin.products.resources.views.fragments.menu')
</header>
<div class="wrapper">
    <nav id="sidebar">
        @include('admin.products.resources.views.fragments.side_menu')
    </nav>

    <div id="content">
        @include('admin.products.resources.views.fragments.side_menu_collapse')
        <div id="content-main">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h1>Dodaj nową kategorię</h1>
                        <form action="#" action="@{/product/saveCategory}" object="${category}" method="post">
                            <div class="form-group row">
                                <label for="inputCategory" class="col-12 col-form-label text-center font-weight-bold">Nazwa</label>
                                <div class="col-12">
                                    <input type="text" class="form-control text-center" id="inputCategory" field="*{name}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg text-center">
                                    <button type="submit" class="btn btn-primary">Zapisz</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1>Dodaj nową podkategorię</h1>
                        <form action="#" action="@{/product/saveSubcategory}" object="${subcategory}" method="post">
                            <div class="form-group row">
                                <label for="inputSubcategory" class="col-12 col-form-label text-center font-weight-bold">Nazwa</label>
                                <div class="col-12">
                                    <input type="text" class="form-control text-center" id="inputSubcategory" field="*{name}" required>
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
        </div>
    </div>
</div>
</body>
</html>
