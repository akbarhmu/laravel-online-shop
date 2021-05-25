@section('title', __('Payment Information'))
@extends('user.layouts.app')
@section('content')

<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="{{route('index')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{__('Cart')}}</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h2 class="display-5">Silahkan Lakukan Pembayaran Lewat No Rekening Berikut</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{route('orders.paymentProcess', $invoice)}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-header">
                        <h4 class="mb-0">1. Pilih Salah Satu Metode Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center radio-group">
                            @foreach($payment_methods as $payment_method)
                            <div class="col-md-3 radio" data-value="{{$payment_method->account.' ('.$payment_method->account_number.')'}}">
                                <div class="card text-white bg-primary mb-3 " style="max-width: 18rem;">
                                    <div class="card-header">{{ $payment_method->account }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $payment_method->account_number }}</h5>
                                        <p class="card-text">{{ $payment_method->account_name }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <input type="text" id="payment_method" name="payment_method" />
                            <x-jet-input-error for="payment_method"></x-jet-input-error>
                        </div>
                    </div>
                    <div class="card-header">
                        <h4 class="mb-0">2. Transfer Sebesar <p class="badge badge-primary mb-0">@rupiah($total)</p> Ke No Rekening Di Atas</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proff_image" id="" class="form-control" required>
                            <x-jet-input-error for="payment_proff_image"></x-jet-input-error>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
@section('css')
<style>
    div {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
    .selected .card{
        outline: 3px solid black;
        outline-offset: -3px;
    }
    #payment_method {
        display: none;
    }
</style>
@endsection
@section('js')
<script>
    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
        var val = $(this).attr('data-value');
        document.getElementById('payment_method').value = val;
    });
</script>
@endsection
