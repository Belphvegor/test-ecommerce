<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costumer;
use Validator, File;

class CostumerController extends Controller
{
    public function index()
    {
        return view('costumer.index');
    }

    public function form()
    {
        return response()->json([
            "status" => true,
            "html" => view('costumer.form')->render()
        ], 200);
    }

    public function list()
    {
        $products = Costumer::orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            "status" => true,
            "html" => view('costumer.list', compact('products'))->render()
        ], 200);
    }

    public function save(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama'      => 'required',
            'tgl_lahir' => 'required',
            'no_hp'     => 'required|max:15',
            'jenkel'    => 'required',
            'email'     => 'required|unique:costumers,email',
            'alamat'    => 'required',
            'image'     => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.image'       => 'file yang di upload harus file image !',
            'image.mimes'       => 'format image tidak diketahui (jpeg,png,jpg) !',
            'image.max'         => 'size image melebihi batas 2 MB !',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()->first()
            ], 200);
        } else {
            $product = new Costumer();
            $product->nama = $request->nama;
            $product->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
            $product->no_hp = $request->no_hp;
            $product->jenkel = $request->jenkel;
            $product->email = $request->email;
            $product->alamat = $request->alamat;

            $file = $request->file('image');
            $nama_file = time()."_".$file->getClientOriginalName();
            $storage = 'assets/images/costumer';
            $file->move($storage,$nama_file);
            $product->image = $nama_file;
            $product->save();

            return response()->json([
                "status" => true,
                "message" => 'costumer berhasil di buat !',
            ], 200);
        }

    }

    public function detail(Request $request)
    {
        $product = Costumer::select('tgl_lahir','jenkel','alamat','image')->where('id', $request->id)->first();

        return response()->json([
            "status" => true,
            "html" => view('costumer.detail', compact('product'))->render()
        ], 200);
    }

    public function edit(Request $request)
    {
        $product = Costumer::findOrFail($request->id);

        return response()->json([
            "status" => true,
            "html" => view('costumer.edit', compact('product'))->render()
        ], 200);
    }

    public function update(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama'      => 'required',
            'tgl_lahir' => 'required',
            'no_hp'     => 'required|max:15',
            'jenkel'    => 'required',
            'email'     => 'required|unique:costumers,email,'.$request->id,
            'alamat'    => 'required',
            'image'     => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.image'       => 'file yang di upload harus file image !',
            'image.mimes'       => 'format image tidak diketahui (jpeg,png,jpg) !',
            'image.max'         => 'size image melebihi batas 2 MB !',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()->first()
            ], 200);
        } else {
            $product = Costumer::findOrFail($request->id);
            $product->nama = $request->nama;
            $product->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
            $product->no_hp = $request->no_hp;
            $product->jenkel = $request->jenkel;
            $product->email = $request->email;
            $product->alamat = $request->alamat;

            if ($request->hasFile('image')) {
                File::delete('assets/images/costumer/' . $product->image);
                $file = $request->file('image');
                $nama_file = time()."_".$file->getClientOriginalName();
                $storage = 'assets/images/costumer';
                $file->move($storage,$nama_file);
                $product->image = $nama_file;
            }

            $product->save();

            return response()->json([
                "status" => true,
                "message" => 'costumer berhasil di update !',
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = Costumer::findOrFail($request->id_data);
            File::delete('assets/images/costumer/' . $data->image);

            $data->delete();

            return response()->json([
                "status" => true,
                "message" => 'costumer berhasil di hapus !',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => 'costumer gagal di hapus !',
            ], 200);
        }
    }
}
