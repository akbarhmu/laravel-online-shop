@section('title', __('Two Factor Challenge'))
@extends('layouts.guest')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <x-jet-authentication-card-logo />
            </div>
            <div class="card card-primary">
                <div class="card-header"><h4>{{__('Two Factor Challenge')}}</h4></div>
                <div class="card-body">
                    <div x-data="{ recovery: false }">
                        <div class="alert alert-primary alert-has-icon" x-show="! recovery">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body text-justify">
                                <div class="alert-title">{{ __('Code') }}</div>
                                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                            </div>
                        </div>

                        <div class="alert alert-primary alert-has-icon" x-show="recovery">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body text-justify">
                                <div class="alert-title">{{ __('Recovery Code') }}</div>
                                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                            </div>
                        </div>

                        <form method="POST" action="{{ route('two-factor.login') }}" class="needs-validation">
                            @csrf

                            <div class="form-group" x-show="! recovery">
                                <x-jet-label value="{{ __('Code') }}" />
                                <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text"
                                            inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                                <x-jet-input-error for="code"></x-jet-input-error>
                            </div>

                            <div class="form-group" x-show="recovery">
                                <x-jet-label value="{{ __('Recovery Code') }}" />
                                <x-jet-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text"
                                            name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                                <x-jet-input-error for="recovery_code"></x-jet-input-error>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8 col-xs-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-dark btn-block btn-md m-0" x-show="! recovery" x-on:click="
                                                                recovery = true;
                                                                $nextTick(() => { $refs.recovery_code.focus() })
                                                            ">
                                                {{ __('Use a recovery code') }}
                                            </button>
                                            <button type="button" class="btn btn-dark btn-block btn-md m-0"
                                                    x-show="recovery"
                                                    x-on:click="
                                                                recovery = false;
                                                                $nextTick(() => { $refs.code.focus() })
                                                            ">
                                                {{ __('Use an authentication code') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-md btn-block" tabindex="4">
                                                {{ __('Log in') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
