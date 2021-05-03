@section('title', __('Add Category'))
@extends('layouts.app')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Category')}}</h1>
            <div class="section-header-breadcrumb">
              <a class="btn btn-primary" href="{{route('categories.index')}}" role="button"><i class="fas fa-arrow-left"></i> {{__('Back')}}</a>
            </div>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>{{__('Add Category')}}</h4>
              </div>
              <div class="card-body">
                <form action="{{route('categories.store')}}" method="post" class="need-validation">
                    @csrf
                    <div class="form-group">
                        <label>{{__('Category Name')}}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{__('Category Name')}}" aria-describedby="helpName" value="{{old('name')}}" required>
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> {{__('Save')}}</button>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
