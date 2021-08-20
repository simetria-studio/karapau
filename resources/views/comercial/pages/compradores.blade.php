@extends('layouts.app-comercial')

@section('content')
<div>
    <div class="d-flex justify-content-between container voltar py-4 mb-5">
        <div>
            <a href="{{route('consultor')}}"> <i class="fas fa-chevron-left"></i> Voltar</a>
        </div>
        <div>
            <span><a href="{{route('comprador.status')}}">STATUS DOS COMPRADORES</a></span>
        </div>
    </div>
</div>

<div class="container">
    <div class="d-flex justify-content-between pt-3 pb-4">
        <div>
            <a class="btn btn-filter-novo" href="{{route('comprador.status', 'ativos')}}">ATIVOS</a>
        </div>
        <div>
            <a class="btn btn-filter-concluido" style="background-color: #DE1313;" href="{{route('comprador.status', 'inativos')}}">INATIVOS</a>
        </div>
    </div>
</div>

<div style="min-height: 470px">
    @foreach ($compradores as $comprador)
        <div class="my-5" style="background: #FFFFFF;">
            <div class="container py-3">
                <div class="text-center"><h3><b>COMPRADOR</b></h3></div>
                <div class="text-center text-codigo-pedido">
                    @if ($comprador->type == 'coletivo')
                        <h3>{{$comprador->coletivo->name ?? $comprador->name}}</h3>
                    @else
                        <h3>{{$comprador->name}}</h3>
                    @endif
                </div>
                <div class="text-center text-informativo-pedido">
                        @if ($comprador->status == 0)
                            <span class="text-danger">INATIVO</span>
                        @elseif ($comprador->status == 1)
                            <span class="text-success">ATIVO</span>
                        @endif
                </div>
            </div>
            <a class="btn btn-filter-detalhe" href="{{route('comprador.detalhe', $comprador->id)}}">VER DETALHES</a>
        </div>
    @endforeach
    <div class="my-5 pb-3 pt-3 d-flex justify-content-center">
        {{$compradores->links()}}
    </div>
</div>
@endsection