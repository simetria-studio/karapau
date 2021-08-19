@extends('layouts.front-app.store.home')

@section('content')
    <div class="header-top">
    </div>
    <div class="headertop1"></div>
    <div class="container">

        <div class="buyer-number">
            <div class="comprador">
                <p>NÚMERO DE <br> COMPRADOR</p>
            </div>
            <div class="numero">
                <p>1000{{ auth()->user()->id }}</p>
            </div>
        </div>

        <div class="title">
            <p>Olá, {{ auth()->user()->name }}</p>
            <a href="{{ route('user.logout') }}">SAIR</a>
        </div>
        <div class="top mt-3">
            <div class="container">
                <div class="center">
                    <div class="titulo">
                        <h1>INFORMAÇÕES</h1>
                    </div>
                </div>
                <div class="text-center">
                    <div class="botao-voltar">
                        <a href="{{ route('store.user.edit-ind', auth()->user()->id) }}"> <button class="btn btn-voltar btn-lg">VOLTAR</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="info mb-5">
            <form action="{{ route('store.user.update', $user->id) }}" method="post">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="container">
                    <div class="center py-4">
                        <div class="form-group my-2">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" name="name" class="form-control Input-tex" value="{{ $user->name }}">
                        </div>
                        <div class="form-group my-2">
                            <label for="exampleInputEmail1">Telemóvel</label>
                            <input type="text" name="telemovel" class="form-control Input-tex"
                                value="{{ $user->telemovel }}">
                        </div>
                        <div class="form-group my-2">
                            <label for="exampleInputEmail1">Senha</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group my-2">
                            <label for="exampleInputEmail1">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="botao-ver-detalhes">
                            <a href=""> <button class="btn btn-detalhes btn-lg">ALTERAR</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
