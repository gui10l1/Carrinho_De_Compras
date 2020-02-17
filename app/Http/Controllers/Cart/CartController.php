<?php

namespace App\Http\Controllers\Cart;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Product\ProductController;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = new Cart();

        $cart->product_name = $request->name;
        $cart->product_price = $request->price;
        $cart->product_description = $request->description;
        $cart->id_product = $request->id;
        $cart->id_user = Session::get('id');

        $cart -> save();

        (new \App\Http\Controllers\Product\ProductController)->removeOne($request);

        return redirect()->route('products.removeOne');
    }

    public function removeOne(Request $request)
    {
        $id = $request -> id;

        if($request->avaliables <= 0){
            $this->destroy($id);
        }

        return redirect() -> route('users.home');
    }

    public function destroy($id)
    {
        $cart = Cart::where('id', '=', $id);

        $cart -> delete();
    }
}
