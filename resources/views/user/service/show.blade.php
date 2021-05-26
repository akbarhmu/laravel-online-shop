@section('title', 'Layanan Service')
@extends('user.layouts.app')
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="icon-check_circle display-3 text-success"></span>
                <h2 class="display-3 text-black" style="font-size: 4rem !important;">Terimakasih!</h2>
                <p class="lead mb-0">Permintaan Sudah Berhasil Dibuat Dengan Nomor #{{$service->id}}</p>
                <p class="lead mb-5">Kami Akan Segera Menghubungi Anda</p>
                <div class="table-responsive text-center">
                    <table class="table table-striped text-left w-75" style="margin: 0px auto;">
                        <tbody>
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
</div>
@endsection
