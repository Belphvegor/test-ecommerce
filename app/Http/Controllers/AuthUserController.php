<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Costumer;


class AuthUserController extends Controller
{
    public function login() {
        return view('authuser/login');
    }

    public function getLogin(LoginRequest $request) {
        $attemptLogin = Auth::attempt(['email' => $request->username, 'password' => $request->password]);
        if ($attemptLogin) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                session(['id' => $user->id, 'username' => $user->name, 'email' => $user->email, 'level' => $user->level]);
                return Redirect::to('admin/product');
            } else if ($user->level == 'costumer') {
                session(['id' => $user->id, 'username' => $user->name, 'email' => $user->email, 'level' => $user->level]);
                return Redirect::to('costumer/product');
            }
        } else {
            Session::flash('Message', 'username atau password salah');
            return Redirect::to('login')->withErrors([
                'email'=> trans('auth.failed')
            ])->withInput();
        }
    }

    public function logout() {
        session()->flush();
        Auth::logout();
        return Redirect::to('/login');
    }

    public function register()
    {
        return view('authuser/register');
    }

    public function getregister(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
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
            $user = new User();
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = 'costumer';
            $user->save();

            $product = new Costumer();
            $product->nama = $request->nama;
            $product->user_id = $user->id;
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
                "message" => 'Proses Registrasi Berhasil berhasil !',
            ], 200);
        }

    }
}
