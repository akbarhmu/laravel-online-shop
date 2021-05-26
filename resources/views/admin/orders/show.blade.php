@section('title', 'Pesanan '.$order->invoice)
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pesanan</h1>
            <div class="section-header-breadcrumb">
                @if ($order->status==2)
                    <button class="btn btn-success btn-icon icon-left d-block d-sm-inline-block" data-toggle="modal" data-target="#pembayaranModal"><i class="fas fa-money-check-alt"></i> Konfirmasi Pembayaran</button>&nbsp;
                @endif
                @if ($order->status==3)
                    <button class="btn btn-success btn-icon icon-left d-block d-sm-inline-block" data-toggle="modal" data-target="#resiModal"><i class="fas fa-shipping-fast"></i> Input No. Resi</button>&nbsp;
                @endif
                @if ($order->status==4 && $showresi==true)
                    <button class="btn btn-primary btn-icon icon-left d-block d-sm-inline-block" data-toggle="modal" data-target="#lacakModal"><i class="fas fa-shipping-fast"></i> Lacak Pengiriman</button>&nbsp;
                    <form action="{{route('admin.orders.done', $order->invoice)}}" method="post" style="display: unset;">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger btn-icon icon-left done-confirm d-block d-sm-inline-block" data-name="{{$order->invoice}}"><i class="fas fa-check"></i> Selesai</button>
                    </form>&nbsp;
                @endif
                @if ($order->status!=4 && $order->status!=5)
                <form action="{{route('admin.orders.cancel', $order->invoice)}}" method="post" style="display: unset;">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger btn-icon icon-left cancel-confirm d-block d-sm-inline-block" data-name="{{$order->invoice}}"><i class="fas fa-window-close"></i> Batal Pesanan</button>
                </form>&nbsp;
                @endif
                {{-- <button class="btn btn-warning btn-icon icon-left d-block d-sm-inline-block"><i class="fas fa-print"></i> Print</button> --}}
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                <div class="row w-100">
                    @if (session('status'))
                        <div class="alert alert-success mb-3 w-100" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mb-3 w-100" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title mb-4">
                            <h2>Pesanan</h2>
                            <div class="invoice-number">{{$order->invoice}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td>{{$order->order_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>:</td>
                                                <td>{{$order->order_address}}</td>
                                            </tr>
                                            <tr>
                                                <th>Telepon</th>
                                                <td>:</td>
                                                <td>{{$order->order_phone}}</td>
                                            </tr>
                                            <tr>
                                                <th>Catatan</th>
                                                <td>:</td>
                                                <td>{{$order->order_notes}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Jasa Pengiriman</th>
                                                <td>:</td>
                                                <td>
                                                    @if($order->courier=='pos')
                                                        POS Kilat Khusus
                                                    @elseif($order->courier=='jne')
                                                        JNE Reguler
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Metode Pembayaran</th>
                                                <td>:</td>
                                                <td>{{$order->payment_method ?: '-'}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Resi</th>
                                                <td>:</td>
                                                <td>{{$order->tracking_number ?: '-'}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status Pesanan</th>
                                                <td>:</td>
                                                <td><x-admin-order-status status="{{$order->status}}" /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-0">
                    <div class="col-md-12">
                    <div class="section-title">Ringkasan Pesanan</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th data-width="40">#</th>
                                <th class="text-center">Gambar</th>
                                <th>Nama Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-right">Total</th>
                            </tr>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="text-center"><img src="{{ asset('storage/'.$product->product_image) }}" alt="" srcset="" width="50"></td>
                                        <td>{{ $product->product_name }}</td>
                                        <td class="text-center">@rupiah($product->product_price)</td>
                                        <td class="text-center">{{ $product->product_quantity }}</td>
                                        <td class="text-right">@rupiah($product->product_subtotal)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <div class="section-title">Metode Pembayaran</div>
                            {{$order->payment_method ?: '-'}}
                        </div>
                        <div class="col-lg-4 text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div class="invoice-detail-value">@rupiah($order->subtotal)</div>
                            </div>
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Biaya Pengiriman</div>
                                <div class="invoice-detail-value">@rupiah($order->shipping_cost)</div>
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">@rupiah($order->total)</div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @if ($order->status==2)
            <div class="modal fade" tabindex="-1" role="dialog" id="pembayaranModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-2 text-center">
                                <img src="{{route('images.payment', $order->payment_proff_image)}}" style="margin: 0px auto;">
                            </div>
                            <div class="row text-center">
                                <span class="font-weight-bold" style="margin: 0px auto;">{{$order->payment_method}}</span>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <form action="{{route('admin.orders.confirm', $order->invoice)}}" method="post" style="display: unset;">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="status" id="status" value="tolak" hidden required>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Tolak</button>
                            </form>
                            <form action="{{route('admin.orders.confirm', $order->invoice)}}" method="post" style="display: unset;">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="status" id="status" value="terima" hidden required>
                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Konfirmasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($order->status==3)
            <div class="modal fade" tabindex="-1" role="dialog" id="resiModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Input Nomor Resi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('admin.orders.delivered', $order->invoice)}}" method="post" style="display: unset;">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="jasa">Jasa Pengiriman</label>
                                    <input type="text" class="form-control" value="@if($order->courier=='jne') JNE Reguler @else POS Kilat Khusus @endif" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="tracking_number">Nomor Resi Pengiriman</label>
                                    <input type="text" name="tracking_number" id="tracking_number" class="form-control" required autofocus>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                    <input type="text" name="status" id="status" value="terima" hidden required>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if ($order->status==4 && $showresi==true)
            <div class="modal fade" tabindex="-1" role="dialog" id="lacakModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lacak Pengiriman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr class="text-center bg-primary text-light" >
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
                                        <tr class="text-center bg-primary text-light">
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
                </div>
            </div>
        @endif
    </section>
</div>
@endsection
@section('js')
<script src="{{asset('js/admin/modules/sweetalert.js')}}"></script>
<script>
    $('.cancel-confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name").toLowerCase();
        event.preventDefault();
        swal({
            title: `Anda yakin ingin membatalkan pesanan ${name}?`,
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
    $('.done-confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name").toLowerCase();
        event.preventDefault();
        swal({
            title: `Anda yakin ingin menyelesaikan pesanan ${name}?`,
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
</script>
<script>
    $('.modal').on('shown.bs.modal', function() {
        $('.modal').appendTo("body")
    });
</script>
@endsection
