@extends('layouts.app-comercial')


@section('content')
<div class="container vh-100 pt-3">
    <div class="py-4 text-center">
          <img class="img-fluid " src="{{ url('app-comercial/img/logo-img.svg') }}" alt="">
    </div>
    <div class="py-4 text-center">
        <div class="mb-5"><h2 class="text-white"><b>CADASTRO CONCLUIDO COM SUCESSO!</b></h2></div>
        <div class="mb-5"><a class="btn btn-custom btnc-success" href="{{route('consultor.comprador-individual.create')}}">CADASTRAR OUTRO</a></div>
        <div><a class="btn btn-custom btnc-info" href="{{route('consultor')}}">INÍCIO</a></div>
    </div>
</div>
@endsection