@section('title', $category->name)
@extends('user.layouts.app')
@section('content')
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{route('index')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{__('Products')}}</strong> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$category->name}}</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12">
                <div class="float-md-left mb-4"><h2 class="text-black h5">{{$category->name}}</h2></div>
                {{-- <div class="d-flex">

                </div> --}}
              </div>
            </div>
            <div class="row mb-5">
                @forelse ($products as $product)
                    <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <a href="{{route('products.show', $product->id)}}">
                                <figure class="block-4-image">
                                    <img src="{{asset($product->image)}}" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3>{{$product->name}}</h3>
                                    <p class="badge badge-dark mb-0">{{$product->categories->name}}</p>
                                    <p class="text-primary font-weight-bold">@rupiah($product->price)</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty

                @endforelse


            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  {{ $products->links('vendor.pagination.user-bootstrap-4') }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">{{__('Categories')}}</h3>
              <ul class="list-unstyled mb-0">
                  @forelse ($categories as $categoryl)
                    <li class="mb-1 @if($categoryl->id == $category->id) font-weight-bold @endif"><a href="{{route('categories.show', $categoryl->id)}}" class="d-flex"><span>{{$categoryl->name}}</span> <span class="text-black ml-auto">( {{$categoryl->products_count}} )</span></a></li>
                  @empty

                  @endforelse
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
