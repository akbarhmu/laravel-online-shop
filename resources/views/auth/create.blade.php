@extends('layouts.guest')
@section('title', __('Register'))
@section('content')
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{route('index')}}" class="text-logo"><i class="bi bi-cart4"></i>{{ config('app.name', 'Laravel') }}</a>
        </div>
        <h1 class="auth-title">{{__('Register')}}.</h1>
        <p class="auth-subtitle mb-5">{{__('Input your data to register to our website.')}}</p>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{session('status')}}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <div class="text-danger">
                    {{__(session('error'))}}
                </div>
            </div>
        @endif

        <form action="{{route('auth.register')}}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left @if($errors->has('name')) mb-0 @else mb-4 @endif">
                <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="{{__('Full Name')}}" required>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            @error('name')
                <div class="text-danger mb-4">
                    {{$message}}
                </div>
            @enderror
            <div class="form-group position-relative has-icon-left @if($errors->has('email')) mb-0 @else mb-4 @endif">
                <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="{{__('Email')}}" required>
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            @error('email')
                <div class="text-danger mb-4">
                    {{$message}}
                </div>
            @enderror
            <div class="form-group position-relative has-icon-left @if($errors->has('password')) mb-0 @else mb-4 @endif">
                <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" placeholder="{{__('Password')}}" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            @error('password')
                <div class="text-danger mb-4">
                    {{$message}}
                </div>
            @enderror
            <div class="form-group position-relative has-icon-left @if($errors->has('password_confirmation')) mb-0 @else mb-4 @endif">
                <input type="password" class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="{{__('Confirm Password')}}" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            @error('password_confirmation')
                <div class="text-danger mb-4">
                    {{$message}}
                </div>
            @enderror
            <div class="form-group form-check-lg @if($errors->has('terms')) mb-0 @endif">
                <label class="form-check-label text-gray-600" for="terms">
                <input type="checkbox" class="form-check-input me-2 @error('terms') is-invalid @enderror" name="terms" id="terms">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => __('Terms of Service'),
                            'privacy_policy' => __('Privacy Policy'),
                    ]) !!}
                </label>
            </div>
            @error('terms')
                <div class="text-danger mb-4">
                    {{$message}}
                </div>
            @enderror
            <button class="btn btn-primary btn-block btn-lg shadow-lg">{{__('Register')}}</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'>{{__('Already registered?')}} <a href="{{route('auth.index')}}" class="font-bold">{{__('Login')}}</a>.</p>
        </div>
    </div>
@endsection
