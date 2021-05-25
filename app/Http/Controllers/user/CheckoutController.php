<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!$this->stockValidation()){
            return redirect()->route('carts.index')->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        $carts = Cart::join('users','users.id','=','carts.user_id')
                        ->join('products','products.id','=','carts.product_id')
                        ->select('products.name as product_name', 'products.id as product_id', 'products.image','users.name','carts.*','products.price','products.weight')
                        ->where('carts.user_id','=', Auth::user()->id)
                        ->get();

        if($carts->isEmpty()){
            return back()->with('error', __('Cart is empty!'));
        }

        // Address
        $address = $this->getAddress();

        // Shipping Cost
            $cost_jne = $this->calculateCost('jne');
            $cost_pos = $this->calculateCost('pos');

        // SubTotal
        $subtotal = $this->getSubTotal();
        return view('user.checkout.index', ['carts'=>$carts, 'address'=>$address, 'cost_jne'=>$cost_jne, 'cost_pos'=>$cost_pos, 'subtotal'=>$subtotal]);
    }

    public function create()
    {
        //
    }

    public function store(CheckoutRequest $request)
    {
        $validatedData = $request->validated();

        // Data Keranjang
        $carts = Cart::join('users','users.id','=','carts.user_id')
                        ->join('products','products.id','=','carts.product_id')
                        ->select('products.name as product_name', 'products.id as product_id', 'products.image','users.name','carts.*','products.price','products.weight')
                        ->where('carts.user_id','=', Auth::user()->id)
                        ->get();
        // Memastikan Ada Produk
        if($carts->isEmpty()){
            return redirect()->route('carts.index')->with('error', 'Keranjang kosong');
        }

        // Memastikan Jumlah Item Tidak Melebihi Stok Yang Tersedia
        if(!$this->stockValidation()){
            return redirect()->route('carts.index')->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        // Ongkos Kirim
        if($validatedData['courier']=='jne'){
            $shipping_cost = $this->calculateCost('jne');
        }elseif($validatedData['courier']=='pos'){
            $shipping_cost = $this->calculateCost('pos');
        }

        // Total
        $total = $shipping_cost+$this->getSubTotal();

        // Invoice
        $no_invoice = $this->getInvoiceNumber();

        // Insert Order
        $order_id = DB::table('orders')->insertGetId([
                        'invoice'       => $no_invoice,
                        'order_name'    => $validatedData['order_name'],
                        'order_phone'   => $validatedData['order_phone'],
                        'order_notes'   => $validatedData['order_notes'],
                        'order_address' => $this->getAddress(),
                        'user_id'       => Auth::user()->id,
                        'subtotal'      => $this->getSubTotal(),
                        'shipping_cost' => $shipping_cost,
                        'total'         => $total,
                        'courier'       => $validatedData['courier'],
                        'status'        => 1,
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);

        // Insert Order Detail
        foreach($carts as $cart){
            $order_detail = new OrderDetail();
            $order_detail->order_id         = $order_id;
            $order_detail->product_image    = $cart->image;
            $order_detail->product_name     = $cart->product_name;
            $order_detail->product_weight   = $cart->weight;
            $order_detail->product_quantity = $cart->quantity;
            $order_detail->product_price    = $cart->price;
            $order_detail->product_subtotal = $cart->quantity*$cart->price;
            $order_detail->save();
        }

        // Delete Cart Data
        Cart::where('user_id', Auth::user()->id)->delete();

        // Kurangi stok produk
        foreach($carts as $cart){
            $product = Product::find($cart->product_id);
            $product->quantity = $product->quantity - $cart->quantity;
            $product->save();
        }

        return redirect()->route('orders.success', $no_invoice);

    }

    public function show($id)
    {
        //
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

    public function getAddress(){
        $user = User::join('provinces', 'users.province_id', '=', 'provinces.id')
                        ->join('cities', 'users.city_id', '=', 'cities.id')
                        ->select('users.*', 'provinces.province as province_name', 'cities.city_name as city_name')
                        ->where('users.id', '=', Auth::user()->id)
                        ->first();

        return $user->address.", ".$user->subdistrict.", ".$user->city_name.", ".$user->province_name." ".$user->postal_code;
    }

    public function getSubTotal()
    {
        $carts = Cart::join('users','users.id','=','carts.user_id')
                        ->join('products','products.id','=','carts.product_id')
                        ->select('products.name as product_name', 'products.id as product_id', 'products.image','users.name','carts.*','products.price','products.weight')
                        ->where('carts.user_id','=', Auth::user()->id)
                        ->get();
        $subtotal = 0;
        foreach($carts as $cart){
            $price = $cart->price*$cart->quantity;
            $subtotal = $subtotal+$price;
        }

        return $subtotal;
    }

    public function stockValidation()
    {
        $carts = Cart::join('users','users.id','=','carts.user_id')
                        ->join('products','products.id','=','carts.product_id')
                        ->select('products.name as product_name', 'products.id as product_id', 'products.image','users.name','carts.*','products.price','products.weight','products.quantity as product_stock')
                        ->where('carts.user_id','=', Auth::user()->id)
                        ->get();
        foreach($carts as $cart){
            if($cart->quantity>$cart->product_stock){
                return false;
            }
        }

        return true;
    }

    public function calculateCost($courier)
    {
        $carts = Cart::join('users','users.id','=','carts.user_id')
                        ->join('products','products.id','=','carts.product_id')
                        ->select('products.name as product_name', 'products.id as product_id', 'products.image','users.name','carts.*','products.price','products.weight')
                        ->where('carts.user_id','=', Auth::user()->id)
                        ->get();

        // Weight
        $total_weight = 0;
        foreach($carts as $product){
            $weight = $product->weight * $product->quantity;
            $total_weight = $total_weight + $weight;
        }

        if($total_weight>0){
            $shop_city = Shop::find(1)->city_id;

            $cost = RajaOngkir::ongkosKirim([
                'origin'        => $shop_city,
                'destination'   => Auth::user()->city_id,
                'weight'        => $total_weight,
                'courier'       => $courier,
            ]);

            return $cost->result[0]['costs'][0]['cost'][0]['value'];
        }

        return 0;
    }

    public function getInvoiceNumber()
    {
        $last_record = Order::whereDate('created_at', Carbon::today())->latest()->first();
        if($last_record!=null){
            $next_id = $last_record->id+1;
        }else{
            $next_id = 1;
        }
        $date = Carbon::today()->format('dmy');
        return 'INV-'.$date.'-'.$next_id;
    }
}
