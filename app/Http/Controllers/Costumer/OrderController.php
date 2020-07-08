<?php

namespace App\Http\Controllers\Costumer;

use App\Libraries\GenerateRandomString;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Costumer;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Validator, Auth;

class OrderController extends Controller
{
    public function form()
    {
        $data['products'] = Product::all();
        $data['costumers'] = Costumer::all();

        return response()->json([
            "status" => true,
            "html" => view('order.form', $data)->render(),
        ], 200);
    }

    public function save(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'products'  => 'required',
            'jumlah'    => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()->first()
            ], 200);
        } else {
            $products = $request->products;
            $jumlah = $request->jumlah;

            for ($i=0; $i < count($products); $i++) {
                
                if ($i == 0) {
                    $order = new Order();
                    $order->kode_transaksi = 'KT_'.GenerateRandomString::kodeTransaksi();
                    $order->costumer_id = Auth::user()->costumer->id;
                    $order->save();
                }

                $produk = Product::select('harga')->where('id', $products[$i])->first();

                $stock_product = Product::find($products[$i]);

                if ($stock_product->stok < $jumlah[$i]) {
                    continue;
                } else {
                    // update jumlah stok
                    $stock_product->stok = $stock_product->stok - $jumlah[$i];
                    $stock_product->save();

                    Order::find($order->id)->details()->attach($products[$i], [
                        'jumlah' => $jumlah[$i],
                        'harga' => $jumlah[$i] * $produk->harga,
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now()
                    ]);
                }
            }

            return response()->json([
                "status" => true,
                "message" => 'Success !',
            ], 200);
        }
    }
}
