<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
    <div class="container">
        <div class="row align-items-center">

        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
            <form action="{{ route('user.products.search') }}" method="get" class="site-block-top-search" >
                @csrf
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" name="keyword" placeholder="Cari">
            </form>
        </div>

        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
            <div class="site-logo">
                <a href="{{route('index')}}" class="js-logo-clone" style="border: 2px solid #7971ea !important;">{{ $site_title }}</a>
            </div>
        </div>

        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
            <div class="site-top-icons">
            <ul>
                @if (Auth::check())
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-person"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{route('profile.address')}}" class="dropdown-item">{{__('Address')}}</a>
                                <a href="{{route('profile.show')}}" class="dropdown-item">{{__('Manage Account')}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                            </div>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li>
                        <a href="{{route('carts.index')}}" class="site-cart">
                            <span class="icon icon-add_shopping_cart"></span>
                            <span class="count">{{Custom::getCartCount(Auth::user()->id)}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('orders.index')}}" class="site-cart">
                            <span class="icon icon-shopping_cart"></span>
                            <span class="count">{{Custom::getNewOrderCount(Auth::user()->id)}}</span>
                        </a>
                    </li>
                    <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                @else
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-person"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('login') }}">{{__('Login')}}</a>
                                <a class="dropdown-item" href="{{ route('register') }}">{{__('Register')}}</a>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
            </div>
        </div>

        </div>
    </div>
    </div>
    <nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
        <li class="{{Custom::set_active(['/'])}}"><a href="{{route('index')}}">{{__('Home')}}</a></li>
        <li class="{{Custom::set_active(['product*', 'category*'])}}"><a href="{{route('user.products.index')}}">{{__('Products')}}</a></li>
        <li class="{{Custom::set_active(['service*'])}}"><a href="{{route('services.index')}}">{{__('Service')}}</a></li>
        <li class="{{Custom::set_active(['contact'])}}"><a href="{{route('contacts.index')}}">{{__('Contact')}}</a></li>
        </ul>
    </div>
    </nav>
</header>
