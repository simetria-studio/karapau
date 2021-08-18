@extends('layouts.app-comercial')

@section('content')
<div>
    <div class="d-flex justify-content-between container voltar py-4 mb-5">
        <div>
            <a href="javascript:history.back()"> <i class="fas fa-chevron-left"></i> Voltar</a>
        </div>
        <div>
            <span><a href="{{route('consultor.extracto')}}">Extracto Detalhes</a></span>
        </div>
    </div>
</div>

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
</div>

<div class="my-5" style="background: #FFFFFF;">
    <div class="container py-3">
        <div class="text-center"><h3><b>MORADA DE ENTREGA</b></h3></div>
        <div class="text-center">
            {{$user_order->enderecos->morada}} {{$user_order->enderecos->codigo_postal}}
        </div>
        <div class="text-center">
            {{$user_order->enderecos->regiao}}
        </div>
    </div>
</div>

<div class="container text-center">
    <h2 class="text-white"><b>TOTAL DO PEDIDO + ENTREGA</b></h2>
</div>

<div class="my-5" style="background: #06CC32;">
    <div class="container pt-4 text-center">
        <div class="d-flex justify-content-center">
            <div class="text-custom-f1">ITENS ({{str_pad($orders->products2->count(), 2, '0', STR_PAD_LEFT)}})</div>
            <div class="text-custom-f1"><i class="fas fa-euro-sign"></i> {{number_format($user_order->total, 2, ',', '.')}}</div>
            <div class="div-plus-item" type="button" data-toggle="collapse" data-target=".itens" aria-expanded="false" aria-controls="itens"><i class="fas fa-plus-circle"></i></div>
        </div>
    </div>
</div>

<div class="my-5 container-fluid" style="background: #FFFFFF;">
    @php
        $item = 0;
    @endphp
    @foreach ($orders->products2 as $products)
        @php
            $item++;
        @endphp
        <div class="collapse container py-3 itens">
            <div class="text-pedido-item"><b>Item: </b>{{str_pad($item, 2, '0', STR_PAD_LEFT)}}</div>
            <div class="text-pedido-item"><b>Espécie: </b>{{$products->name}}</div>
            <div class="text-pedido-item"><b>Peso: </b>{{$products->quantity}} Kg</div>
            <div class="text-pedido-item"><b>Caixas: </b>{{$products->caixas}}</div>
            <div class="text-pedido-item"><b>Valor: </b>{{number_format($products->total_value, 2, ',', '.')}}</div>
            <div class="text-pedido-item"><b>Origem: </b>{{$products->origem}}</div>
            <div><button type="button" class="btn btn-block btn-custom-informativo">
                @if ($products->status < 3)
                    AGUARDADNDO PAGAMENTO
                @elseif ($products->status == 3)
                    ENTREGUE
                @endif
            </button></div>
        </div>
    @endforeach
</div>

<div class="container text-center">
    <h2 class="text-white"><b>QUANTO VOCÊ VAI RECEBER</b></h2>
</div>

<div class="my-4">
    <div class="container-fluid my-2" style="background: #0472B7;">
        <div class="container">
            <div class="py-4 d-flex justify-content-between">
                <div class="text-white text-custom-comissao">COMISSÂO 2%</div>
                <div class="text-white text-custom-comissao"><i class="fas fa-euro-sign"></i> 1,90</div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-3" style="background: #0472B7;">
        <div class="container">
            <div class="py-4 d-flex justify-content-between">
                <div class="text-white text-custom-comissao">VALOR POR ITEM (3)</div>
                <div class="text-white text-custom-comissao"><i class="fas fa-euro-sign"></i> 3,00</div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-2" style="background: #0472B7;">
        <div class="container">
            <div class="py-4 d-flex justify-content-between">
                <div class="text-white text-custom-comissao">BÔNUS</div>
                <div class="text-white text-custom-comissao"><i class="fas fa-euro-sign"></i> 5,00</div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-2" style="background: #06CC32;">
        <div class="container">
            <div class="py-4 d-flex justify-content-between">
                <div class="text-white text-custom-comissao">TOTAL</div>
                <div class="text-white text-custom-comissao"><i class="fas fa-euro-sign"></i> 9,90</div>
            </div>
        </div>
    </div>
</div>

{{-- <div style="min-height: 100px">
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
</div> --}}
@endsection