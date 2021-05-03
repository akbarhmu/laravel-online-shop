@section('title', __('Forgot Password'))
@extends('layouts.guest')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <x-jet-authentication-card-logo />
            </div>
            <div class="card card-primary">
                <div class="card-header"><h4>{{__('Forgot Password')}}</h4></div>

                <div class="card-body">

                    <div class="alert alert-primary alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body text-justify">
                            <div class="alert-title">{{__('Forgot your password?')}}</div>
                            {{__('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')}}
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/forgot-password" class="needs-validation">
                        @csrf

                        <div class="form-group">
                            <x-jet-label value="{{__('Email')}}" />
                            <x-jet-input type="email" name="email" :value="old('email')" required autofocus />
                            <x-jet-input-error class="invalid-feedback" for="email"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ __('Email Password Reset Link') }}
                            </button>
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
