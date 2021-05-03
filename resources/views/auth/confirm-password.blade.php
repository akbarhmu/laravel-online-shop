@section('title', __('Confirm Password'))
@extends('layouts.guest')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <x-jet-authentication-card-logo />
            </div>
            <div class="card card-primary">
                <div class="card-header"><h4>{{__('Confirm Password')}}</h4></div>
                <div class="card-body">

                    <div class="mb-3 text-sm text-muted">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <x-jet-validation-errors class="mb-2" />

                    <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation">
                        @csrf

                        <div>
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ __('Confirm') }}
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
