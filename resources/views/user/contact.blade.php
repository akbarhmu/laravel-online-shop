@section('title', __('Contact Us'))
@extends('user.layouts.app')
@section('content')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{route('index')}}">{{__('Home')}}</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{__('Contact')}}</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">{{__('Contact Us')}}</h2>
          </div>
          <div class="col-md-12 w-100">
              <div class="row">
                <div class="col-md-8 p-4 w-100">
                        <iframe
                        style="border:0; width: 100%; min-height: 450px;"
                        loading="lazy"
                        allowfullscreen
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBxM-n0UKR_2m_2qII3trayR43LYd8cl60&q={{urlencode($site_address)}}&zoom=16">
                        </iframe>
                </div>
                <div class="col-md-4 p-4">
                    <div class="p-4 border mb-3">
                        <span class="d-block text-primary h6 text-uppercase">{{__('Address')}}</span>
                        <p class="mb-0">{{$site_address}}</p>
                    </div>
                    <div class="p-4 border mb-3">
                        <span class="d-block text-primary h6 text-uppercase">{{__('Phone Number')}}</span>
                        <p class="mb-0">{{$site_phone}}</p>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
