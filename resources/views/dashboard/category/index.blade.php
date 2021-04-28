@extends('layouts.dashboard')
@section('title', __('Categories'))
@section('subtitle', 'Navbar will appear in top of the page.')
@section('breadcrumb', __('Categories'))
@section('adittional-buttons')
    <div class="col-12 col-md-6 order-md-2 order-last" >
        <div class="adittional-buttons">
            <div class="wrapper-button">
                <a name="btnAddCategories" id="btnAddCategories" class="btn btn-primary btn-lg-lg btn-md float-lg-end" href="{{route('categories.create')}}" role="button" style="align-self: flex-end;"><i class="fas fa-plus"></i> {{__('Add')}}</a>
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
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover" id="tableProducts">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>{{__('Category Name')}}</th>
                                            <th class="text-center">{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>{{$loop->iteration + $categories->firstItem() -1}}</td>
                                                <td>{{$category->name}}</td>
                                                <td class="text-center">
                                                    <div class="form-group" style="display: inline-flex;">
                                                        <div class="p-1">
                                                            <a name="edit"" class="btn btn-warning btnAction" href="{{route('categories.edit', $category->category_id)}}" role="button"><i class="fas fa-edit"></i></a>
                                                        </div>
                                                        <div class="p-1">
                                                            <form action="{{route('categories.destroy', $category->category_id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="" name="delete" data-name="{{ $category->name }}" class="btn btn-danger btnAction delete-confirm" type="submit" role="button"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination float-end">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
