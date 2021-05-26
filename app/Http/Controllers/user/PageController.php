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

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $products = Product::with('categories')->where('products.name', 'like', '%' . $keyword . '%')->orderBy('name', 'asc')->paginate(12);
        $categories = Category::withCount('products')->get();
        return view('user.product.search', ['products'=>$products, 'categories'=>$categories, 'keyword'=>$keyword]);
    }
}
