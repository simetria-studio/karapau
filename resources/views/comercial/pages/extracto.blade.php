@extends('layouts.app-comercial')

@section('content')
<div>
    <div class="d-flex justify-content-between container voltar py-4 mb-5">
          <div>
                <a href="javascript:history.back()"> <i class="fas fa-chevron-left"></i> Voltar</a>
          </div>
          <div>
                <span><a href="{{route('consultor.extracto')}}">Extracto</a></span>
          </div>
    </div>
</div>

<div class="container">
    <div class="d-flex justify-content-between pt-3 pb-4">
        <div>
            <a class="btn btn-filter-novo" href="{{route('consultor.extracto', 'novos')}}">NOVOS</a>
        </div>
        <div>
            <a class="btn btn-filter-concluido" href="{{route('consultor.extracto', 'concluidos')}}">CONCLUÍDOS</a>
        </div>
    </div>
</div>

<div style="min-height: 100px">
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
    <div class="my-5 pb-3 pt-3" style="background: #FFFFFF;">
        {{$user_orders->links()}}
    </div>
</div>
@endsection