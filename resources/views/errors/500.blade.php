@extends('layouts.errors')
@section('title', __('Service Unavailable'))
@section('section')
    <img class="img-error" src="{{asset('images/errors/error-500.png')}}" alt="Not Found">
    <div class="text-center">
        <h1 class="error-title">{{__('Service Unavailable')}}</h1>
        <p class="fs-5 text-gray-600">{{__('The website is currently unaivailable. Try again later or contact the developer.')}}</p>
        <a href="{{route('index')}}" class="btn btn-lg btn-outline-primary mt-3">{{__('Go back')}}</a>
    </div>
@endsection
