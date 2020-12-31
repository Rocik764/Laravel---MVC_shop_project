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
            <h1>Stwórz nowego użytkownika (test)</h1>
            <form action="#" action="@{/admin/save}" object="${user}" method="post">
                <div class="form-group row">
                    <label for="inputFirstName" class="col-sm col-form-label  text-center font-weight-bold">Imię</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputFirstName" field="*{first_name}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLastName" class="col-sm col-form-label text-center font-weight-bold">Nazwisko</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputLastName" field="*{last_name}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm col-form-label text-center font-weight-bold">Email</label>
                    <div class="col-sm-11">
                        <input type="email" class="form-control" id="inputEmail" field="*{email}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm col-form-label text-center font-weight-bold">Hasło</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputPassword" field="*{password}">
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
