<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New categories</title>
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
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h1>Add new category</h1>
                        <form action="{{ route('create_category') }}" method="post">
                            <div class="form-group row">
                                <label for="inputCategory" class="col-12 col-form-label text-center font-weight-bold">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control text-center" id="inputCategory" name="name">
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <div class="col-lg text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1>Add new subcategory</h1>
                        <form action="{{ route('create_subcategory') }}" method="post">
                            <div class="form-group row">
                                <label for="inputSubcategory" class="col-12 col-form-label text-center font-weight-bold">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control text-center" id="inputSubcategory" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg text-center mt-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <h1>Add new producent</h1>
                        <form action="{{ route('create_producent') }}" method="post">
                            <div class="form-group row">
                                <label for="inputProducentName" class="col-2 col-form-label text-center font-weight-bold">Name</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="inputProducentName" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputProducentCharacteristics" class="col-2 col-form-label text-center font-weight-bold">Characteristics</label>
                                <div class="col-10">
                                    <textarea type="text" class="form-control" id="inputProducentCharacteristics" name="characteristics" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="inputProducentPhone" class="col-2 col-form-label text-center font-weight-bold">Phone</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="inputProducentPhone" name="phone" value="+__ ___ ___ ___" data-mask="+__ ___ ___ ___">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Session::has('info'))
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <p class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('info') }}</p>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mt-5">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('/js/data_mask.js') }}"></script>
</body>
</html>
