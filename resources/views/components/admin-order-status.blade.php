@if ($status==0)
    <span class="badge badge-dark">Pesanan Dibatalkan</span>
@elseif($status==1)
    <span class="badge badge-primary">Belum Bayar</span>
@elseif ($status==2)
    <span class="badge badge-danger">Menunggu Konfirmasi</span>
@elseif ($status==3)
    <span class="badge badge-warning">Sedang Diproses</span>
@elseif ($status==4)
    <span class="badge badge-info">Sedang Dikirim</span>
@elseif ($status==5)
    <span class="badge badge-success">Selesai</span>
@endif
