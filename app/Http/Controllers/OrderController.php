<?php

namespace App\Http\Controllers;

use App\Libraries\GenerateRandomString;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Costumer;
use App\Models\Product;
use App\Models\Order;
use Validator, File;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }

    function list() {
        $orders = Order::with('costumer')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            "status" => true,
            "html" => view('order.list', compact('orders'))->render(),
        ], 200);
    }


    public function detail(Request $request)
    {
        $struk = Order::with('details')->find($request->id);
        $total = OrderDetail::where('order_id', $request->id)->sum('harga');

        return response()->json([
            "status" => true,
            "html" => view('order.struk', compact('struk','total'))->render(),
        ], 200);
    }
}
