<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function addForm()
    {
        return view('product.add');
    }

    public function add(Request $request)
    {
        $product = new Product();

        if($request->name == null || $request->price == null || $request->description == null || $request -> avaliables == null){
            return redirect() -> back() -> withErrors(['Preencha os campos!']);
        }

        $product -> name = $request -> name;
        $product -> price = $request -> price;
        $product -> avaliables = $request -> avaliables;
        $product -> description = $request -> description;

        $product -> save();

        return redirect() -> route('users.home');

    }

    public function removeOne(Request $request)
    {
        $id_product = $request -> id;

        DB::table('products')->where('id', $request->id)->update(['avaliables' => $request -> avaliables - 1]);

        if($request->avaliables < 2){
            $this->destroy($id_product);
        }

        return redirect() -> route('users.home');
    }

    public function destroy($id_product)
    {
        $product = Product::where('id', '=', $id_product);

        $product -> delete();
    }
}
