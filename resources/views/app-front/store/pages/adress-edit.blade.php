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
                        <h1>ENDEREÇOS</h1>
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
            <form action="{{ route('store.adress.save') }}" method="post">
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
                        <div class="form-group">

                            <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">

                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Código Postal</label>
                                <input id="cep" type="text" class="form-control" name="codigo_postal">

                            </div>
                            <div style="margin-top: 26px;" class="col-6">
                                <button id="buscar" type="button" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Morada</label>
                            <input type="text" class="form-control" id="morada" name="morada">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Numero da Porta</label>
                            <input type="text" class="form-control" id="porta" name="porta" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Região</label>
                            <input type="text" class="form-control" id="regiao" name="regiao">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Distrito</label>
                            <input type="text" class="form-control" id="distrito" name="distrito" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Concelho</label>
                            <input type="text" class="form-control" id="conselho" name="conselho" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Freguesia</label>
                            <input type="text" class="form-control" id="freguesia" name="freguesia" id="exampleInputPassword1">
                        </div>

                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
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
