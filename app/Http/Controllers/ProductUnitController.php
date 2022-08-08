<?php

namespace App\Http\Controllers;

use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductUnitController extends Controller
{
    public function index()
    {
        $product_units = ProductUnit::where('client_id', Auth::user()->client_id)->get();
        return view('product.product_unit.all', compact('product_units'));
    }

    public function add()
    {
        return view('product.product_unit.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $product_unit = new ProductUnit();
        $product_unit->client_id = Auth::user()->client_id;
        $product_unit->name = $request->name;
        $product_unit->status = $request->status;
        $product_unit->user_id = Auth::id();
        $product_unit->save();

        return redirect()->route('product_units')->with('message', 'Product unit add successfully.');
    }

    public function edit(ProductUnit $product_unit)
    {
        $this->clientCheck($product_unit);
        return view('product.product_unit.edit', compact('product_unit'));
    }

    public function update(ProductUnit $product_unit, Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->route('product_units')->with('message', 'Product unit edit successfully.');
    }

    public function delete(ProductUnit $product_unit)
    {
        $this->clientCheck($product_unit);
        $product_unit->delete();
        return redirect()->route('product_units')->with('message', 'Product unit delete successfully.');
    }
}
