<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{
    public function listCategory()
    {
        $data = Category::with('brand')->get();
        if($data) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
        
    }

    public function addCategory(Request $request)
    {
        $data = new Category();
        $data->name = $request->name;
        $data->content = $request->content;
        $data->status = $request->status;       
        if($data->save()) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function getCategory($id)
    {
        // dd($request->all());
        $data = Category::find($id);
        if($data) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $data = Category::find($id);
        if(! $data) {
            return $this->error();
        }
        else {
            $data->name = $request->name;
            $data->content = $request->content;
            $data->status = $request->status;
            if($data->save()) {
                return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
            }
            else {
                return $this->error();
            }
        }
    }
    public function deleteCategory($id)
    {
        $data = Category::find($id);
        if(!$data) {
            return $this->error();
        }
        $data->delete();
        return response()->json(['code' => 200,'message' => 'Success']);
    }


    protected function error(){
        return response()->json([
            'code' => 403,
            'message' => 'Error',
        ]);
    }
}
