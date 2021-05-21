@section('title', __('Payment Methods'))
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{__('Payment Methods')}}</h1>
        <div class="section-header-breadcrumb">
            <a class="btn btn-primary" href="{{route('payments.index')}}" role="button"><i class="fas fa-arrow-left"></i> {{__('Back')}}</a>
        </div>
        </div>

        <div class="section-body">
        <div class="card">
            <div class="card-header">
            <h4>{{$payment_method->account}}</h4>
            </div>
            <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{route('payments.update', $payment_method->id)}}" method="post" class="need-validation">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>{{__('Payment Channel')}}</label>
                    <input type="text" name="account" id="account" class="form-control @error('account') is-invalid @enderror" placeholder="{{__('Bank Name (BRI,BNI,BCA,etc) / E-Wallet (OVO/Gopay/Dana/etc)')}}" aria-describedby="helpName" value="{{old('account', $payment_method->account)}}" required>
                    <x-jet-input-error for="account"></x-jet-input-error>
                </div>
                <div class="form-group">
                    <label for="account_name">{{__('Account Name')}}</label>
                    <input type="text" name="account_name" id="account_name" class="form-control @error('account_name') is-invalid @enderror" placeholder="{{__('Full name')}}" value="{{old('account_name', $payment_method->account_name)}}" required>
                    <x-jet-input-error for="account_name"></x-jet-input-error>
                </div>
                <div class="form-group">
                    <label for="account_number">{{__('Account Number')}}</label>
                    <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror" placeholder="{{__('Account Number')}}" value="{{old('account_number', $payment_method->account_number)}}" required>
                    <x-jet-input-error for="account_number"></x-jet-input-error>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> {{__('Save')}}</button>
            </form>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection
