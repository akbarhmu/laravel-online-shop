@section('title', __('Add Product'))
@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css">
@endsection
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Products')}}</h1>
            <div class="section-header-breadcrumb">
              <a class="btn btn-primary" href="{{route('products.index')}}" role="button"><i class="fas fa-arrow-left"></i> {{__('Back')}}</a>
            </div>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>{{__('Add Product')}}</h4>
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
                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" class="need-validation">
                    @csrf
                    <div class="form-group">
                        <label>{{__('Product Name')}}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" aria-describedby="helpName" value="{{old('name')}}" required autofocus>
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('Description')}}</label>
                        <textarea class="form-control summernote-simple @error('description') is-invalid @enderror" name="description" id="description" required>{{old('description')}}</textarea>
                        <x-jet-input-error for="description"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                      <label for="category_id">{{__('Category')}}</label>
                      @if (count($categories) <= 0)
                        <div class="alert alert-danger">{{__('Please make a category first at :link')}}</div>
                      @else
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                      @endif
                      <x-jet-input-error for="category_id"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label for="image">{{__('Image')}}</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/*" required>
                        <x-jet-input-error for="image"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                      <label for="price">{{__('Price')}}</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" name="price" id="price" class="form-control currency @error('price') is-invalid @enderror" value="{{old('price')}}" required>
                        <x-jet-input-error for="price"></x-jet-input-error>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="weight">{{__('Weight')}}</label>
                      <div class="input-group colorpickerinput colorpicker-element" data-colorpicker-id="2">
                        <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{old('weight')}}" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            gram
                          </div>
                        </div>
                      </div>
                      <x-jet-input-error for="weight"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                      <label for="quantity">{{__('Quantity')}}</label>
                      <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{old('quantity')}}" required>
                    </div>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> {{__('Save')}}</button>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
@section('js')
<script>
    $('#category_id').val({{old('category_id')}});
</script>
@endsection
