<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductBrandController extends Controller
{
    public function index()
    {
        $product_brands = ProductBrand::where('client_id', Auth::user()->client_id)->get();
        return view('product.product_brand.all', compact('product_brands'));
    }

    public function add()
    {
        return view('product.product_brand.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $product_brand = new ProductBrand();
        $product_brand->client_id = Auth::user()->client_id;
        $product_brand->name = $request->name;
        $product_brand->description = $request->description;
        $product_brand->status = $request->status;
        $product_brand->user_id = Auth::id();
        $product_brand->save();

        return redirect()->route('product_brands')->with('message', 'Product brand add successfully.');
    }

    public function edit(ProductBrand $product_brand)
    {
        $this->clientCheck($product_brand);
        return view('product.product_brand.edit', compact('product_brand'));
    }

    public function update(ProductBrand $product_brand, Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->route('product_brands')->with('message', 'Product brand edit successfully.');
    }

    public function delete(ProductBrand $product_brand)
    {
        $this->clientCheck($product_brand);
        $product_brand->delete();
        return redirect()->route('product_brands')->with('message', 'Product brand delete successfully.');
    }
}
