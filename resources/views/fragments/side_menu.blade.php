 <div class="sidebar-header">
        <img src="{{ asset('/img/fox_logo.png') }}" style="transform: scaleX(-1)" width="175" height="125" alt="logo"/>
 </div>

<ul class="list-unstyled components">
    <p>Menu podręczne</p>
    <li class="active">
        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Zarządzanie</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
                <a href="{{route('admin.edit_product')}}">Edytuj produkty</a>
            </li>
            <li>
                <a href="{{route('admin.new_product')}}">Dodaj produkty</a>
            </li>
            <li>
                <a href="{{route('admin.new_category_subcategory')}}">Dodaj kategorie</a>
            </li>
            <li>
{{--                <a href="{{route('admin.new_user')}}">Dodaj użytowników</a>--}}
            </li>
            <li>
{{--                <a href="{{route('user.users_list')}}">Edytuj użytowników</a>--}}
            </li>
        </ul>
    </li>
    <li>
        <a href="#">Nowości</a>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Filtry</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
                <a href="#">Page 1</a>
            </li>
            <li>
                <a href="#">Page 2</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
            <li>
                <a href="#">Page 3</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{route('shop.contact')}}">Kontakt</a>
    </li>
    <li>
        <a href="{{route('shop.partners')}}">Nasi partnerzy</a>
    </li>
</ul>
