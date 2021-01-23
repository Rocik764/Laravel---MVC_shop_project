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
            <div class="container">
                <h1>Strona główna</h1>
                @if(\Illuminate\Support\Facades\Session::has('info'))
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <p class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('info') }}</p>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-6">
                        <div class="alert alert-primary" role="alert">
                            <h2>Konta</h2>
                            <p>
                                Admin:<br/>
                                login: admin@mail.com<br/>
                                hasło: 123456<br/><br/>
                                Employee:<br/>
                                login: employee@mail.com<br/>
                                hasło: 123456<br/><br/>
                                User:<br/>
                                login: user@mail.com<br/>
                                hasło: 123456
                            </p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="alert alert-secondary" role="alert">
                            <h2>Co może robić itp.</h2>
                            <p>
                                Admin:<br/>
                                Konto -> administracja (dodawanie użytkowników (cele testowe) / edycja użytkowników (role, hasła, nazwy itp) -> zamówienia (realizacja zamówień) itp.
                                Menu podręczne -> Zarządzanie (produktami / użytkownikami / kategoriami)<br/><br/>
                                Employee:<br/>
                                Konto -> zamówienia (realizacja zamówień) itp.
                                Menu podręczne -> Zarządzanie (produktami / kategoriami)<br/><br/>
                                User:<br/>
                                Menu podręczne -> Filtrowanie produktów / dodawanie do koszyka / zamawianie ich / edycja profilu itp.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
