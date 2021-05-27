@section('title', __('Invoice'))
@extends('user.layouts.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="{{route('index')}}">Home</a> <span class="mx-2 mb-0">/</span><a href="{{route('orders.index')}}">Pesanan</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$order->invoice}}</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h4 class="mb-0">Detail Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
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
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <th>No Invoice</th>
                                        <td>:</td>
                                        <td>{{$order->invoice}}</td>
                                    </tr>
                                    <tr>
                                        <th>No Resi</th>
                                        <td>:</td>
                                        <td>{{$order->tracking_number ?: '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pesanan</th>
                                        <td>:</td>
                                        <td>
                                            @if ($order->status==0)
                                                Pesanan Dibatalkan
                                            @elseif($order->status==1)
                                                Belum Bayar
                                            @elseif ($order->status==2)
                                                Menunggu Konfirmasi
                                            @elseif ($order->status==3)
                                                Sedang Diproses
                                            @elseif ($order->status==4)
                                                Sedang Dikirim
                                            @elseif ($order->status==5)
                                                Selesai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td>:</td>
                                        <td>{{$order->payment_method ?: '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pembayaran</th>
                                        <td>:</td>
                                        <td>@rupiah($order->total)</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-right">
                                @if ($order->status == 1)
                                    <form action="{{route('orders.cancel', $order->invoice)}}" method="post" style="display: unset;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger delete-confirm">Batalkan Pesanan</button>
                                    </form>
                                    <a href="{{route('orders.payment', $order->invoice)}}" class="btn btn-primary">Bayar</a><br>
                                @elseif ($order->status == 2 || $order->status == 3)
                                    <a href="{{route('contacts.index')}}" class="btn btn-warning">Hubungi Penjual</a>
                                @elseif ($order->status == 4)
                                    <form action="{{route('orders.received', $order->invoice)}}" method="post" style="display: unset;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success text-light receive-confirm">Pesanan Diterima</button>
                                    </form>
                                    <a href="{{route('contacts.index')}}" class="btn btn-warning">Hubungi Penjual</a>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary text-light">
                                            <th class="product-thumbnail">Gambar</th>
                                            <th class="product-name">Nama Produk</th>
                                            <th class="product-price">Jumlah</th>
                                            <th class="product-quantity" width="20%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td><img src="{{ asset($product->product_image) }}" alt="" srcset="" width="50"></td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_quantity }}</td>
                                            <td>@rupiah($product->product_subtotal)</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($showresi)
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="content">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr class="text-center bg-primary text-light">
                                                    <th colspan="4">Detail Pengiriman</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-center" >
                                                    <th>Service</th>
                                                    <th>Pengirim</th>
                                                    <th>Penerima</th>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" class="text-center">{{$summarys['courier']}} ({{$summarys['service']}})</td>
                                                    <td>{{$details['shipper']}}</td>
                                                    <td>{{$details['receiver']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{$details['origin']}}</td>
                                                    <td>{{$details['destination']}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr class="text-center ">
                                                    <th>Tanggal/Waktu</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                                @foreach ($historys as $history)
                                                <tr>
                                                    <td class="text-center">{{$history['date']}}</td>
                                                    <td>{{$history['desc']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/admin/modules/sweetalert.js')}}"></script>
<script>
    $('.delete-confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Anda yakin ingin membatalkan pesanan?`,
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
    $('.receive-confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Anda yakin ingin mengkonfirmasi pesanan?`,
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
