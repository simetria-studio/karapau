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
                        <h1>PERFIL</h1>
                    </div>
                </div>
                <div class="text-center">
                    <div class="botao-voltar">
                        <a href="{{ route('store.index') }}"> <button class="btn btn-voltar btn-lg">VOLTAR</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="top_1 mb-5">
            <div class="container">
                <div class="center">
                    <div class="titulo">
                        <h2>INFORMAÇÔES</h2>
                    </div>
                    <div class="numero-pedido">
                        <h3>{{ auth()->user()->name }}</h3>
                    </div>
                    <div class="numero-pedido">
                        <h3>{{ auth()->user()->email }}</h3>
                    </div>
                    <div class="aguardando-pagamento text-uppercase">
                        <h1>
                        </h1>
                    </div>
                </div>
                <div class="text-center">
                    <div class="botao-ver-detalhes">
                        <a href="{{ route('store.user.edit', $user->id) }}"> <button class="btn btn-detalhes btn-lg">ALTERAR</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="top_1 mb-5">
            <div class="container">
                <div class="center">
                    <div class="titulo">
                        <h2>ENDEREÇO</h2>
                    </div>
                    <div class="numero-pedido">
                        <h3>{{ $adress->morada }}</h3>
                    </div>
                    <div class="numero-pedido">
                        <h3>{{ $adress->distrito }}</h3>
                    </div>
                    <div class="aguardando-pagamento text-uppercase">
                        <h1>
                        </h1>
                    </div>
                </div>
                <div class="text-center">
                    <div class="botao-ver-detalhes">
                        <a href="{{ route('store.adress') }}"> <button class="btn btn-detalhes btn-lg">ALTERAR</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
