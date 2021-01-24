 <div class="sidebar-header">
        <img src="{{ asset('/img/fox_logo.png') }}" style="transform: scaleX(-1)" width="175" height="125" alt="logo"/>
 </div>

<ul class="list-unstyled components">
    <p>Menu podręczne</p>
    <li @can("manage-products")>
        <a data-toggle="collapse" aria-expanded="false" href="#homeSubmenu" class="dropdown-toggle">Zarządzanie</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
                <a href="{{route('list_products')}}">Edytuj produkty</a>
            </li>
            <li>
                <a href="{{route('new_product')}}">Dodaj produkty</a>
            </li>
            <li>
                <a href="{{route('edit_category_subcategory')}}">Usuń kategorie</a>
            </li>
            <li>
                <a href="{{route('new_category_subcategory')}}">Dodaj kategorie</a>
            </li>
            @can("manage-users")
            <li>
                <a href="{{route('admin.users.index')}}">Edytuj użytowników</a>
            </li>
            @endcan
        </ul>
    </li @endcan>
    <li>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Filtry</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
            <form action="{{ route('side_menu_filtering') }}" method="POST">
                <li>
                    <div class="form-group">
                        <input type="text" class="form-control" name="filterWord" placeholder="Czego szukasz?">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <label for="price-from">Cena od</label>
                        <input type="number" step="0.01" class="form-control" id="price-from" name="filterPriceFrom" min="0">
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <label for="price-to">Cena do</label>
                        <input type="number" step="0.01" class="form-control" id="price-to" name="filterPriceTo" min="0">
                    </div>
                </li>
                <li>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary">Szukaj</button>
                </li>
            </form>
            <li>
                <a href="{{ route('get_filtering') }}">Więcej filtrów</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{route('show_contacts')}}">Kontakt</a>
    </li>
    <li>
        <a href="{{route('show_partners')}}">Nasi partnerzy</a>
    </li>
</ul>
