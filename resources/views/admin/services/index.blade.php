@section('title', __('Services'))
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('Services')}}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Services')}}</h4>
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
                        <table class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    <tr>
                                        <th scope="row">{{$loop->iteration + $services->firstItem() -1}}</th>
                                        <td>{{$service->name}}</td>
                                        <td>{{$service->address}}</td>
                                        <td>{{$service->phone}}</td>
                                        <td>{{$service->created_at->translatedFormat('d M Y')}}</td>
                                        <td>
                                            @if ($service->status==1)
                                                <span class="badge badge-danger">Belum Diperiksa</span>
                                            @else
                                                <span class="badge badge-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('admin.services.show', $service->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Detail</a>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination float-right">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
