<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2>Contact</h2>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>Online shop</h4>
                        <div class="line"></div>
                        <p><b>Email:</b> mail@mail.com<br/>
                            <b>Telefon:</b> 58 123 456 789</p>
                        <p>Working hours:</p>
                        <div class="line"></div>
                        <p><b>monday - friday:</b> 08:00 - 21:00<br/>
                            <b>saturday - sunday:</b> 08:00 - 19:00</p>
                    </div>
                    <div class="col">
                        <h4>Address</h4>
                        <div class="line"></div>
                        <p><b>Shop:</b></p>
                        <div class="line"></div>
                        <p>80-000 Gdańsk<br/>
                            ul. street 25</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
