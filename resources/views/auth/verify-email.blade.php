@extends('layouts.guest')
@section('title', __('Verify Email Address'))
@section('content')
<div id="auth-left">
        <div class="auth-logo">
            {{-- <a href="/"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a> --}}
            <a href="{{route('index')}}" class="text-logo"><i class="bi bi-cart4"></i>{{ config('app.name', 'Laravel') }}</a>
        </div>
        <h1 class="auth-title">{{__('Verify Email Address')}}</h1>
        <div class="auth-subtitle mb-5 show-mobile">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('message'))
            <div class="mb-4 alert alert-success">
                {{__(session('message'))}}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <div class="row">
                <div class="col-md-6 col-12 p-1">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>
                </div>
                <div class="col-md-6 col-12 p-1">
            <form method="POST" action="{{ route('auth.destroy') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-block btn-lg">
                    {{ __('Logout') }}
                </button>
            </form>
                </div>
            </div>

        </div>
</div>
@endsection
