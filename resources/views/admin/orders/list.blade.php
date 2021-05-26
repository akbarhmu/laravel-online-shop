@section('title', $subtitle)
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('Orders')}}</h1>
        </div>
        <div class="section-body">
            @include('admin.orders.partials.menu')
            <div class="card">
                <div class="card-header">
                    <h4>{{$subtitle}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
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
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Invoice</th>
                                        <th>Pemesan</th>
                                        <th>Total</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status Pesanan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration + $orders->firstItem() -1}}</td>
                                            <td>{{$order->invoice}}</td>
                                            <td>{{$order->order_name}}</td>
                                            <td>@rupiah($order->total)</td>
                                            <td>{{$order->payment_method ?: '-'}}</td>
                                            <td>
                                                <x-admin-order-status status="{{$order->status}}" />
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.orders.show', $order->invoice)}}" class="btn btn-warning">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pagination float-right">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
