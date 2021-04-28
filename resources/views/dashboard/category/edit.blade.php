@extends('layouts.dashboard')
@section('title', __('Edit Category'))
@section('subtitle', 'Navbar will appear in top of the page.')
@section('adittional-buttons')
    <div class="col-12 col-md-6 order-md-2 order-last" >
        <div class="adittional-buttons">
            <div class="wrapper-button">
                <a name="btnAddCategories" id="btnAddCategories" class="btn btn-primary btn-lg-lg btn-md float-lg-end" href="{{route('categories.index')}}" role="button" style="align-self: flex-end;"><i class="fas fa-arrow-left"></i> {{__('Go back')}}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <form action="{{route('categories.update', $category->category_id)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                  <h6>{{__('Category Name')}}</h6>
                                  <input type="text" name="name" id="name" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{__('Category Name')}}" aria-describedby="helpName" value="{{old('name', $category->name)}}">
                                  @error('name')
                                    <small id="helpName" class="text-danger">{{$message}}</small>
                                  @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-md float-end">{{__('Save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
