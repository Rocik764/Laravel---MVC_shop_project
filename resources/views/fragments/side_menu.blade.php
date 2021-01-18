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
                <a href="{{route('new_category_subcategory')}}">Dodaj kategorie</a>
            </li>
            <li>
{{--                <a href="{{route('admin.new_user')}}">Dodaj użytowników</a>--}}
            </li>
            <li>
                <a href="{{route('admin.users.index')}}">Edytuj użytowników</a>
            </li>
        </ul>
    </li @endcan>
    <li class="active">
        <a href="#">Nowości</a>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Filtry</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
                <a href="{{route('show_product')}}">Page 1</a>
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
