<?php

namespace App\Http\Controllers\Order;

use App\Cart;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $order = new Order();

        $order->id_product = $request->id_product;
        $order->id_user = Session::get('id');

        $order -> save();

        (new \App\Http\Controllers\Order\OrderController)->destroy($request);

        return redirect()->route('cart.removeOne');
    }

    public function destroy(Request $request)
    {
        $id = $request -> id;

        $cart = Cart::where('id', '=', $id);

        $cart -> delete();

        return redirect() -> route('users.home');
    }
}
