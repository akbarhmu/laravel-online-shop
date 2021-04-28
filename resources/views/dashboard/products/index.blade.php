@extends('layouts.dashboard')
@section('title', __('Products'))
@section('subtitle', 'Navbar will appear in top of the page.')
@section('breadcrumb', 'Products')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="table-responsive">
                                <table class="table table-stripped" id="tableProducts">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Berat</th>
                                            <th>Kategori</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{$loop->iteration()}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->weight}}</td>
                                                <td>{{$product->category_id}}</td>
                                                <td>{{$product->quantity}}</td>
                                                <td>{{$product->image}}</td>
                                                <td>{{$product->name}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
