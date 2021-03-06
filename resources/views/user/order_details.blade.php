<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Order details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="{{ asset('js/app.js') }}"></script>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('order_products') }}" method="POST">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>Delivery and payment</h2>
                            <div>
                                <h4>Delivery</h4>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="delivery" value="kurier">Courier - InPost, UPS, FedEx, DTS lub Poczta Polska
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="delivery" value="osobiście">Personally
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="delivery" value="paczkomat">Paczkomaty 24/7
                                    </label>
                                </div>
                            </div>
                            <div>
                                <h4>Payment method</h4>
                                    <div class="form-check">
                                    <label class="form-check-label active">
                                    <input type="radio" class="form-check-input" name="payment" value="blik">BLIK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="przelew">Transfer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="przy odbiorze">Upon receipt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="karta płatnicza">Debit card
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="dotpay">Fast transfer Dotpay
                                    </label>
                                </div>
                            </div>
                            <div>
                                <h4>Orderer's data</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-1" name="address" placeholder="Street">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-3" name="code" placeholder="Postal code" value="__-___" data-mask="__-___">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-3" name="city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-3" name="phone" placeholder="Phone" value="+__ ___ ___ ___" data-mask="+__ ___ ___ ___">
                                </div>
                            </div>
                            <div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="invoice" class="form-check-input" value="">I want an invoice
                                </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox" value="scheckbox" />I want to add a comment
                                    </label>
                                </div>
                                <div class="form-group" id="otherFieldDiv">
                                    <input id="comment" class="form-control" name="comment" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <span class="h3">Total:</span>
                            </div>
                            <div class="mt-2">
                                <span class="h2" id="totalPrice">{{ $subtotal }}</span>
                            </div>
                            <div>
                                <span>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input id="regulations" name="regulations" type="checkbox" class="form-check-input">
                                            I accept the <a href="#regulationsModal" class="regulations" data-toggle="modal" data-target="#regulationsModal">regulations</a>
                                        </label>
                                    </div>
                                </span>
                            </div>
                            <div class="mt-2">
                                {{ csrf_field() }}
                                <a href="#"><button class="btn btn-danger p-3 mt-2">Order</button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('fragments.standard_modal')
@include('fragments.regulations_modal')
<script type="text/javascript" src="{{ asset('/js/data_mask.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('input[name="comment"]').hide();

        //show it when the checkbox is clicked
        $('input[name="checkbox"]').on('click', function () {
            if ($(this).prop('checked')) {
                $('input[name="comment"]').fadeIn();
            } else {
                $('input[name="comment"]').hide();
            }
        });
    });
</script>
</body>
</html>
