<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ImageProduct;

class ProductController extends Controller
{
    public function listProduct()
    {
        $data = Product::with('image_product')->get();
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function infoProduct($id)
    {
        // $data = Product::find($id)->with('comment')->get();
        $view = Product::where('id',$id)->with('comment')->with('image_product')->first();
        // $image = Product::where('id',$id)->with('image_product')->get();
        if($view) {
            $view->views = $view->views + 1;
            $view->save();
            return response()->json(['code' => 200,'message' => 'Success','data' => $view]);
        }
        else {
            return $this->error();
        }
        
    }

    public function hotProduct()
    {
        $data = Product::where('hot', 1)->get();
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function sellProduct()
    {
        $data = Product::orderBy('sellprice','DESC')->take(5)->get();
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function newProduct()
    {
        $data = Product::orderBy('created_at','DESC')->get();
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function addProduct(Request $request)
    {
        $data = new Product();
        $data->name = $request->name;
        $data->price = $request->price;
        $data->sellprice = $request->sellprice;
        $data->content = $request->content;
        $data->status = $request->status;
        $data->quantily = $request->quantily;
        $data->size = $request->size;
        $data->color = $request->color;
        $data->hot = $request->hot;
        $data->image = $request->image;
        $data->category_id = $request->category_id;
        $data->brand_id = $request->brand_id;
        if($data->save()) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function getProduct($id)
    {
        $data = Product::find($id);
        if($data) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $data = Product::find($id);
        if(! $data) {
            return $this->error();
        }
        else {
            $data->name = $request->name;
            $data->price = $request->price;
            $data->sellprice = $request->sellprice;
            $data->content = $request->content;
            $data->status = $request->status;
            $data->quantily = $request->quantily;
            $data->size = $request->size;
            $data->color = $request->color;
            $data->hot = $request->hot;
            $data->image = $request->image;
            $data->category_id = $request->category_id;
            $data->brand_id = $request->brand_id;
            if($data->save()) {
                return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
            }
            else {
                return $this->error();
            }
        }
    }

    public function deleteProduct($id)
    {
        $data = Product::find($id);
        if(!$data) {
            return $this->error();
        }
        $data->delete();
        return response()->json(['code' => 200,'message' => 'Success']);
    }

    public function addImage(Request $request)
    {
        $data = new ImageProduct();
        // if($file = $request->hasFile('image')) {           
        //     $file = $request->file('image');          
        //     $fileName = $file->getClientOriginalName() ;
        //     $destinationPath = public_path().'/public/image/' ;
        //     $file->move($destinationPath,$fileName);
        //     $data->image = asset('/')."public/image/".$fileName;       
        // }
        $data->image = $request->image;
        $data->status = $request->status;
        $data->level = $request->level;
        $data->product_id = $request->product_id;
        if($data->save()) {
            return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
        }
        else {
            return $this->error();
        }
    }



    protected function error(){
        return response()->json([
            'code' => 403,
            'message' => 'Error',
        ]);
    }
}
