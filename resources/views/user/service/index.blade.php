@section('title', 'Service')
@extends('user.layouts.app')
@section('content')

<div class="site-section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="site-blocks-cover" style="background-image: url({{ asset('images/logo/service-header.webp') }}); width: 100%; height: 450px; min-height: unset !important;" data-aos="fade">
                    <div class="container">
                    <div class="row align-items-start align-items-md-center justify-content-end" style="min-height: unset !important; height: 450px;">
                        <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                            <h1 class="mb-2">Jasa Perbaikan / Servis Elektronik</h1>
                            <div class="intro-text text-center text-md-left">
                                <p class="mb-4">Melayani perbaikan atau servis semua jenis alat elektronik cepat murah bergaransi. </p>
                                <p>
                                    <a href="#pesanForm" class="btn btn-sm btn-dark">{{__('Order Now')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-light" id="pesanForm">
                        Pesan
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="service-form" class="text-black" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                                <x-jet-input-error for="name"></x-jet-input-error>
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('Address')}} <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}" required>
                                <x-jet-input-error for="address"></x-jet-input-error>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Phone Number')}} <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}" required>
                                <x-jet-input-error for="phone"></x-jet-input-error>
                            </div>
                            <div class="form-group">
                                <label for="product_name">{{__('Product Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="product_name" id="product_name" class="form-control" value="{{old('product_name')}}" required>
                                <x-jet-input-error for="product_name"></x-jet-input-error>
                            </div>
                            <div class="form-group">
                                <label for="product_merk">{{__('Merk dan Tipe/Model')}}</label>
                                <input type="text" name="product_merk" id="product_merk" class="form-control" value="{{old('product_merk')}}">
                                <x-jet-input-error for="product_merk"></x-jet-input-error>
                            </div>
                            <div class="form-group">
                                <label for="keluhan">{{__('Keluhan')}} <span class="text-danger">*</span></label>
                                <textarea type="text" name="keluhan" id="keluhan" class="form-control" required>{{old('keluhan')}}</textarea>
                                <x-jet-input-error for="keluhan"></x-jet-input-error>
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Photo')}} <span class="text-danger">*</span></label>
                                <input type="file" name="image" accept="image/*" id="image" class="form-control" required>
                                <x-jet-input-error for="image"></x-jet-input-error>
                            </div>
                            {!! HCaptcha::display() !!}
                            <button type="submit" class="btn btn-dark btn-md">{{__('Send')}}</button>
                            @if ($errors->has('h-captcha-response'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('h-captcha-response') }}</strong>
                                </span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    {!! HCaptcha::renderJs() !!}
@endsection
