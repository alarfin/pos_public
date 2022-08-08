<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSizeController extends Controller
{
    public function index()
    {
        $product_sizes = ProductSize::where('client_id', Auth::user()->client_id)->get();
        return view('product.product_size.all', compact('product_sizes'));
    }

    public function add()
    {
        return view('product.product_size.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_sizes',
            'status' => 'required'
        ]);

        $product_size = new ProductSize();
        $product_size->client_id = Auth::user()->client_id;
        $product_size->name = $request->name;
        $product_size->status = $request->status;
        $product_size->user_id = Auth::id();
        $product_size->save();

        return redirect()->route('product_sizes')->with('message', 'Product size add successfully.');
    }

    public function edit(ProductSize $product_size)
    {
        $this->clientCheck($product_size);
        return view('product.product_size.edit', compact('product_size'));
    }

    public function update(ProductSize $product_size, Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->route('product_sizes')->with('message', 'Product size edit successfully.');
    }

    public function delete(ProductSize $product_size)
    {
        $this->clientCheck($product_size);
        $product_size->delete();
        return redirect()->route('product_sizes')->with('message', 'Product size delete successfully.');
    }
}
