@section('title', __('Categories'))
@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Categories')}}</h1>
            <div class="section-header-breadcrumb">
              <a class="btn btn-primary" href="{{route('categories.create')}}" role="button"><i class="fas fa-plus"></i> {{__('Add')}}</a>
            </div>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>{{__('All Category')}}</h4>
              </div>
              <div class="card-body p-2">
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
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="categories-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Products Count')}}</th>
                                <th scope="col" class="text-center">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th scope="row">{{$loop->iteration + $categories->firstItem() -1}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->products_count}}</td>
                                    <td class="text-center">
                                        <div class="form-group" style="display: inline-flex;">
                                            <div class="p-1">
                                                <a name="edit"" class="btn btn-warning btn-sm btnAction" href="{{route('categories.edit', $category->id)}}" role="button"><i class="fas fa-edit"></i></a>
                                            </div>
                                            <div class="p-1">
                                                <form action="{{route('categories.destroy', $category->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="" name="delete" data-name="{{ $category->name }}" class="btn btn-danger btn-sm btnAction delete-confirm" type="submit" role="button"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{__('Tidak ada data.')}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination float-right">
                    {{ $categories->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
@section('js')
<script src="{{asset('js/admin/modules/sweetalert.js')}}"></script>
<script>
    $('.delete-confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name").toLowerCase();
        event.preventDefault();
        swal({
            title: `Anda yakin ingin menghapus kategori ${name}?`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: ['Tidak', 'Ya']
        })
        .then((willDelete) => {
            if (willDelete) {
            form.submit();
            }
        });
    });
    $(document).ready(function(){
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
            });
        }, 5000);
    });
</script>
@endsection
