<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.product.all');
    }

    public function add()
    {
        $product_categories = ProductCategory::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_brands = ProductBrand::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_units = ProductUnit::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_colors = ProductColor::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_sizes = ProductSize::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $last_code = Product::orderBy('id', 'desc')->where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $code = str_pad($last_code + 1, 5, 0, STR_PAD_LEFT);

        return view('product.product.add', compact(
            'product_categories',
            'product_brands',
            'product_units',
            'product_colors',
            'product_sizes',
            'code'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_category_id' => 'required',
            'product_unit_id' => 'required',
            'product_color_id' => 'required',
            'product_size_id' => 'required',
            'code' => 'nullable|string|max:255',
            'buy_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'whole_sale_price' => 'required|numeric',
            'tax' => 'required|numeric',
            'vat' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'status' => 'required'
        ]);
        $exist = Product::where(['name' => $request->name, 'product_color_id' => $request->product_color_id, 'product_size_id' => $request->product_size_id])->first();
        if ($exist) {
            return redirect()->back()->withInput()->with('error', 'This product name already exist with this color & size combination.');
        }
        $last_code = Product::orderBy('id', 'desc')->where('client_id', Auth::user()->client_id)->withTrashed()->count();

        $data = $request->all();
        $data['code'] = str_pad($last_code + 1, 5, 0, STR_PAD_LEFT);
        $data['client_id'] = Auth::user()->client_id;
        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        return redirect()->route('products')->with('message', 'Product add successfully.');
    }

    public function storeProduct(Request $request)
    {
        dd('Remove Code for demo');

        return response()->json(['success' => true, 'message' => 'Product has been added.']);
    }

    public function edit(Product $product)
    {
        $this->clientCheck($product);
        $product_categories = ProductCategory::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_brands = ProductBrand::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_units = ProductUnit::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_colors = ProductColor::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_sizes = ProductSize::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('product.product.edit', compact(
            'product',
            'product_categories',
            'product_brands',
            'product_units',
            'product_colors',
            'product_sizes'
        ));
    }

    public function update(Request $request, Product $product)
    {
        dd('Remove Code for demo');

        return redirect()->route('products')->with('message', 'Product edit successfully.');
    }

    public function delete(Product $product)
    {
        $this->clientCheck($product);
        $product->delete();
        return redirect()->route('products')->with('message', 'Product delete successfully.');
    }

    public function barcodePrint(Request $request)
    {
        $product = Product::find($request->product_id);
        $quantity = $request->quantity;
        return view('product.generate_code.barcode_print', compact('product', 'quantity'));
    }
    public function qrcodePrint(Request $request)
    {
        $product = Product::find($request->product_id);
        $quantity = $request->quantity;
        return view('product.generate_code.qrcode_print', compact('product', 'quantity'));
    }


    public function productDatatable()
    {
        $query = Product::with('productColor', 'productSize', 'productCategory', 'productUnit')->where('client_id', Auth::user()->client_id);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('product_color', function (Product $product) {
                return $product->productColor->name ?? '';
            })
            ->addColumn('product_size', function (Product $product) {
                return $product->productSize->name ?? '';
            })
            ->addColumn('product_category', function (Product $product) {
                return $product->productCategory->name ?? '';
            })
            ->addColumn('product_unit', function (Product $product) {
                return $product->productUnit->name ?? '';
            })
            ->editColumn('status', function (Product $product) {
                if ($product->status == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function (Product $product) {
                $btn = '';
                if (Auth::user()->can('product_edit')) {
                    $btn .= ' <a class="btn btn-info btn-sm" href="' . route('product_edit', ['product' => $product->id]) . '">Edit</a> ';
                }
                if (Auth::user()->can('product_delete')) {
                    $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('product_delete', ['product' => $product->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
