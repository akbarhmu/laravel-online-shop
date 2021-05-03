@section('title', __('Verify Email Address'))
@extends('layouts.guest')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <x-jet-authentication-card-logo />
            </div>
            <div class="card card-primary">
                <div class="card-header"><h4>{{__('Verify Email Address')}}</h4></div>
                <div class="card-body">
                    <div class="alert alert-primary alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body text-justify">
                            <div class="alert-title">{{__('Verify Email Address')}}</div>
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="form-group">
                                <button type="submit" class="btn btn-dark" tabindex="4">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </div>
                        </form>

                        <form method="POST" action="/logout">
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="btn btn-link">
                                    {{ __('Log Out') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="simple-footer">
                <x-copyright />
            </div>
        </div>
    </div>
</div>
@endsection
