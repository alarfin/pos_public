<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::where('client_id', Auth::user()->client_id)->get();
        return view('product.product_category.all', compact('product_categories'));
    }

    public function add()
    {
        return view('product.product_category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $product_category = new ProductCategory();
        $product_category->client_id = Auth::user()->client_id;
        $product_category->name = $request->name;
        $product_category->description = $request->description;
        $product_category->status = $request->status;
        $product_category->user_id = Auth::id();
        $product_category->save();

        return redirect()->route('product_categories')->with('message', 'Product category add successfully.');
    }

    public function edit(ProductCategory $product_category)
    {
        $this->clientCheck($product_category);
        return view('product.product_category.edit', compact('product_category'));
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $this->clientCheck($product_category);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $product_category->name = $request->name;
        $product_category->description = $request->description;
        $product_category->status = $request->status;
        $product_category->save();

        return redirect()->route('product_categories')->with('message', 'Product category edit successfully.');
    }

    public function delete(ProductCategory $product_category)
    {
        $this->clientCheck($product_category);
        $product_category->delete();
        return redirect()->route('product_categories')->with('message', 'Product category delete successfully.');
    }
}
