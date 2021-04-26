@extends('layouts.errors')
@section('error', __('Not Found'))
@section('content')
<img class="img-error vector-error" src="{{asset('images/errors/error-503.svg')}}" alt="Not Found">
<div class="text-center">
    <h1 class="error-title text-503">{{__('We&rsquo;ll be Back Soon!')}}</h1>
    <p class="fs-5 text-gray-600">{{__('Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always contact us, otherwise we&rsquo;ll be back online shortly!')}}</p>
    <a href="mailto:{{ config('app.support_email', 'support@mail.com')}}" class="btn btn-lg btn-outline-primary mt-3">{{__('Contact Us')}}</a>
</div>
@endsection
