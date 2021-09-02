@extends('layouts.app-pescador')

@section('content')
<div class="header">
      <div class="container">
            <div class="py-4 text-center">
                  <img class="img-fluid " src="{{ url('app-comercial/img/logo-img.svg') }}" alt="">
            </div>
      </div>
      <div class="text-center text-white p-5">
            <h4>LOGIN PESCADOR</h4>
      </div>
</div>

<div class="container ">
      <form id="form-login" action="{{ route('pescador.login') }}" method="POST">
            @csrf
            <div class="group"><input type="email" name="email" required="required" />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Email</label>
            </div>
            <div class="group"><input type="password" name="password" required="required" />
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Senha</label>
            </div>
            <div class="btn-box py-4">
                  <button id="btn-login" class="btn btn-submit" type="button">Entrar</button>
            </div>
            <div class="text-register text-center my-3">
                  <a href="{{ route('pescador.create') }}" class="text-white"><strong>Não tem registo?</strong></a>
            </div>
      </form>
</div>

@endsection