@section('title', $product->name)
@extends('user.layouts.app')
@section('content')
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{route('user.products.index')}}">{{__('Products')}}</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$product->name}}</strong></div>
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
        <div class="row">
          <div class="col-md-6">
            <img src="{{asset($product->image)}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <form action="{{route('carts.store')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <h2 class="text-black">{{$product->name}}</h2>
                <p class="badge badge-dark">{{$product->categories->name}}</p>
                <p><strong class="text-primary h4">@rupiah($product->price)</strong></p>
                <div class="mb-5">
                    <p class="mb-0">{{__('Available Stock')}}: {{$product->quantity}}</p>
                    <div class="input-group" style="max-width: 120px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center" value="{{old('quantity', 1)}}" placeholder="" name="quantity">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                        </div>
                    </div>
                    <x-jet-input-error for="quantity"></x-jet-input-error>
                </div>
                <p>
                @if ($product->quantity>0)
                    <button type="submit" class="buy-now btn btn-sm btn-primary">{{__('Add To Cart')}}</button>
                @else
                    <button class="buy-now btn btn-sm btn-primary" disabled>{{__('Sold Out')}}</button>
                @endif
                </p>
            </form>

          </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h5 class="text-black">{{__('Description')}}</h5>
                <hr>
                {!!$product->description!!}
            </div>
        </div>
      </div>
    </div>
@endsection
