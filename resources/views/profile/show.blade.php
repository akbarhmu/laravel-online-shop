@section('title', __('Profile'))
@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{Auth::user()->name}}</h1>
        {{-- <div class="section-header-breadcrumb">
            <a class="btn btn-primary" href="{{route('products.create')}}" role="button"><i class="fas fa-plus"></i> {{__('Add')}}</a>
        </div> --}}
        </div>

        <div class="section-body">
        <div class="card">
            <div class="card-header">
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
    </section>
</div>
@endsection
@section('js')
    <script src="{{asset('js/page/bootstrap-modal.js')}}"></script>
    <script>
        $('.modal').on('shown.bs.modal', function() {
            $('.modal').appendTo("body")
        });
    </script>
@endsection
