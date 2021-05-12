<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function index(){
        $products = Product::with('categories')->orderBy('updated_at', 'desc')->get();
        return view('user.index', ['products'=>$products]);
    }

    public function showAllProduct(){
        $products = Product::with('categories')->orderBy('name', 'asc')->paginate(12);
        $categories = Category::withCount('products')->get();
        return view('user.product.index', ['products'=>$products, 'categories'=>$categories]);
    }

    public function showProductCategory(Category $category){
        $categories = Category::withCount('products')->get();
        $category = Category::find($category->id);
        $products = Product::where('category_id', $category->id)->orderBy('name', 'asc')->paginate(12);

        return view('user.category.show', ['categories'=>$categories, 'category'=>$category, 'products'=>$products]);
    }

    public function product(Product $product){
        $product = Product::find($product->id);
        return view('user.product.show', ['product'=>$product]);
    }

    public function address(){
        $user = User::where('users.id', Auth::user()->id)
                    ->join('provinces', 'provinces.id', '=', 'users.province_id')
                    ->join('cities', 'cities.id', '=', 'users.city_id')
                    ->select('users.*', 'cities.city_name', 'provinces.province as province_name')
                    ->first();
        $provinces = Province::all();
        $address = $user->address.", Kecamatan ".$user->subdistrict.", ".$user->city_name.", ".$user->province_name.", ".$user->postal_code;
        return view('profile.address', ['address'=>$address, 'provinces'=>$provinces]);
    }
}
