 <div class="sidebar-header">
        <img src="{{ asset('/img/fox_logo.png') }}" style="transform: scaleX(-1)" width="175" height="125" alt="logo"/>
 </div>

<ul class="list-unstyled components">
    <li><p>Side menu</p></li>
    <li @can("manage-products")>
        <a data-toggle="collapse" aria-expanded="false" href="#homeSubmenu" class="dropdown-toggle">Manage</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
                <a href="{{route('list_products')}}">Edit products</a>
            </li>
            <li>
                <a href="{{route('new_product')}}">Add products</a>
            </li>
            <li>
                <a href="{{route('edit_category_subcategory')}}">Remove categories / producents</a>
            </li>
            <li>
                <a href="{{route('new_category_subcategory')}}">Add categories / producents</a>
            </li>
            @can("manage-users")
            <li>
                <a href="{{route('admin.users.index')}}">Edit users</a>
            </li>
            @endcan
        </ul>
    </li @endcan>
    <li>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Filters</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
                <form action="{{ route('side_menu_filtering') }}" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="filterWord" placeholder="What are you looking for?">
                    </div>
                    <div class="form-group">
                        <label for="price-from">Price from</label>
                        <input type="number" step="0.01" class="form-control" id="price-from" name="filterPriceFrom" min="0">
                    </div>
                    <div class="form-group">
                        <label for="price-to">Price to</label>
                        <input type="number" step="0.01" class="form-control" id="price-to" name="filterPriceTo" min="0">
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </li>
            <li>
                <a href="{{ route('get_filtering') }}">More filters</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{route('show_contacts')}}">Contact</a>
    </li>
    <li>
        <a href="{{route('show_partners')}}">Partners</a>
    </li>
</ul>
