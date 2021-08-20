@extends('layouts.app-comercial')

@section('content')
<div>
    <div class="d-flex justify-content-between container voltar py-4 mb-5">
        <div>
            <a href="{{route('comprador.status')}}"> <i class="fas fa-chevron-left"></i> Voltar</a>
        </div>
        <div>
            <span><a href="{{route('comprador.detalhe', $comprador->id)}}">COMPRADOR DETALHE</a></span>
        </div>
    </div>
</div>

<div class="container">
    <div class="py-0 my-0">
        <div class="text-center">
            <h3 class="text-white"><b>COMPRADOR</b></h3>
        </div>
        <div class="text-center">
            <h3 class="text-white text-uppercase"><b>{{$comprador->type}}</b></h3>
        </div>
    </div>
</div>

<div style="min-height: 470px">
    <div class="my-5" style="background: #FFFFFF;">
        <div class="container py-3">
            <div class="text-center"><h3 class="text-uppercase"><b>{{$comprador->coletivo->name ?? $comprador->name}}</b></h3></div>
            <div class="text-center text-informativo-pedido">
                @if ($comprador->status == 0)
                    <span class="text-danger">INATIVO</span>
                @elseif ($comprador->status == 1)
                    <span class="text-success">ATIVO</span>
                @endif
            </div>

            <div class="pt-4 text-center text-codigo-pedido">
                <h3><b>TELEMÓVEL</b></h3>
            </div>
            <div class="text-center text-codigo-pedido">
                <span>{{$comprador->telemovel}}</span>
            </div>

            @if ($comprador->type == 'coletivo')
                <div class="pt-4 text-center text-codigo-pedido">
                    <h3><b>NIPC</b></h3>
                </div>
                <div class="text-center text-codigo-pedido">
                    <span>{{$comprador->coletivo->nif}}</span>
                </div>

                <div class="pt-4 text-center text-codigo-pedido">
                    <h3 class="text-uppercase"><b>CATEGORIA</b></h3>
                </div>
                <div class="text-center text-codigo-pedido">
                    <span class="text-uppercase">{{$comprador->coletivo->tipo}}</span>
                </div>

                <div class="pt-4 text-center text-codigo-pedido">
                    <h3 class="text-uppercase"><b>CONTACTO</b></h3>
                </div>
                <div class="text-center text-codigo-pedido">
                    <span class="text-uppercase">{{$comprador->coletivo->contato}}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-filter-detalhe" data-toggle="collapse" href="#collapsePedidos" role="button" aria-expanded="false" aria-controls="collapse">COMPRAS</a>
    </div>

    <div class="collapse @if($filter) show @endif @isset($_GET['page']) show @endif" id="collapsePedidos">
        <div class="container my-5 pb-3 pt-3">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-filter-novo" href="{{route('comprador.detalhe', [$comprador->id, 'novos'])}}">NOVOS</a>
                </div>
                <div>
                    <a class="btn btn-filter-concluido" href="{{route('comprador.detalhe', [$comprador->id, 'concluidos'])}}">CONCLUIDOS</a>
                </div>
            </div>
        </div>
        @foreach ($user_orders as $user_order)
            <div class="my-5" style="background: #FFFFFF;">
                <div class="container py-3">
                    <div class="text-center"><h3><b>PEDIDO</b></h3></div>
                    <div class="text-center text-codigo-pedido"><h3>{{$user_order->codigo}}</h3></div>
                    <div class="text-center text-informativo-pedido">
                            @if ($user_order->status == 0)
                                Aguardando pagamento
                            @elseif ($user_order->status == 1)
                                Análise Financeira
                            @elseif ($user_order->status == 2)
                                Pago
                            @elseif ($user_order->status == 3)
                                Cancelado
                            @endif
                    </div>
                </div>
                <a class="btn btn-filter-detalhe" href="{{route('consultor.extracto.ver', $user_order->id)}}">VER DETALHES</a>
            </div>
        @endforeach
        <div class="my-5 pb-3 pt-3 d-flex justify-content-center">
            {{$user_orders->links()}}
        </div>
    </div>

    <div class="my-5" style="background: #FFFFFF;">
        <div class="container py-3">
            <div class="text-center"><h3 class="text-uppercase"><b>MORADA DE ENTREGA</b></h3></div>

            <div class="pt-4 text-center text-codigo-pedido">
                <span>{{$comprador->adresses->morada ?? ''}} {{$comprador->adresses->codigo_postal ?? ''}}</span>
            </div>
            <div class="text-center text-codigo-pedido">
                <span>{{$comprador->adresses->regiao ?? ''}}</span>
            </div>
        </div>
        {{-- <a class="btn btn-filter-detalhe">VER NO MAPA</a> --}}
    </div>
</div>
@endsection