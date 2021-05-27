@section('title', __('Cart'))
@extends('user.layouts.app')
@section('content')
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{route('index')}}">{{__('Home')}}</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{__('Cart')}}</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
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
              </div>
          </div>
        <div class="row mb-5">
          <form class="col-md-12" method="post" action="{{ route('carts.update') }}">
            @csrf
            @method('PATCH')
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">{{__('Image')}}</th>
                    <th class="product-name">{{__('Product Name')}}</th>
                    <th class="product-price">{{__('Price')}}</th>
                    <th class="product-quantity">{{__('Jumlah')}}</th>
                    <th class="product-total">{{__('Subtotal')}}</th>
                    <th class="product-remove">{{__('Remove')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal=0;
                    @endphp
                    @forelse ($carts as $cart)
                        <tr>
                            <input type="hidden" name="product_id[]" value="{{$cart->product_id}}">
                            <td class="product-thumbnail">
                                <img src="{{asset($cart->image)}}" alt="Image" class="img-fluid">
                            </td>
                            <td class="product-name">
                            <h2 class="h5 text-black">{{$cart->product_name}}</h2>
                            </td>
                            <td>@rupiah($cart->price)</td>
                            <td class="text-left">
                            <div class="input-group" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="hidden" name="cart_id[]" value="{{$cart->id}}">
                                <input type="text" name="quantity[]" class="form-control text-center" value="{{$cart->quantity}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>
                            <x-jet-input-error for="quantity.{{$loop->iteration-1}}"></x-jet-input-error>
                            </td>
                            @php
                                $total = $cart->price * $cart->quantity;
                                $subtotal = $subtotal + $total;
                            @endphp
                            <td>@rupiah($total)</td>
                            <td>
                                <a href="{{route('carts.destroy', $cart->id)}}" class="btn btn-primary btn-sm">X</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">{{__('No Data')}}</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                <button type="submit" class="btn btn-primary btn-sm btn-block">{{__('Update Cart')}}</button>
                </form>
              </div>
              <div class="col-md-6">
                <a href="{{route('user.products.index')}}" class="btn btn-outline-primary btn-sm btn-block">{{__('Continue Shopping')}}</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">{{__('Cart Totals')}}</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">{{__('Subtotal')}}</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">@rupiah($subtotal)</strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                      @if (Auth::user()->province_id != null && Auth::user()->city_id != null && Auth::user()->address != null && Auth::user()->subdistrict != null && Auth::user()->postal_code != null)
                        <a class="btn btn-primary btn-lg py-3 btn-block" href="{{route('checkout.index')}}">{{__('Proceed To Checkout')}}</a>
                      @else
                        <a class="btn btn-primary btn-lg py-3 btn-block" href="{{route('profile.address')}}">{{__('Address Settings')}}</a>
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
