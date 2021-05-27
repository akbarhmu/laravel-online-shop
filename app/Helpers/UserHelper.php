<?php
namespace App\Helpers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Shop;

class UserHelper {
    public static function set_active($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
    public static function set_menu($path) {
        return call_user_func_array('Request::is', (array)$path) ? 'btn btn-primary text-light d-block d-sm-inline-block' : 'btn btn-secondary d-block text-dark d-sm-inline-block';
    }
    public static function getCartCount($id) {
        return Cart::where('user_id', $id)->count();
    }
    public static function getNewOrderCount($id) {
        return Order::where('status', 1)->orWhere('status', 2)->orWhere('status', 3)->orWhere('status', 4)->where('user_id', $id)->count();
    }
    public static function getShopData($column) {
        return Shop::join('cities','shops.city_id','=','cities.id')
                        ->join('provinces','shops.province_id','=','provinces.id')
                        ->select('shops.*', 'cities.city_name', 'provinces.province as province_name')
                        ->where('shops.id','=', 1)->value($column);
    }
    public static function getShopAddress() {
        $shop = Shop::join('cities','shops.city_id','=','cities.id')
                        ->join('provinces','shops.province_id','=','provinces.id')
                        ->select('shops.*', 'cities.city_name', 'provinces.province as province_name')
                        ->where('shops.id','=', 1)->first();
        return $shop->address.", ".$shop->subdistrict.", ".$shop->city_name.", ".$shop->province_name." ".$shop->postal_code;
    }
}
