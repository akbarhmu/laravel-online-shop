<div class="container-fluid mb-2 p-0">
    <a href="{{route('admin.orders.index')}}" class="{{Custom::set_menu(['dashboard/orders'])}}">Semua Pesanan ({{$counts['all']}})</a>
    <a href="{{route('admin.orders.newlist')}}" class="{{Custom::set_menu(['dashboard/orders/new'])}}">Pesanan Baru ({{$counts['new']}})</a>
    <a href="{{route('admin.orders.processlist')}}" class="{{Custom::set_menu(['dashboard/orders/process'])}}">Siap Dikirim ({{$counts['ok']}})</a>
    <a href="{{route('admin.orders.deliveredlist')}}" class="{{Custom::set_menu(['dashboard/orders/delivered'])}}">Dalam Pengiriman ({{$counts['send']}})</a>
    <a href="{{route('admin.orders.donelist')}}" class="{{Custom::set_menu(['dashboard/orders/done'])}}">Pesanan Selesai ({{$counts['done']}})</a>
    <a href="{{route('admin.orders.cancellist')}}" class="{{Custom::set_menu(['dashboard/orders/cancel'])}}">Dibatalkan ({{$counts['cancel']}})</a>
</div>
