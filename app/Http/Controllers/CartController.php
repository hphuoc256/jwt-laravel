<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{
    public function listCart()
    {
        $data = session()->get('cart');

        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }
    public function addCart($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id]['quantily'] = $cart[$id]['quantily'] + 1;
        }
        else {
            $cart[$id] = [
                "name" => $product['name'],
                "price" => $product['price'],
                "quantily" => 1,
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['code' => 200,'message' => 'Success','data' => session()->get('cart')]);
    }


    




    protected function error(){
        return response()->json([
            'code' => 403,
            'message' => 'Error',
        ]);
    }
}
