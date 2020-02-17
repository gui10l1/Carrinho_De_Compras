<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function home()
    {
        if(Auth::check()){
            $products = Product::all();
            $carts = Cart::where('id_user', Session::get('id'))->get();
            return view('user.home', [
                'products' => $products,
                'carts' => $carts
            ]);
        }

        return view('user.login');
    }

    public function login(Request $request)
    {
        if($request -> email == null || $request -> senha == null){
            return redirect() -> back() -> withErrors(['Preencha os campos!']);
        }

        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return redirect() -> back() -> withErrors(['Email inválido!']);
        }

        $credentials = [
            'email' => $request -> email,
            'password' => $request -> senha
        ];

        if(Auth::attempt($credentials)){
            $id = User::where('email', '=', $request->email)->first()->id;
            $id_adm = User::where('email', '=', $request->email)->first()->id_adm;

            Session::put(['id' => $id, 'id_adm' => $id_adm]);

            return redirect() -> route('users.home');
        }

        return redirect() -> back() -> withErrors(['Email/senha incorretos!']);
    }

    public function register(Request $request)
    {
        $requisiçao = $request;


        if($request->email == null || $request->senha == null || $request->nome == null){
            return redirect() -> back() -> withErrors(['Preencha os campos!']);
        }

        $user = new User();

        $user -> email = $request -> email;
        $user -> password = Hash::make($request -> senha);
        $user -> name = $request -> nome;

        $user -> save();

        $credentials = [
            'email' => $request -> email,
            'password' => $request -> senha
        ];

        if(Auth::attempt($credentials)){

            $id = User::where('email', '=', $request->email)->first()->id;
            $id_adm = User::where('email', '=', $request->email)->first()->id_adm;

            Session::put(['id' => $id, 'id_adm' => $id_adm]);

            return redirect() -> route('users.home');
        }

        return redirect() -> back() -> withErrors(['Não foi possível efetuar login diretamente!']);
    }

    public function showRegister()
    {
        return view('user.register');
    }

    public function logout()
    {
        Auth::logout();

        return redirect() -> route('users.home');
    }
}
