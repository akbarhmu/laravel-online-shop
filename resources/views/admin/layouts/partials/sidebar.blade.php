<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">EP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{__('Dashboard')}}</li>
            <li class="{{Custom::set_active(['dashboard'])}}"><a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-fire"></i> <span>{{__('Dashboard')}}</span></a></li>

            <li class="menu-header">{{__('Master')}}</li>
            <li class="{{Custom::set_active(['dashboard/categories*'])}}"><a class="nav-link" href="{{route('categories.index')}}"><i class="fas fa-star"></i> <span>{{__('Categories')}}</span></a></li>
            <li class="{{Custom::set_active(['dashboard/products*'])}}"><a class="nav-link" href="{{route('products.index')}}"><i class="fas fa-box"></i> <span>{{__('Products')}}</span></a></li>

            <li class="menu-header">{{__('Transaction')}}</li>
            <li><a class="nav-link" href="blank.html"><i class="fas fa-shopping-bag"></i> <span>{{__('Orders')}}</span></a></li>
            <li><a class="nav-link" href="blank.html"><i class="fas fa-tools"></i> <span>{{__('Services')}}</span></a></li>

            <li class="menu-header">{{__('Settings')}}</li>
            <li class="{{Custom::set_active(['dashboard/shop*'])}}"><a class="nav-link" href="{{route('shops.index')}}"><i class="fas fa-store"></i> <span>{{__('Shop')}}</span></a></li>
        </ul>
    </aside>
</div>
