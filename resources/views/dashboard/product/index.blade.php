@section('title', __('Products'))
@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('Products')}}</h1>
            <div class="section-header-breadcrumb">
              <a class="btn btn-primary" href="{{route('products.create')}}" role="button"><i class="fas fa-plus"></i> {{__('Add')}}</a>
            </div>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>{{__('All Product')}}</h4>
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
                                <th scope="col">{{__('Product Name')}}</th>
                                <th scope="col">{{__('Price')}}</th>
                                <th scope="col">{{__('Weight')}}</th>
                                <th scope="col">{{__('Category')}}</th>
                                <th scope="col">{{__('Quantity')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col" class="text-center">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <th scope="row">{{$loop->iteration + $products->firstItem() -1}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>@rupiah($product->price)</td>
                                    <td>{{$product->weight}}g</td>
                                    <td>{{$product->category_name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td><img class="product-photo" src="{{asset('storage/'.$product->image)}}" alt="" srcset=""></td>
                                    <td class="text-center">
                                        <div style="display: inline-flex;">
                                            <div class="p-1">
                                                <a name="edit"" class="btn btn-warning btn-sm btnAction" href="{{route('products.edit', $product->id)}}" role="button"><i class="fas fa-edit"></i></a>
                                            </div>
                                            <div class="p-1">
                                                <form action="{{route('products.destroy', $product->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="" name="delete" data-name="{{ $product->name }}" class="btn btn-danger btn-sm btnAction delete-confirm" type="submit" role="button"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h6>{{__("We couldn't find any data")}}</h6>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination float-right">
                    {{ $products->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
@section('js')
<script src="{{asset('modules/sweetalert.js')}}"></script>
<script>
    $('.delete-confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name").toLowerCase();
        event.preventDefault();
        swal({
            title: `Anda yakin ingin menghapus produk ${name}?`,
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
