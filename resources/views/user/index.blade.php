<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ Custom::getShopData('name') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('images/logo/logo.png')}}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="{{asset('css/user/magnific-popup.css')}}" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('/css/user/style_landing_purple.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/user/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="{{asset('css/user/carousel.css')}}">
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ Custom::getShopData('name') }}</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger"
                            href="{{route('index')}}">{{__('Home')}}</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger"
                            href="{{route('user.products.index')}}">{{__('Products')}}</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger"
                            href="{{route('services.index')}}">{{__('Service')}}</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger"
                            href="{{route('contacts.index')}}">{{__('Contact')}}</a></li>
                    @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('carts.index')}}">{{__('Cart')}}</a>
                            <a class="dropdown-item" href="{{route('orders.index')}}">{{__('Orders')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('profile.address')}}">{{__('Address')}}</a>
                            <a class="dropdown-item" href="{{route('profile.show')}}">{{__('Manage Account')}}</a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link {{Custom::set_active(['contact*'])}} js-scroll-trigger"
                            href="{{route('login')}}">{{__('Login')}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">Manjakan Semua Kebutuhan Elektronik Anda
                        disini</h1>
                    <hr class="divider my-4" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-0">{{ Custom::getShopData('name') }} menyediakan
                        berbagai macam produk elektronik baru maupun bekas</p>
                    <p class="text-white-75 font-weight-light mb-5">Kami juga menyediakan layanan service produk
                        elektronis mulai dari TV, monitor, komputer, kulkas dan lain-lain</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="{{route('user.products.index')}}"><i
                            class="fas fa-shopping-cart"></i> {{__('Products')}}</a>
                    <a class="btn btn-primary btn-xl js-scroll-trigger ml-3" href="{{route('services.index')}}"><i
                            class="fas fa-tools"></i> {{__('Service')}}</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="page-section bg-primary" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Belanja dan Service Serasa di Surga!</h2>
                    <hr class="divider light my-4" />
                    <p class="text-white-50 mb-4">{{ Custom::getShopData('name') }} menyediakan berbagai macam produk
                        dan terdapat layanan servis produk elektronik! Hanya dengan daftar dan nikmati berbagai fitur
                        yang ada di web ini!</p>
                    <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Apa saja di
                        {{ Custom::getShopData('name') }}?</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <h2 class="text-center mt-0">Tentang {{ Custom::getShopData('name') }}</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-shipping-fast text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Pelayanan Cepat</h3>
                        <p class="text-muted mb-0">Pelanggan adalah prioritas nomor satu kami.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-gem text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Kualitas Terjaga</h3>
                        <p class="text-muted mb-0">Produk kami bervariasi dari berbagai merk terkenal dan sudah terjaga
                            kondisinya.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-shield-alt text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Bergaransi</h3>
                        <p class="text-muted mb-0">Kami memberikan garansi untuk setiap pemesanan dan perbaikan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-lock text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Aman dan Terpercaya</h3>
                        <p class="text-muted mb-0">Web ini sudah terverifikasi dan toko kami sudah bersertifikat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products-->
    <div class="bbb_viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="bbb_main_container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bbb_viewed_title_container">
                                    <div class="row">
                                        <div class="col-md-10 sm-center">
                                            <h3 class="bbb_viewed_title">{{__('Featured Products')}}</h3>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <div class="bbb_viewed_prev btn btn-primary"><i class="fas fa-chevron-left"></i></div>
                                            <div class="bbb_viewed_next btn btn-primary"><i class="fas fa-chevron-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="bbb_viewed_slider_container">
                                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                                        @foreach ($products as $product)
                                            <a href="{{route('products.show', $product->id)}}">
                                                <div class="owl-item">
                                                    <div
                                                        class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                        <div class="bbb_viewed_image"><img
                                                                src="{{asset($product->image)}}"
                                                                alt=""></div>
                                                        <div class="bbb_viewed_content text-center">
                                                            <div class="bbb_viewed_price">@rupiah($product->price)</div>
                                                            <div class="bbb_viewed_name">{{$product->name}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">{{__('Contact Us')}}</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5">Jam layanan: 8.00 - 17.00 | Tanggal merah dan hari libur nasional libur
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                    <a class="d-block"
                        href="telp:{{ Custom::getShopData('phone') }}">{{ Custom::getShopData('phone') }}</a>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                    <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                    <a class="d-block" href="mailto:electroparadizo@gmail.com">electroparadizo@gmail.com</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());

                </script>
                - {{ Custom::getShopData('name') }} Team
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('js/user/scripts_landing.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
    <script src="{{asset('js/user/carousel.js')}}" async></script>
</body>

</html>
