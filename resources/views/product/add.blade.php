@extends('layouts.blank')

@section('content')

    <h2>Adicionar produtos</h2>

    @if($errors->all())
        @foreach($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
        @endforeach
    @endif

    <form action="{{ route('products.add') }}" method="POST">
        @csrf
        <p>
            <label>Nome do produto:</label>
            <input type="text" name="name">
        </p>

        <p>
            <label>Preço do produto:</label>
            <input type="number" name="price">
        </p>

        <p>
            <label>Unidades disponíveis:</label>
            <input type="number" min="1" max="10" name="avaliables">
        </p>

        <label>Descrição:</label>
        <p>
            <textarea name="description" cols="30" rows="10"></textarea>
        </p>

        <p>
            <input type="submit" value="Adicionar produto">
        </p>
    </form>

    <a href="{{ route('users.home') }}">Voltar</a>

@endsection
