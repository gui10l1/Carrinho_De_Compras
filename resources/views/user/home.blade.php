@extends('layouts.blank')

@section('content')

    <h2>Produtos</h2>

    @if($products->all())
        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Disponíveis</th>
                <th>Descrição</th>
                <th>Adiconar ao carrinho</th>
            </tr>

            @foreach($products as $product)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <tr>
                        <input type="hidden" value="{{ $product -> id }}" name="id">
                        <td><input type="text" value="{{ $product -> name }}" name="name"></td>
                        <td><input type="text" value="{{ $product -> price }}" name="price"></td>
                        <td><input type="text" value="{{ $product -> avaliables }}" name="avaliables"></td>
                        <td><textarea name="description" cols="30" rows="1">{{ $product -> description }}</textarea></td>
                        <td><input type="submit" value="Adicionar ao carrinho"></td>
                    </tr>
                </form>
            @endforeach
        </table>
    @else
        <h3>Estoque vazio!</h3>
    @endif

    <br>

    @if($carts->all())
        <h2>Carrinho de compras</h2>
        @foreach($carts->all() as $cart)
            <table border="1">
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Comprar</th>
                </tr>

                <form action="{{ route('order.add') }}" method="POST">
                    @csrf
                    <tr>
                        <input type="hidden" value="{{ $cart -> id }}" name="id">
                        <input type="hidden" value="{{ $cart -> id_product }}" name="id_product">
                        <td><input disabled value="{{ $cart -> product_name }}"></td>
                        <td><input disabled value="{{ $cart -> product_price }}"></td>
                        <td><input disabled value="{{ $cart -> product_description }}"></td>
                        <td><input type="submit" value="Comprar"></td>
                    </tr>
                </form>
            </table>
        @endforeach
    @else
        <h2>Carrinho de compras vazio!</h2>
    @endif

    <a href="{{ route('users.logout') }}">Logout</a>

    @if(\Illuminate\Support\Facades\Session::has('id_adm'))
        <a href="{{ route('products.addForm') }}">Painel de administração de produtos</a>
    @endif

@endsection
