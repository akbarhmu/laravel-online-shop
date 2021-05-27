<footer class="site-footer border-top">
    <div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 mb-5 mb-lg-0">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="footer-heading mb-4">{{__('Navigations')}}</h3>
                </div>
                <div class="col-md-6 col-lg-4">
                    <ul class="list-unstyled">
                        <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
                        <li><a href="{{route('products.index')}}">{{__('Products')}}</a></li>
                        <li><a href="{{route('services.index')}}">{{__('Service')}}</a></li>
                        <li><a href="{{route('contacts.index')}}">{{__('Contact Us')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="footer-heading mb-4">{{__('Manage Account')}}</h3>
                </div>
                <div class="col-md-6 col-lg-4">
                    <ul class="list-unstyled">
                        <li><a href="{{route('profile.address')}}">{{__('Address')}}</a></li>
                        <li><a href="{{route('profile.show')}}">{{__('Manage Account')}}</a></li>
                        <li><a href="{{route('carts.index')}}">{{__('Shopping cart')}}</a></li>
                        <li><a href="{{route('orders.index')}}">{{__('Orders')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="block-5 mb-5">
                <h3 class="footer-heading mb-4">{{__('Contact Info')}}</h3>
                <ul class="list-unstyled">
                    <li class="address">{{$site_address}}</li>
                    <li class="phone"><a href="tel://{{$site_phone}}">{{$site_phone}}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
        <p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{$site_title}} Team | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
        </div>

    </div>
    </div>
</footer>
