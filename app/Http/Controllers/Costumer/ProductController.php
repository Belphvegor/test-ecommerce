<?php

namespace App\Http\Controllers\Costumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('costumer.costumerindex');
    }

    public function list()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            "status" => true,
            "html" => view('costumer.costumerproduklist', compact('products'))->render()
        ], 200);
    }

    public function detail(Request $request)
    {
        $product = Product::select('image','desc')->where('id', $request->id)->first();

        return response()->json([
            "status" => true,
            "html" => view('costumer.costumerprodukdetail', compact('product'))->render()
        ], 200);
    }
}
