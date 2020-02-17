@extends('layouts.blank')

@section('content')

    <h2>Registre-se!</h2>

    @if($errors->all())
        @foreach($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
        @endforeach
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <p>
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Ex: José Silva">
        </p>

        <p>
            <label>Email</label>
            <input type="email" name="email" placeholder="@">
        </p>

        <p>
            <label>Senha</label>
            <input type="password" name="senha" placeholder="Ex: 12345678">
        </p>

        <p>
            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </p>
    </form>

    <a href="{{ route('users.home') }}">Voltar</a>

@endsection
