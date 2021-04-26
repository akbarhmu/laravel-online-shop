@extends('layouts.guest')
@section('content')
    <div id="auth-left" class="register">
        <div class="auth-logo logo-register">
            {{-- <a href="index.html"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a> --}}
            <a href="/" class="text-logo"><i class="bi bi-cart4"></i>{{ config('app.name', 'Laravel') }}</a>
        </div>
        <h1 class="auth-title">{{__('Register')}}.</h1>
        <p class="auth-subtitle mb-5">{{__('Input your data to register to our website.')}}</p>

        <form action="" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" name="name" placeholder="{{__('Full Name')}}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="email" class="form-control form-control-xl" name="email" placeholder="{{__('Email')}}">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" name="password" placeholder="{{__('Password')}}">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            {{-- <div class="form-check form-check-lg d-flex align-items-end">
                <input class="form-check-input me-2" type="checkbox" name="terms" id="terms">
                <label class="form-check-label text-gray-600" for="terms">
                </label>
            </div> --}}
            <div class="form-group form-check-lg">
                <label class="form-check-label text-gray-600" for="terms">
                <input type="checkbox" class="form-check-input me-2" name="terms" id="terms"/>
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                    ]) !!}
                </label>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg">{{__('Register')}}</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'>{{__('Already registered?')}} <a href="/login" class="font-bold">{{__('Login')}}</a>.</p>
        </div>
    </div>
@endsection
