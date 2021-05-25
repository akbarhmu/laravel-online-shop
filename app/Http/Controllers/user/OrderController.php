<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\CekResiController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function success($order)
    {
        $order = Order::where('invoice', $order)->first();
        if($order->invoice==null && $order->user_id==Auth::user()->id){
            return redirect()->route('orders.index');
        }
        return view('user.order.success', ['order'=>$order]);
    }

    public function index()
    {
        $newOrders      = Order::where('user_id', Auth::user()->id)
                            ->where('status', '=', 1)
                            ->orderBy('updated_at', 'DESC')
                            ->get();
        $processOrders  = Order::where('user_id', Auth::user()->id)
                            ->whereBetween('status', array(2, 4))
                            ->orderBy('updated_at', 'DESC')
                            ->get();
        $historyOrders  = Order::where('user_id', Auth::user()->id)
                            ->where('status', '=', 0)
                            ->orWhere('status', '=', 5)
                            ->orderBy('updated_at', 'DESC')
                            ->paginate(5);
        return view('user.order.index', ['newOrders'=>$newOrders, 'processOrders'=>$processOrders, 'historyOrders'=>$historyOrders]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $order = Order::where('invoice', $id)->first();
        if($order!=null && $order->user_id==Auth::user()->id){
            $products = OrderDetail::where('order_id', $order->id)->get();

            if($order->status>=3){
                $jsonresi = CekResiController::getApiCekResi($order->courier, $order->tracking_number);

                if($jsonresi==null){
                    return view('user.order.show', ['order'=>$order, 'products'=>$products, 'showresi'=>false]);
                }elseif($jsonresi['status'] == 200){
                    $sortedArr = collect($jsonresi['data']['history'])->sortBy('date')->all();
                    $fdate = end($sortedArr);
                    $ldate = prev($sortedArr);
                    $dateTime1 = new DateTime($fdate['date']);
                    $dateTime2 = new DateTime($ldate['date']);
                    $interval = $dateTime1->diff($dateTime2);
                    $fullinterval = $interval->h.' jam'.$interval->i.' menit';
                    $hours = $interval->format('%h');
                    return view('user.order.show', ['order'=>$order, 'products'=>$products, 'summarys'=>$jsonresi['data']['summary'], 'details'=>$jsonresi['data']['detail'], 'historys'=>$sortedArr, 'showresi'=>true, 'full'=>$fullinterval]);
                }else{
                    return view('user.order.show', ['order'=>$order, 'products'=>$products, 'showresi'=>false]);
                }
            }

            return view('user.order.show', ['order'=>$order, 'products'=>$products, 'showresi'=>false]);
        }

        return redirect()->route('orders.index')->with('error', 'Pesanan tidak ditemukan');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function cancel($order)
    {
        $order = Order::where('invoice', $order)->first();

        if($order!=null && $order->status==1 && $order->user_id==Auth::user()->id){
            $order->status = 0;
            $order->save();
            return back()->with('status', 'Pesanan dibatalkan');
        }

        return back()->with('error', 'Pesanan tidak sesuai');
    }

    public function received($order)
    {
        $order = Order::where('invoice', $order)->first();

        if($order!=null && $order->status==4 && $order->user_id==Auth::user()->id){
            $order->status = 5;
            $order->save();
            return back()->with('status', 'Pesanan selesai. Terima kasih!');
        }

        return back()->with('error', 'Pesanan tidak sesuai');
    }

    public function payment($order)
    {
        $order = Order::where('invoice', $order)->first();

        if($order->status==1 && $order->user_id==Auth::user()->id){
            $payment_methods = PaymentMethod::all();
            $total = $order->total;
            $invoice = $order->invoice;
            return view('user.order.payment', ['payment_methods'=>$payment_methods, 'total'=>$total, 'invoice'=>$invoice]);
        }

        return redirect()->route('orders.show', $order);
    }

    public function paymentProcess(Request $request, $order)
    {
        $validatedData = $request->validate([
            'payment_method'        => 'string|nullable',
            'payment_proff_image'   => 'required|file|image'
        ]);

        $image = $validatedData['payment_proff_image']->store('payment_proffs');

        $orders = Order::where('invoice', $order)->first();
        $orders->payment_proff_image = basename($image);
        $orders->status = 2;

        if($validatedData['payment_method']!=null){
            $orders->payment_method = $validatedData['payment_method'];
        } else {
            $orders->payment_method = "Transfer";
        }

        $orders->save();

        return redirect()->route('orders.index', $order)->with('status', 'Konfirmasi pembayaran diterima');
    }
}
