<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
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
            <h3>Profil:</h3>
            <form action="{{ route('edit_name') }}" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-secondary" type="submit" id="btnSaveName" disabled>Zapisz</button>
                        <button class="btn btn-outline-secondary" type="button" id="btnEditName"><span>Edytuj</span></button>
                    </div>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly="readonly">
                </div>
            </form>
            <form action="{{ route('edit_email') }}" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-secondary" type="submit" id="btnSaveMail" disabled>Zapisz</button>
                        <button class="btn btn-outline-secondary" type="button" id="btnEditMail"><span>Edytuj</span></button>
                    </div>
                    <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly="readonly">
                </div>
            </form>
            <form action="{{ route('edit_password') }}" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        {{ csrf_field() }}
                        <button class="btn btn-outline-secondary" type="submit" id="btnSavePassword" disabled>Zapisz</button>
                        <button class="btn btn-outline-secondary" type="button" id="btnEditPassword"><span>Edytuj</span></button>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Nowe hasło" readonly="readonly">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnEditMail').click(function() {
            if($("#btnSaveMail").is(":disabled")) {
                $("input[name='email']").removeAttr("readonly")
                $("#btnSaveMail").prop("disabled", false)
                $("#btnEditMail span").text("Anuluj")
            } else {
                $("input[name='email']").prop("readonly", true)
                $("#btnSaveMail").prop("disabled", true)
                $("#btnEditMail span").text("Edytuj")
            }
        })
    })
    $(document).ready(function() {
        $('#btnEditName').click(function() {
            if($("#btnSaveName").is(":disabled")) {
                $("input[name='name']").removeAttr("readonly")
                $("#btnSaveName").prop("disabled", false)
                $("#btnEditName span").text("Anuluj")
            } else {
                $("input[name='name']").prop("readonly", true)
                $("#btnSaveName").prop("disabled", true)
                $("#btnEditName span").text("Edytuj")
            }
        })
    })
    $(document).ready(function() {
        $('#btnEditLastName').click(function() {
            if($("#btnSaveLastName").is(":disabled")) {
                $("input[name='last_name']").removeAttr("readonly")
                $("#btnSaveLastName").prop("disabled", false)
                $("#btnEditLastName span").text("Anuluj")
            } else {
                $("input[name='last_name']").prop("readonly", true)
                $("#btnSaveLastName").prop("disabled", true)
                $("#btnEditLastName span").text("Edytuj")
            }
        })
    })
    $(document).ready(function() {
        $('#btnEditPassword').click(function() {
            if($("#btnSavePassword").is(":disabled")) {
                $("input[name='password']").removeAttr("readonly")
                $("#btnSavePassword").prop("disabled", false)
                $("#btnEditPassword span").text("Anuluj")
            } else {
                $("input[name='password']").prop("readonly", true)
                $("#btnSavePassword").prop("disabled", true)
                $("#btnEditPassword span").text("Edytuj")
            }
        })
    })
</script>
</body>
</html>
