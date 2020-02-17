<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('user.home');
//});

//ROTAS USUÁRIO
Route::get('/', 'User\\UserController@home')->name('users.home');
Route::get('/register', 'User\\UserController@showRegister')->name('users.showRegister');
Route::get('/logout', 'User\\UserController@logout')->name('users.logout');


Route::post('/login', 'User\\UserController@login')->name('users.login');
Route::post('/register/store', 'User\\UserController@register')->name('users.store');

//ROTAS PRODUTO
Route::get('/product/add', 'Product\\ProductController@addForm')->name('products.addForm');
Route::get('/product/removeone', 'Product\\ProductController@removeOne')->name('products.removeOne');

Route::post('/product/add', 'Product\\ProductController@add')->name('products.add');

//ROTAS CARRINHO
Route::post('/carrinho/add', 'Cart\\CartController@add')->name('cart.add');
Route::get('/carrinho/add', 'Cart\\CartController@removeOne')->name('cart.removeOne');

//ROTAS PEDIDOS
Route::post('/pedido/add', 'Order\\OrderController@add')->name('order.add');

