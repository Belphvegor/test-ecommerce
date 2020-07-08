<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator, File;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function form()
    {
        return response()->json([
            "status" => true,
            "html" => view('product.form')->render()
        ], 200);
    }

    public function list()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            "status" => true,
            "html" => view('product.list', compact('products'))->render()
        ], 200);
    }

    public function save(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama'  => 'required',
            'harga' => 'required',
            'stok'  => 'required',
            'desc'  => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.image'       => 'file yang di upload harus file image !',
            'image.mimes'       => 'format image tidak diketahui (jpeg,png,jpg) !',
            'image.max'         => 'size image melebihi batas 2 MB !',
            'image.required'    => 'image kosong !',
            'nama.required'     => 'nama kosong !',
            'harga.required'    => 'harga kosong !',
            'stok.required'     => 'stok kosong !',
            'desc.required'     => 'desc kosong !'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()->first()
            ], 200);
        } else {
            $product = new Product();
            $product->nama = $request->nama;
            $product->harga = $request->harga;
            $product->stok = $request->stok;
            $product->desc = $request->desc;

            $file = $request->file('image');
            $nama_file = time()."_".$file->getClientOriginalName();
            $storage = 'assets/images/product';
            $file->move($storage,$nama_file);
            $product->image = $nama_file;
            $product->save();

            return response()->json([
                "status" => true,
                "message" => 'Product berhasil di buat !',
            ], 200);
        }

    }

    public function detail(Request $request)
    {
        $product = Product::select('image','desc')->where('id', $request->id)->first();

        return response()->json([
            "status" => true,
            "html" => view('product.detail', compact('product'))->render()
        ], 200);
    }

    public function edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        return response()->json([
            "status" => true,
            "html" => view('product.edit', compact('product'))->render()
        ], 200);
    }

    public function update(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama'  => 'required',
            'id'    => 'required',
            'harga' => 'required',
            'stok'  => 'required',
            'desc'  => 'required',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.image'       => 'file yang di upload harus file image !',
            'image.mimes'       => 'format image tidak diketahui (jpeg,png,jpg) !',
            'image.max'         => 'size image melebihi batas 2 MB !'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()->first()
            ], 200);
        } else {
            $product = Product::findOrFail($request->id);
            $product->nama = $request->nama;
            $product->harga = $request->harga;
            $product->stok = $request->stok;
            $product->desc = $request->desc;

            if ($request->hasFile('image')) {
                File::delete('assets/images/product/' . $product->image);
                $file = $request->file('image');
                $nama_file = time()."_".$file->getClientOriginalName();
                $storage = 'assets/images/product';
                $file->move($storage,$nama_file);
                $product->image = $nama_file;
            }

            $product->save();

            return response()->json([
                "status" => true,
                "message" => 'Product berhasil di update !',
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = Product::findOrFail($request->id_data);
            File::delete('assets/images/product/' . $data->image);

            $data->delete();

            return response()->json([
                "status" => true,
                "message" => 'Product berhasil di hapus !',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => 'Product gagal di hapus !',
            ], 200);
        }
    }
}
