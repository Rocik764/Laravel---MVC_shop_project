<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style2.css') }}" />
    <script src="{{ mix('js/app.js') }}"></script>
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
                <form action="{{ route('order_products') }}"  method="POST">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2>Dostawa i płatność</h2>
                            <div>
                                <h4>Sposób dostawy</h4>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="delivery" value="kurier" required>Kurier - InPost, UPS, FedEx, DTS lub Poczta Polska
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="delivery" value="osobiście" required>Odbiór osobisty
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="delivery" value="paczkomat" required>Paczkomaty 24/7
                                    </label>
                                </div>
                            </div>
                            <div>
                                <h4>Metoda płatności</h4>
                                    <div class="form-check">
                                    <label class="form-check-label active">
                                    <input type="radio" class="form-check-input" name="payment" value="blik" required>BLIK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="przelew" required>Przelew gotówkowy
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="przy odbiorze" required>Przy odbiorze
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="karta płatnicza" required>Karta płatnicza online
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="payment" value="dotpay" required>Szybki przelew DotPay
                                    </label>
                                </div>
                            </div>
                            <div>
                                <h4>Dane odbiorcy</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-1" name="address" placeholder="Ulica i numer" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-3" name="code" placeholder="Kod pocztowy" value="__-___" data-mask="__-___" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-3" name="city" placeholder="Miejscowość" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control mt-3" name="phone" placeholder="Telefon" value="+__ ___ ___ ___" data-mask="+__ ___ ___ ___" required>
                                </div>
                            </div>
                            <div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="invoice" class="form-check-input" value="">Chcę otrzymać fakturę
                                </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox" value="scheckbox" />Chcę dodać komentarz do zamówienia
                                    </label>
                                </div>
                                <div class="form-group" id="otherFieldDiv">
                                    <input id="comment" class="form-control" name="comment" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <span class="h3">Podsumowanie:</span>
                            </div>
                            <div class="mt-2">
                                <span class="h2" id="totalPrice">{{ $subtotal }}</span>
                                <input type="hidden" name="totalPrice" value="{{ $subtotal }}">
                            </div>
                            <div>
                                <span>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input id="regulations" type="checkbox" class="form-check-input" required>
                                            Akceptuje <a href="#regulationsModal" class="regulations" data-toggle="modal" data-target="#regulationsModal">regulamin</a>
                                        </label>
                                    </div>
                                </span>
                            </div>
                            <div class="mt-2">
                                {{ csrf_field() }}
                                <a href="#"><button class="btn btn-danger p-3 mt-2">Płacę</button></a>
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

    Array.prototype.forEach.call(document.body.querySelectorAll("*[data-mask]"), applyDataMask);

    function applyDataMask(field) {
        var mask = field.dataset.mask.split('');

        // For now, this just strips everything that's not a number
        function stripMask(maskedData) {
            function isDigit(char) {
                return /\d/.test(char);
            }
            return maskedData.split('').filter(isDigit);
        }

        // Replace `_` characters with characters from `data`
        function applyMask(data) {
            return mask.map(function(char) {
                if (char != '_') return char;
                if (data.length == 0) return char;
                return data.shift();
            }).join('')
        }

        function reapplyMask(data) {
            return applyMask(stripMask(data));
        }

        function changed() {
            var oldStart = field.selectionStart;
            var oldEnd = field.selectionEnd;

            field.value = reapplyMask(field.value);

            field.selectionStart = oldStart;
            field.selectionEnd = oldEnd;
        }

        field.addEventListener('click', changed)
        field.addEventListener('keyup', changed)
    }
</script>
</body>
</html>
