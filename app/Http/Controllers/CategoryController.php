<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationEmailJob;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        return view('template.index');
    }

    public function category(){
        $data['categori'] = category::all();
        $data['count'] = $data['categori']->count();
        return view('template.category-table',$data);
    }

    public function search(Request $request){
        $search = $request->input('search');
        $query = Category::query();
        $data['category'] = Category::all();

        if ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%')->orWhere('is_publish', 'LIKE', '%'.$search.'%');
        }
        $data['category']=$query->paginate(10)->appends(['search'=>$search]);
        
        return view('/category', $data);
    }

    public function create(Request $request)
    {
        $validasi = Category::create([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
        if ($validasi) {
            Session::flash('pesan','Data Berhasil di Tambahkan');
        }else {
            Session::flash('pesan','Data Gagal di Tambahkan');
        }
        SendNotificationEmailJob::dispatch($validasi);
        return redirect('/category');
    }

    public function delete(Request $request){
        $category = Category::find($request->id);
        $delete = Category::where('id', $request->id)->delete();

        return redirect('/category');
    }
    
    public function edit(Request $request){
        $data['category'] = Category::find($request->id);
        return view('/category', $data);
    }
    public function update(Request $request){
        $update = Category::where('id', $request->id)->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish
        ]);

        if ($update) {
            Session::flash('pesan','Data Berhasil Di Ubah');
        }else {
            Session::flash('pesan','Data Gagal Di Ubah');
        }
        return redirect('/category');
    }
}
