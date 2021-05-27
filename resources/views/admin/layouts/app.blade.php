<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{ Custom::getShopData('name') }}</title>

        <!- Favicon -->
        <link rel="icon" href="{{asset('images/logo/logo.png')}}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/admin/app.css') }}">

        @livewireStyles
        @yield('css')
    </head>
    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                @include('admin.layouts.partials.header')
                @include('admin.layouts.partials.sidebar')

                <!-- Main Content -->
                @yield('content')
            </div>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('scripts')

        <!-- Scripts -->
        <script src="{{ mix('js/admin/app.js') }}"></script>

        @stack('scripts-after')

        @yield('js')
    </body>
</html>
