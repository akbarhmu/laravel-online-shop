<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ Custom::getShopData('name') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="{{asset('css/user/magnific-popup.css')}}" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('/css/user/style_landing_purple.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/user/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/user/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/user/app.css')}}" />
    </head>
    <style>
        .carousel-multi-item.v-2.product-carousel .carousel-inner .carousel-item.active,
        .carousel-multi-item.v-2.product-carousel .carousel-item-next,
        .carousel-multi-item.v-2.product-carousel .carousel-item-prev {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex; }
        .carousel-multi-item.v-2.product-carousel .carousel-item-right.active,
        .carousel-multi-item.v-2.product-carousel .carousel-item-next {
        -webkit-transform: translateX(20%);
        -ms-transform: translateX(20%);
        transform: translateX(20%); }
        .carousel-multi-item.v-2.product-carousel .carousel-item-left.active,
        .carousel-multi-item.v-2.product-carousel .carousel-item-prev {
        -webkit-transform: translateX(-20%);
        -ms-transform: translateX(-20%);
        transform: translateX(-20%); }
        .carousel-multi-item.v-2.product-carousel .carousel-item-right,
        .carousel-multi-item.v-2.product-carousel .carousel-item-left {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0); }
        .carousel-multi-item.v-2.product-carousel *, .carousel-multi-item.v-2.product-carousel ::after, .carousel-multi-item.v-2.product-carousel ::before {
        -webkit-box-sizing: content-box;
        box-sizing: content-box; }
        .fuchsia-rose-text {
        color: #db0075;
        }
        .aqua-sky-text {
        color: #5cc6c3;
        }
        .mimosa-text {
        color: #F0C05A;
        }
        .list-inline-item .fas, .list-inline-item .far {
        font-size: .8rem;
        }
        .chili-pepper-text {
        color: #9B1B30;
        }
        .carousel-multi-item .controls-top .btn-floating {
        background: #F8CDCD;
        }
        .carousel-multi-item .carousel-indicators li {
        height: .75rem;
        width: .75rem;
        max-width: .75rem;
        background-color: #5cc6c3;
        }
        .carousel-multi-item .carousel-indicators .active {
        height: 1rem;
        width: 1rem;
        max-width: 1rem;
        background-color: #5cc6c3;
        }
        .carousel-multi-item .carousel-indicators {
        margin-bottom: -1rem;
        }
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ Custom::getShopData('name') }}</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('index')}}">{{__('Home')}}</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('user.products.index')}}">{{__('Products')}}</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('services.index')}}">{{__('Service')}}</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('contacts.index')}}">{{__('Contact')}}</a></li>
                        @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <li class="nav-item"><a class="nav-link {{Custom::set_active(['contact*'])}} js-scroll-trigger" href="{{route('login')}}">{{__('Login')}}</a></li>
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
                        <h1 class="text-uppercase text-white font-weight-bold">Manjakan Semua Kebutuhan Elektronik Anda disini</h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-0">{{ Custom::getShopData('name') }} menyediakan berbagai macam produk elektronik baru maupun bekas</p>
                        <p class="text-white-75 font-weight-light mb-5">Kami juga menyediakan layanan service produk elektronis mulai dari TV, monitor, komputer, kulkas dan lain-lain</p>
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="{{route('user.products.index')}}"><i class="fas fa-shopping-cart"></i> {{__('Products')}}</a>
                        <a class="btn btn-primary btn-xl js-scroll-trigger ml-3" href="{{route('services.index')}}"><i class="fas fa-tools"></i> {{__('Service')}}</a>
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
                        <p class="text-white-50 mb-4">{{ Custom::getShopData('name') }} menyediakan berbagai macam produk dan terdapat layanan servis produk elektronik! Hanya dengan daftar dan nikmati berbagai fitur yang ada di web ini!</p>
                        <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Apa saja di {{ Custom::getShopData('name') }}?</a>
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
                            <p class="text-muted mb-0">Produk kami bervariasi dari berbagai merk terkenal dan sudah terjaga kondisinya.</p>
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
        <section class="page-section" id="products">
            <div class="container">
                <h2 class="text-center mt-0">{{__('Featured Products')}}</h2>
                <hr class="divider my-4" />
                <section>
                    <div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2 product-carousel" data-ride="carousel">

                        <!-- Indicators -->
                        <ol class="carousel-indicators" style="display: none;">
                        <li data-target="#carousel-example-multi" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="1"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="2"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="3"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="4"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="5"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="6"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="7"></li>
                        <li data-target="#carousel-example-multi" data-slide-to="8"></li>
                        </ol>
                        <!--/.Indicators-->

                        <div class="carousel-inner mb-2" role="listbox">
                            @foreach ($products as $product)
                                <a href="{{route('products.show', $product->id)}}">
                                    <div class="carousel-item active mx-auto w-100">
                                        <div class="col-12 col-md-4 col-lg-2 mx-auto p-0">
                                            <div class="card mb-2">
                                                <div class="view overlay">
                                                    <img class="card-img-top" src="{{asset($product->image)}}" alt="Card image cap">
                                                </div>
                                                <div class="card-body p-3">
                                                    <h5 class="card-title font-weight-bold fuchsia-rose-text mb-0">{{$product->name}}</h5>
                                                    <p class="aqua-sky-text mb-0"><p class="badge badge-dark mb-0">{{$product->categories->name}}</p></p>
                                                    <p class="chili-pepper-text mb-0">@rupiah($product->price)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!--Controls-->
                        <div class="controls-top my-3 text-center">
                            <a class="btn-floating btn-sm" href="#carousel-example-multi" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
                            <a class="btn-floating btn-sm" href="#carousel-example-multi" data-slide="next"><i class="fas fa-chevron-right"></i></a>
                        </div>
                        <!--/.Controls-->

                    </div>
                </section>
            </div>
        </section>

        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">{{__('Contact Us')}}</h2>
                        <hr class="divider my-4" />
                        <p class="text-muted mb-5">Jam layanan: 8.00 - 17.00 | Tanggal merah dan hari libur nasional LIBUR</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <a class="d-block" href="telp:{{ Custom::getShopData('phone') }}">{{ Custom::getShopData('phone') }}</a>
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
        <script src="{{asset('js/user/owl.carousel.min.js')}}"></script>
        <script>
            $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                for (var i=0;i<3;i++) {
                    next=next.next();
                    if (!next.length) {
                    next = $(this).siblings(':first');
                    }
                    next.children(':first-child').clone().appendTo($(this));
                }
            });
        </script>
    </body>
</html>
