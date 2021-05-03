<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->orderBy('name', 'ASC')->paginate(10);
        return view('dashboard.category.index', ['categories'=>$categories]);
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();

        if(Category::create($validatedData)){
            return redirect()->route('categories.index')->with('status', __('Category :category added', ['category'=>$validatedData['name']]));
        }
        return back()->withInput();
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', ['category'=>$category]);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $this->validate($request, [
            "name" => 'required|unique:categories,name,'.$category->id
        ]);

        Category::find($category->id)->update($validatedData);
        return redirect()->route('categories.index')->with('status', __('Category updated successfully'));
    }

    public function destroy(Category $category)
    {
        Category::find($category->id)->delete();
        return back()->with('status', __('Category deleted successfully'));
    }
}
