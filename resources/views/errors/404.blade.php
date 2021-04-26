@extends('layouts.errors')
@section('error', __('Not Found'))
@section('content')
    <img class="img-error" src="{{asset('images/errors/error-404.png')}}" alt="Not Found">
    <div class="text-center">
        <h1 class="error-title">{{__('Not Found')}}</h1>
        <p class="fs-5 text-gray-600">{{__('The page you are looking not found.')}}</p>
        <a href="{{route('index')}}" class="btn btn-lg btn-outline-primary mt-3">{{__('Go back')}}</a>
    </div>
@endsection
