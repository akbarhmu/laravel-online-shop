@extends('layouts.errors')
@section('error', __('Forbidden'))
@section('content')
    <img class="img-error" src="{{asset('images/errors/error-403.png')}}" alt="Not Found">
    <div class="text-center">
        <h1 class="error-title">{{__('Forbidden')}}</h1>
        <p class="fs-5 text-gray-600">{{__('You are unauthorized to see this page.')}}</p>
        <a href="{{route('index')}}" class="btn btn-lg btn-outline-primary mt-3">{{__('Go back')}}</a>
    </div>
@endsection
