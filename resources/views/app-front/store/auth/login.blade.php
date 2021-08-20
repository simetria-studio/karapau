@extends('layouts.front-app.store.auth')

@section('content')
    <div class="top">
        <div class="logo">
            <img src="{{ url('front-app/store/assets/img/logo-img.svg') }}" alt="">
        </div>
    </div>
    <div class="container">
        @if (Session::has('errors'))
            <div class="alert alert-danger">
                @foreach (Session::get('errors') as $error)
                    <br />
                @endforeach
            </div>
        @endif
        <div class="mt-5 login">
            <form id="form-login" action="{{ route('store.login.post') }}" method="post">
                @csrf
                <div class="text-center">
                    <div class="input-container my-4">
                        <input id="name" class="input" name="email" type="email" pattern=".+" required />
                        <label class="label" for="name">E-mail:</label>
                    </div>

                    <div class="input-container my-5">
                        <input id="password" class="input" name="password" type="password" pattern=".+" required />
                        <label class="label" for="password">Senha</label>
                    </div>
                    <div>
                        <button id="btn-login" class="btn btn-primary" type="button">ENTRAR</button>
                    </div>
            </form>
            <div class="text-register text-center my-5">
                <a href="{{ route('comprador.create') }}">Não tem registo? </a>
            </div>
        </div>
    </div>
@endsection
