@section('title', __('Orders'))
@extends('user.layouts.app')
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-12 text-center">
                <span class="icon-check_circle display-3 text-success"></span>
                <h2 class="display-3 text-black" style="font-size: 4rem !important;">{{__('Thank you')}}!</h2>
                <p class="lead mb-5">Pesanan Kamu Berhasil Dibuat Dengan No Invoice <a class="font-weight-bold" href="{{route('orders.show', $order->invoice)}}">{{$order->invoice}}</a>.</p>
                <p><a href="{{route('orders.payment', $order->invoice)}}" class="btn btn-sm btn-primary">{{__('Payment')}}</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
