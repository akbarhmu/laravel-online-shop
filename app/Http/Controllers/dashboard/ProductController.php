<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*', 'categories.name as category_name')->join('categories', 'products.category_id', '=', 'categories.id')->orderBy('products.name', 'ASC')->paginate(10);
        return view('dashboard.product.index', ['products'=>$products]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create', ['categories'=>$categories]);
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        $imagePath = $validatedData['image']->store('products', 'public');
        $image = Image::make('storage/'.$imagePath)->resize(375,375);
        $image->save('storage/'.$imagePath, 90);

        $product = new Product();
        $product-> name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->image = $imagePath;
        $product->price = $validatedData['price'];
        $product->weight = $validatedData['weight'];
        $product->quantity = $validatedData['quantity'];
        $product->category_id = $validatedData['category_id'];

        if($product->save()){
            return redirect()->route('products.index')->with('status', __('Product :name added successfully', ['name' => $validatedData['name']]));
        } else {
            return back()->withInput()->with('error', __("Product can't be added"));
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.product.edit', ['product'=>$product, 'categories'=>$categories]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        if($product != null){
            $validatedData = $request->validate([
                'name'          => 'required|regex:/^[a-zA-Z0-9 .-]*$/u',
                'description'   => 'required',
                'category_id'   => 'required|exists:categories,id',
                'image'         => 'file|image|dimensions:min_width=375,min_height=375,ratio=1/1|max:1024',
                'price'         => 'required|integer',
                'weight'        => 'required|integer',
                'quantity'      => 'required|integer'
            ]);

            $product = Product::find($id);
            $product-> name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->weight = $validatedData['weight'];
            $product->quantity = $validatedData['quantity'];
            $product->category_id = $validatedData['category_id'];

            if($request->hasFile('image')){
                $oldImagePath = 'storage/'.$product->image;
                if(File::exists($oldImagePath)){
                    File::delete($oldImagePath);
                }

                $newImagePath = $validatedData['image']->store('products', 'public');
                $newImage = Image::make('storage/'.$newImagePath)->resize(375,375);
                $newImage->save('storage/'.$newImagePath, 90);
                $product->image = $newImagePath;
            }

            if($product->save()){
                return redirect()->route('products.index')->with('status', __(':name product data has been updated', ['name' => $validatedData['name']]));
            }

            return back()->withInput()->with('error', __("Product data can't be updated"));
        }

        return redirect()->route('products.index')->withInput()->with('error', __("Product doesn't exist"));
    }

    public function destroy(Product $product)
    {
        $product = Product::where('id', $product->id)->first();

        if($product != null){
            $imagePath = 'storage/'.$product->image;

            if(File::exists($imagePath)){
                File::delete($imagePath);
            }

            $product->delete();
            return back()->with('status', __('Product deleted successfully'));
        }

        return back()->with('error', __("Product doesn't exist"));
    }
}
