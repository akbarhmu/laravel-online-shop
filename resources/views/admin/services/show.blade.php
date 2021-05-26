@section('title', __('Services'))
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('Services')}}</h1>
            <div class="section-header-breadcrumb">
                <form action="{{route('admin.services.update', $service->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success done-confirm" role="button"><i class="fas fa-check"></i> Selesai</button>
                </form>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Services')}} #{{$service->id}}</h4>
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
                        <table class="table table-striped text-left">
                            <tbody>
                                <tr>
                                    <th>Status</th>
                                    <th data-width="1">:</th>
                                    <td>
                                        @if ($service->status==1)
                                            <span class="badge badge-danger">Belum Diperiksa</span>
                                        @else
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>:</th>
                                    <td>{{$service->name}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th>:</th>
                                    <td>{{$service->address}}</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <th>:</th>
                                    <td>{{$service->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Produk</th>
                                    <th>:</th>
                                    <td>{{$service->product_name}}</td>
                                </tr>
                                <tr>
                                    <th>Merk atau Tipe/Model</th>
                                    <th>:</th>
                                    <td>{{$service->product_merk}}</td>
                                </tr>
                                <tr>
                                    <th>Keluhan</th>
                                    <th>:</th>
                                    <td>{{$service->keluhan}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-center"><img src="{{asset($service->image)}}" alt="" srcset="" style="height: 150px; width: auto;"></td>
                                </tr>
                            </tbody>
                        </table>
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
    $('.done-confirm').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Anda yakin ?`,
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
