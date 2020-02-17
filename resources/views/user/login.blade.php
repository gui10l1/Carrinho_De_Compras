@extends('layouts.blank')

@section('content')

    <h2>Faça login para continuar</h2>

    @if($errors  -> all())
        @foreach($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
        @endforeach
    @endif

    <form action="{{ route('users.login') }}" method="POST">
        @csrf
        <p>
            <label>Email</label>
            <input type="email" name="email" placeholder="Insira seu email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha" placeholder="Insira sua senha">
        </p>
        <p>
            <input type="submit" value="Entrar">
        </p>
    </form>

    <a href="{{ route('users.showRegister') }}">Não tem uma conta? Faça seu cadastro!</a>

@endsection
