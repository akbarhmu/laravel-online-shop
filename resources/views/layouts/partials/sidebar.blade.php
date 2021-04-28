<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{route('dashboard.index')}}" class="text-logo" style="font-size: 1.5rem"><i class="bi bi-cart4"></i>{{ config('app.name', 'Laravel') }}</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{UserHelper::set_active(['dashboard'])}}">
                            <a href="{{route('dashboard.index')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>{{__('Dashboard')}}</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub {{UserHelper::set_active(['dashboard/categories*','dashboard/products*'])}}">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Data</span>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li class="submenu-item {{UserHelper::set_active(['dashboard/categories*'])}}">
                                    <a href="{{route('categories.index')}}">{{__('Categories')}}</a>
                                </li>
                                <li class="submenu-item {{UserHelper::set_active(['dashboard/products*'])}}">
                                    <a href="{{route('products.index')}}">{{__('Products')}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
