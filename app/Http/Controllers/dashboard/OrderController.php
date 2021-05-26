<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\CekResiController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function all()
    {
        $orders = Order::orderBy('updated_at', 'DESC')
                    ->paginate(10);
        $counts = $this->countOrders();
        return view('admin.orders.list', ['orders'=>$orders, 'counts'=>$counts, 'subtitle'=>'Semua Pesanan']);
    }

    public function newList()
    {
        $orders = Order::where('status', '=', 1)
                    ->orWhere('status', '=', 2)
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
        $counts = $this->countOrders();
        return view('admin.orders.list', ['orders'=>$orders, 'counts'=>$counts, 'subtitle'=>'Pesanan Baru']);
    }

    public function processList()
    {
        $orders = Order::where('status', '=', 3)
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
        $counts = $this->countOrders();
        return view('admin.orders.list', ['orders'=>$orders, 'counts'=>$counts, 'subtitle'=>'Pesanan Siap Dikirim']);
    }

    public function deliveredList()
    {
        $orders = Order::where('status', '=', 4)
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
        $counts = $this->countOrders();
        return view('admin.orders.list', ['orders'=>$orders, 'counts'=>$counts, 'subtitle'=>'Pesanan Sedang Dikirim']);
    }

    public function doneList()
    {
        $orders = Order::where('status', '=', 5)
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
        $counts = $this->countOrders();
        return view('admin.orders.list', ['orders'=>$orders, 'counts'=>$counts, 'subtitle'=>'Pesanan Selesai']);
    }

    public function cancelList()
    {
        $orders = Order::where('status', '=', 0)
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
        $counts = $this->countOrders();
        return view('admin.orders.list', ['orders'=>$orders, 'counts'=>$counts, 'subtitle'=>'Pesanan Dibatalkan']);
    }

    public function show($order)
    {
        $order      = Order::where('invoice', '=', $order)
                        ->first();
        $products   = OrderDetail::where('order_id', $order->id)
                        ->get();
        if($order->status==4){
            $jsonresi = CekResiController::getApiCekResi($order->courier, $order->tracking_number);
            if($jsonresi==null){
                return view('admin.orders.show', ['order'=>$order, 'products'=>$products, 'showresi'=>false]);
            }elseif($jsonresi['status'] == 200){
                $sortedArr = collect($jsonresi['data']['history'])->sortBy('date')->all();

                return view('admin.orders.show', ['order'=>$order, 'products'=>$products, 'showresi'=>true, 'summarys'=>$jsonresi['data']['summary'], 'details'=>$jsonresi['data']['detail'], 'historys'=>$sortedArr]);
            }else{
                return view('admin.orders.show', ['order'=>$order, 'products'=>$products, 'showresi'=>false]);
            }
        }
        return view('admin.orders.show', ['order'=>$order, 'products'=>$products, 'showresi'=>false]);
    }

    public function confirm(Request $request, $order)
    {
        $order      = Order::where('invoice', '=', $order)
                        ->first();
        if($order!=null && $order->status==2){
            if($request->status=='terima'){
                $order->status = 3;
                $order->save();
                return back()->with('status', 'Pembayaran telah dikonfirmasi');
            }elseif($request->status='tolak'){
                $order->status = 1;

                if(File::exists(storage_path('app/payment_proffs/'.$order->payment_proff_image))){
                    File::delete(storage_path('app/payment_proffs/'.$order->payment_proff_image));
                }

                $order->payment_proff_image = null;
                $order->save();
                return back()->with('error', 'Konfirmasi pembayaran ditolak');
            }
        }

        return back()->with('error', 'Pesanan tidak sesuai');
    }

    public function delivered(Request $request, $order)
    {
        $order      = Order::where('invoice', '=', $order)
                        ->first();
        if($order!=null && $order->status==3){
            $order->tracking_number = $request->tracking_number;
            $order->status = 4;
            $order->save();
            return back()->with('status', 'No. Resi berhasil diinput');
        }

        return back()->with('error', 'Pesanan tidak sesuai');
    }

    public function cancel($order)
    {
        $order      = Order::where('invoice', '=', $order)
                        ->first();
        if($order!=null){
            $order->status = 0;
            $order->save();

            return back()->with('status', 'Pesanan dibatalkan');
        }

        return back()->with('error', 'Pesanan tidak sesuai');
    }

    public function done($order)
    {
        $order      = Order::where('invoice', '=', $order)
                        ->first();
        if($order!=null && $order->status==4){
            $order->status = 5;
            $order->save();
            return back()->with('status', 'Pesanan ditandai selesai');
        }

        return back()->with('error', 'Pesanan tidak sesuai');
    }

    public function countOrders()
    {
        $c_all      = Order::all()->count();
        $c_new      = Order::where('status', '=', 1)->orWhere('status', '=', 2)->count();
        $c_ok       = Order::where('status', '=', 3)->count();
        $c_send     = Order::where('status', '=', 4)->count();
        $c_done     = Order::where('status', '=', 5)->count();
        $c_cancel   = Order::where('status', '=', 0)->count();

        return array(
            'all'   => $c_all,
            'new'   => $c_new,
            'ok'    => $c_ok,
            'send'  => $c_send,
            'done'  => $c_done,
            'cancel'=> $c_cancel
        );
    }
}
