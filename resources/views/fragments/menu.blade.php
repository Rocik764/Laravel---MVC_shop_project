<div class="container-fluid">
    <div class="row" style="color: #FFFFFF;">
        <div class="col-12 col-md-2">
            <p><img src="{{ asset('/img/phone-call.png') }}" alt="phone"/> 58 577 625 825</p>
        </div>
        <div class="col-12 col-md-2">
            <p><img src="{{ asset('/img/email.png') }}" alt="email"/> zoologiczny@gmail.com</p>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-head">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('show_index')}}"><img src="{{ asset('/img/fox_logo.png') }}" width="50" height="50" alt="logo"/> Zoologiczny.pl</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto d-flex test">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('show_index')}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                        Popularne kategorie
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-header">Dla psa</div>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 1, 'subcategory' => 1])}}">Zabawki</a>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 2, 'subcategory' => 1])}}">Karma</a>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 3, 'subcategory' => 1])}}">Akcesoria</a>
                        <div class="dropdown-header">Dla kota</div>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 1, 'subcategory' => 2])}}">Zabawki</a>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 2, 'subcategory' => 2])}}">Karma</a>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 3, 'subcategory' => 2])}}">Akcesoria</a>
                        <div class="dropdown-header">Dla ryb</div>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 1, 'subcategory' => 3])}}">Zabawki</a>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 2, 'subcategory' => 3])}}">Karma</a>
                        <a class="dropdown-item" href="{{route('show_products', ['category' => 3, 'subcategory' => 3])}}">Akcesoria</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button">
                        Konto
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @guest
                            @if (Route::has('login'))
                                <a class="dropdown-item" href="{{ route('login') }}">Zaloguj</a>
                                <div class="dropdown-divider"></div>
                            @endif
                            @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">Zajerestruj</a>
                            @endif
                        @else
                        <a class="dropdown-item" href="{{route('show_profile')}}">Profil</a>
                        <div class="dropdown-divider" ></div>
                        <a class="dropdown-item" href="{{route('show_cart')}}">Koszyk</a>
                        <div class="dropdown-divider" ></div>
                        <a class="dropdown-item" href="{{route('show_orders')}}">Moje zamówienia</a>
                        @can("manage-products")
                        <div class="dropdown-divider" ></div>
                        <a class="dropdown-item" href="{{route('list_orders')}}">Zamówienia</a>

                        @endcan
                        @can('manage-users')
                        <div class="dropdown-divider" ></div>
                        <a class="dropdown-item" href="{{route('admin.users.index')}}">Administracja</a>
                        @endcan
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" class="dropdown-item" action="{{ route('logout') }}" method="post">
                            <input type="submit" value="Wyloguj"/>
                            @csrf
                        </form>
                        @endguest
                        <!--                        <a class="dropdown-item" id="Logout" th:href="@{/logout}" sec:authorize="hasAnyAuthority('ADMIN', 'USER')">Wyloguj</a>-->
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
