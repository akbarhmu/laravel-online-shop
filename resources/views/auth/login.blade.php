@extends('layouts.guest')
@section('content')
<div id="auth-left">
    <div class="auth-logo">
        {{-- <a href="/"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a> --}}
        <a href="/" class="text-logo"><i class="bi bi-cart4"></i>{{ config('app.name', 'Laravel') }}</a>
    </div>
    <h1 class="auth-title">{{__('Login')}}.</h1>
    <p class="auth-subtitle mb-5">{{__('Log in with your data that you entered during registration.')}}</p>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <form action="" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input class="form-control form-control-xl" type="email" name="email" placeholder="{{__('Email')}}" value="{{ old('email') }}">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password" placeholder="{{__('Password')}}" placeholder="Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" name="remember" id="flexCheckDefault">
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                {{__('Remember me')}}
            </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{__('Login')}}</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">{{__("Don't have an account?")}} <a href=""
                class="font-bold">{{__('Register')}}</a>.</p>
        @if (Route::has('password.request'))
            <p><a class="font-bold" href="{{route('password.request')}}">Forgot password?</a>.</p>
        @endif
    </div>
</div>
@endsection
