<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit product</title>
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
                <h1>Edit product with ID:</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!isset($formType))
                @elseif($formType === 'update')
                    <form action="{{ route('update_product_post', ['id' => $productId]) }}" method="post">
                        <input type="input" name="id" value="{{ $productId }}" hidden>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm col-form-label text-center font-weight-bold">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputDescription" class="col-sm col-form-label text-center font-weight-bold">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputQuantity" class="col-sm col-form-label text-center font-weight-bold">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputNumber" class="col-sm col-form-label text-center font-weight-bold">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputCategory" class="col-sm col-form-label text-center font-weight-bold">Category</label>
                            <div class="col-sm-10">
                                <select id="inputCategory" class="selectpicker" name="category_id" >
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($product->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSubategory" class="col-sm col-form-label text-center font-weight-bold">Subcategory</label>
                            <div class="col-sm-10">
                                <select id="inputSubategory" class="selectpicker" name="subcategory_id">
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" @if($product->subcategory->id == $subcategory->id) selected @endif>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputProducent" class="col-sm col-form-label text-center font-weight-bold">Producent</label>
                            <div class="col-sm-10">
                                <select id="inputProducent" class="selectpicker" name="producent_id">
                                    @foreach($producents as $producent)
                                        <option value="{{ $producent->id }}" @if($product->producent->id == $producent->id) selected @endif>{{ $producent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg text-center">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
