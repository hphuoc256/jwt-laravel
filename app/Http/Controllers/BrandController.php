<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function listBrand()
    {
        $data = Brand::all();
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }
}
