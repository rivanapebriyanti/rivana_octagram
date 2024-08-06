<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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
    
    public function create(Request $request)
    {
        $validasi = Category::create([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
        if ($validasi) {
            Session::flash('pesan','Data Berhasil Di Tambahkan');
        }else {
            Session::flash('pesan','Data Gagal Di Tambahkan');
        }
        return redirect('/category');
    }

    // public function search(Request $request)
    // {
    //     $data['categori'] = Category::where('name','LIKE','%'.$request->cari.'%')->get();
    //     $data['count'] = $data['categori']->count();
    //     return redirect('/category',$data);
    // }

    // public function search(Request $request){
    //     $search = $request->input('search');
    //     $query = Category::query();

    //     if ($search) {
    //         $query->where('name', 'LIKE', '%'.$search.'%')->orWhere('is_publish', 'LIKE', '%'.$search.'%');
    //     }

    //     $data['categori'] = $query->paginate(10)->appends(['search' => $search]);

    //     return redirect('/category');
    // }

    public function edit(Request $request)
    {
        $data['edit'] = Category::find($request->id);
        return view('/category',$data);
    }

    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
        if ($category) {
            # code...
            Session::flash('pesan','Data Berhasil Di Ubah');
        }else {
            Session::flash('pesan','Data Gagal Di Ubah');
        }
        return redirect('/category');
    }

    public function delete(Request $request)
    {
        Category::where('id',$request->id)->delete();
        return redirect('/category');
    }
}
