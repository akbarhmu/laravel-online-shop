<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    </form>
    <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <img alt="image" width="30" height="30" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle mr-1">
        @endif
        <div class="d-sm-none d-lg-inline-block">{{__('Hi')}}, {{Auth::user()->name}}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">{{ __('Manage Account') }}</div>
        <a href="{{ route('profile.show') }}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> {{ __('Profile') }}
        </a>
        <a href="{{ route('profile.address') }}" class="dropdown-item has-icon">
            <i class="far fa-map"></i> {{ __('Address') }}
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> {{ __('Log out') }}
        </a>
        <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
        </form>
        </div>
    </li>
    </ul>
</nav>
