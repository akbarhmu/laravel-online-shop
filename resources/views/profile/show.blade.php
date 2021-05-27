@section('title', __('Profile'))
@extends('user.layouts.app-livewire')
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-body">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                        <h4>{{__('Profile')}}</h4>
                        </div>
                        <div class="card-body">
                            <x-slot name="header">
                                <h2 class="h4 font-weight-bold">
                                    {{ __('Profile') }}
                                </h2>
                            </x-slot>

                            <div>
                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                    @livewire('profile.update-profile-information-form')

                                    <x-jet-section-border />
                                @endif

                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                    @livewire('profile.update-password-form')

                                    <x-jet-section-border />
                                @endif

                                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                    @livewire('profile.two-factor-authentication-form')

                                    <x-jet-section-border />
                                @endif

                                @livewire('profile.logout-other-browser-sessions-form')

                                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                    <x-jet-section-border />

                                    @livewire('profile.delete-user-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('.modal').on('shown.bs.modal', function() {
            $('.modal').appendTo("body")
        });
    </script>
@endsection
