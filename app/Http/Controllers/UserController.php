<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(){
        return view('template.page-login');
    }
    public function auth(Request $request){
        $validasi = $request->validate([
            'email' => ['email','required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validasi)) {
            return redirect('/index');
        }
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function user(){
        return view('template.user-table');
    }

    public function add(){
        return view('template.form-user');
    }
    
    public function create(Request $request)
    {
        // $validasi = $request->validate([
        //     'name' => ['required','min:3'],
        //     'email' => ['required'],
        //     'password' => ['required']
        // ]);

        $validasi = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($validasi) {
            Session::flash('pesan','Data Berhasil Di Tambahkan');
        }else {
            Session::flash('pesan','Data Gagal Di Tambahkan');
        }
        return redirect('/user');
    }

    public function show_user(){
        $data['user'] = User::all();
        $data['count'] = $data['user']->count();
        return view('template.user-table',$data);
    }

    public function edit(Request $request)
    {
        $data['edit'] = User::find($request->id);
        return view('/user',$data);
    }

    public function update(Request $request)
    {
        // $validasi = $request->validate([
        //     'name' => ['required','min:3'],
        //     'email' => ['required'],
        //     'password' => ['required']
        // ]);

        $user = User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if ($user) {
            Session::flash('pesan','Data Berhasil Di Ubah');
        }else {
            Session::flash('pesan','Data Gagal Di Ubah');
        }
        return redirect('/user');
    }
    public function delete(Request $request)
    {
        User::where('id',$request->id)->delete();
        return redirect('/user');
    }
}
