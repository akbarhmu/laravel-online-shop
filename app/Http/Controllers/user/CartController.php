<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::join('users','users.id','=','carts.user_id')
                        ->join('products','products.id','=','carts.product_id')
                        ->select('products.name as product_name', 'products.id as product_id', 'products.image','users.name','carts.*','products.price')
                        ->where('carts.user_id','=', Auth::user()->id)
                        ->get();
        return view('user.cart.index', ['carts'=>$carts]);
    }

    public function store(CartRequest $request){
        $validatedData = $request->validated();
        $product = Product::find($validatedData['product_id']);
        $cart = Cart::where('user_id', '=', Auth::user()->id)
            ->where('product_id', '=', $validatedData['product_id'])
            ->first();

        // Cek Apakah Produk Ada
        if($product!=null){
            // Cek Apakah Sudah Ada Produk Tersebut Dalam Cart
            if($cart!=null){
                // Cek Apakah Jumlah Lama + Jumlah Baru Melebihi Stok
                if(($cart->quantity+$validatedData['quantity'])<=$product->quantity){
                    // Update Cart
                    try{
                        $cart->increment('quantity', $validatedData['quantity']);
                        $cart->save();
                        return redirect()->route('carts.index');
                    }catch(Exception $e){
                        return back()->with('error', __("Can't update cart"));
                    }
                }
                return back()->withInput()->with('error', __("Quantity in cart is greater than available stock"));
            }else{
                // Cek Apakah Jumlah Melebihi Stok
                if($validatedData['quantity']<=$product->quantity){
                    // Insert Ke Cart
                    Cart::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $validatedData['product_id'],
                        'quantity' => $validatedData['quantity']
                    ]);

                    return redirect()->route('carts.index');
                }
                return back()->withInput()->with('error', __("Quantity is greater than available stock"));
            }
        }

        return back()->withInput()->with('error', __("Product doesn't exist"));
    }

    public function update(Request $request){
        $index = 0;
        $validatedData = $request->validate([
            'quantity.*'    => 'required|numeric|min:1'
        ]);

        if($request->cart_id!=null){
            // Loop sesuai dengan jumlah id
            foreach($request->cart_id as $id){
                $cart = Cart::findOrFail($id);
                $product = Product::findOrFail($request->product_id[$index]);

                // Cek Apakah Jumlah Baru Melebihi Stok
                if($request->quantity[$index]<=$product->quantity){
                    try{
                        $cart->quantity = $request->quantity[$index];
                        $cart->save();
                    }catch(Exception $e){}
                } else {
                    return back()->with('error', __("Some products quantity is greater than available stock"));
                }

                $index++;
            }
        }

        return back();
    }

    public function destroy(Cart $cart){
        $cart = Cart::where('id', $cart->id)->first();

        if($cart != null){
            try{
                $cart->delete();

                return back()->with('status', __('Product deleted successfully'));
            }catch(Exception $e){
                return back()->with('error', "Product can't be deleted");
            }
        }

        return back()->with('error', __("Cart data doesn't exist"));
    }
}
