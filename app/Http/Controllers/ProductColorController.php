<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductColorController extends Controller
{
    public function index()
    {
        $product_colors = ProductColor::where('client_id', Auth::user()->client_id)->get();
        return view('product.product_color.all', compact('product_colors'));
    }

    public function add()
    {
        return view('product.product_color.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_colors',
            'status' => 'required'
        ]);

        $product_color = new ProductColor();
        $product_color->client_id = Auth::user()->client_id;
        $product_color->name = $request->name;
        $product_color->status = $request->status;
        $product_color->user_id = Auth::id();
        $product_color->save();

        return redirect()->route('product_colors')->with('message', 'Product color add successfully.');
    }

    public function edit(ProductColor $product_color)
    {
        $this->clientCheck($product_color);
        return view('product.product_color.edit', compact('product_color'));
    }

    public function update(ProductColor $product_color, Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->route('product_colors')->with('message', 'Product color edit successfully.');
    }

    public function delete(ProductColor $product_color)
    {
        $this->clientCheck($product_color);
        $product_color->delete();
        return redirect()->route('product_colors')->with('message', 'Product color delete successfully.');
    }
}
