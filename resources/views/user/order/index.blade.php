@section('title', __('Orders'))
@extends('user.layouts.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="{{route('index')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{__('Orders')}}</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
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
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="btn btn-warning text-white">Belum Dibayar</h2>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail" width="20%">Invoice</th>
                                    <th class="product-thumbnail" width="20%">Tanggal</th>
                                    <th class="product-name" width="20%">Total</th>
                                    <th class="product-price" width="20%">Status</th>
                                    <th class="product-quantity text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($newOrders as $order)
                                    <tr>
                                        <td>{{ $order->invoice }}</td>
                                        <td>{{$order->created_at->translatedFormat('d M Y')}}</td>
                                        <td>@rupiah($order->total)</td>
                                        <td>Belum Bayar</td>
                                        <td class="text-center">
                                            <a href="{{route('orders.payment', $order->invoice)}}" class="btn btn-success">Bayar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pesanan baru. <a href="{{route('user.products.index')}}">Pesan sekarang!</a></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="btn btn-warning text-white">Sedang Dalam Proses</h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail" width="20%">Invoice</th>
                                    <th width="20%">Tanggal</th>
                                    <th class="product-name" width="20%">Total</th>
                                    <th class="product-price" width="20%">Status</th>
                                    <th class="product-quantity text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($processOrders as $order)
                                    <tr>
                                        <td>{{ $order->invoice }}</td>
                                        <td>{{$order->created_at->translatedFormat('d M Y')}}</td>
                                        <td>@rupiah($order->total)</td>
                                        <td>
                                            @if ($order->status==2)
                                                Menunggu Konfirmasi
                                            @elseif ($order->status==3)
                                                Sedang Diproses
                                            @elseif ($order->status==4)
                                                Sedang Dikirim
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('orders.show', $order->invoice)}}" class="btn btn-success">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pesanan baru. <a href="{{route('user.products.index')}}">Pesan sekarang!</a></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="btn btn-warning text-white">Riwayat Pesanan</h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail" width="20%">Invoice</th>
                                    <th class="product-thumbnail" width="20%">Tanggal</th>
                                    <th class="product-name" width="20%">Total</th>
                                    <th class="product-price" width="20%">Status</th>
                                    <th class="product-quantity text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historyOrders as $order)
                                <tr>
                                    <td>{{ $order->invoice }}</td>
                                    <td>{{$order->created_at->translatedFormat('d M Y')}}</td>
                                    <td>@rupiah($order->total)</td>
                                    <td>
                                        @if ($order->status==0)
                                            Pesanan Dibatalkan
                                        @elseif ($order->status==5)
                                            Selesai
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('orders.show', $order->invoice)}}" class="btn btn-success">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pesanan baru. <a href="{{route('user.products.index')}}">Pesan sekarang!</a></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div id="paginate">
                            {{ $historyOrders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <style>
        #paginate nav {
            float: right !important;
        }
    </style>
@endsection
