@section('title', __('Log in'))
@extends('layouts.guest')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <x-jet-authentication-card-logo />
            </div>
            <div class="card card-primary">
                <div class="card-header"><h4>{{__('Log in')}}</h4></div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="needs-validation">
                        @csrf
                        <div class="form-group">
                            <x-jet-label value="{{ __('Email') }}" />

                            <x-jet-input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                        name="email" :value="old('email')" autocomplete="email" required autofocus />
                            <x-jet-input-error class="invalid-feedback" for="email"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <div class="float-right">
                                        <a href="{{ route('password.request') }}" class="text-small">
                                            {{__('Forgot Password?')}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <x-jet-input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                        name="password" required autocomplete="current-password" />
                            <x-jet-input-error class="invalid-feedback" for="password"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <x-jet-checkbox class="custom-control-input" id="remember_me" name="remember" />
                                <label class="custom-control-label" for="remember_me">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{__('Log in')}}
                            </button>

                            <div class="mt-4 text-muted text-center">
                                {{__("Don't have an account?")}} <a href="{{route('register')}}">{{__('Register')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="simple-footer">
                <x-copyright />
            </div>
        </div>
    </div>
</div>
@endsection
