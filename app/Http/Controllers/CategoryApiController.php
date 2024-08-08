<?php

namespace App\Http\Controllers;

use App\Jobs\Notification;
use App\Models\Category;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'unique:categories'],
            'is_publish' => 'required'
        ]);

        if ($validator->fails ()) {
            return response()->json([
                'status' => 'Invalid',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->is_publish = $request->is_publish;
        $category->save();

        return response()->json([
            'status' => 'Success',
            'category' => $category
        ], 200);
        $user = Auth::guard('api')->user();

        $details = [
            'email' => $user->email,
            'judul' => 'Notifikasi dari laravel',
            'isi' => 'Kategori telah di tambahkan'
        ];
        // Notification::dispatch($details);
    }

    public function get(Request $request)
    {
        if ($request->search) {
            $data['category'] = Category::where('name','LIKE','%'.$request->search.'%')->get();
        }else{
            $data['category'] = Category::get();
        }
        $data['count'] = $data['category']->count();
        return response()->json([
            'status' => 'Success',
            'lenght' => $data['count'],
            'categories' => $data['category']
        ], 200);
        // return view('home',$data);
    }

    public function edit(Request $request)
    {
        $data['edit'] = Category::find($request->id);
        return view('edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:categories'],
            'is_publish'=> ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Invalid',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::where('id', $id)->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
        return response()->json([
            'status' => 'Success',
            'category' => $category
        ], 200);
        $user = Auth::guard('api')->user();

        $details = [
            'email' => $user->email,
            'judul' => 'Notifikasi dari laravel',
            'isi' => 'Kategori telah di edit'
        ];
        // Notification::dispatch($details);
    }

    public function delete($id)
    {
        Category::where('id',$id)->delete();
        // return redirect('home');
        
        return response()->json([
            'status' => 'Success',
            'message' => 'Category deleted'
        ], 200);
    }
  
}
