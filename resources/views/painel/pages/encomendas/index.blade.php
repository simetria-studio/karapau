@extends('layouts.painel.index')


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="row mt-2 justify-content-between">
                                <div class="col-12 col-md-4"><h4>Espécies</h4></div>
                                <div class="col-12 col-md-8">
                                    <form action="{{route('admin.encomendas')}}" method="get">
                                        <div class="row">
                                            <div class="form-group col-12 col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="@isset($_GET['filtro']){{$_GET['filtro']}}@endisset" name="filtro" placeholder="Filtro">
                                                    <select name="coluna" id="" class="form-control">
                                                        <option value="codigo" @isset($_GET['coluna']){{$_GET['coluna'] == 'codigo' ? 'selected' : ''}}@endisset>Numero do Pedido</option>
                                                        <option value="user_name" @isset($_GET['coluna']){{$_GET['coluna'] == 'user_name' ? 'selected' : ''}}@endisset>Nome do Comprador</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <select name="status" id="" class="form-control">
                                                    <option value="">Selecione um Status</option>
                                                    <option value="0" @isset($_GET['status']){{$_GET['status'] == '0' ? 'selected' : ''}}@endisset>Aguardando pagamento</option>
                                                    <option value="1" @isset($_GET['status']){{$_GET['status'] == '1' ? 'selected' : ''}}@endisset>Análise Financeira</option>
                                                    <option value="2" @isset($_GET['status']){{$_GET['status'] == '2' ? 'selected' : ''}}@endisset>Pago</option>
                                                    <option value="3" @isset($_GET['status']){{$_GET['status'] == '3' ? 'selected' : ''}}@endisset>Cancelado</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-md-2">
                                                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                                                <a href="{{route('admin.encomendas')}}" class="btn btn-warning"><i class="fas fa-eraser"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Numero do Pedido</th>
                                            <th scope="col">Nome do Comprador</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Comercial</th>
                                            <th></th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Acão</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th>{{ $order->codigo }}</th>
                                                <td>{{ $order->user_name }}</td>
                                                <td>
                                                    @if ($order->status == 0) AGUARDANDO PAGAMENTO
                                                    @elseif($order->status == 1) ANÁLISE FINANCEIRA
                                                    @elseif($order->status == 2) PAGAMENTO ACEITO
                                                    @elseif($order->status == 3) CANCELADO
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$comercial->find($order->user->user_id)->name}}
                                                </td>
                                                <td>
                                                    @if($order->fatura)
                                                    <button type="button" class="btn btn-dark btn-sm ml-2">Faturado</button>
                                                    @else
                                                    <div>
                                                        <form action="{{ route('admin.status.fatura', $order->id) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="fatura" value="1">
                                                            <button type="submit" class="btn btn-primary btn-sm ml-2">Faturar</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ '€ ' . number_format($order->total, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between icones">
                                                        <div>
                                                            <a href="{{ route('admin.pedidos.completo', $order->id) }}"><i
                                                                    class="far fa-eye"></i> </a>
                                                        </div>
                                                        @if ($order->payImage)
                                                            <div class="ml-3">
                                                                <a href="{{ route('admin.encomendas.download', $order->id) }}"><i
                                                                        class="far fa-file-alt"></i></a>
                                                            </div>
                                                        @endif
                                                        <div class="ml-3">
                                                            <a href="{{route('admin.encomenda.remover', $order->id)}}" class="btn-trash">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if (isset($_GET['filtro']) && isset($_GET['status']))
                                            {{ $orders->appends(['filtro'=>$_GET['filtro'], 'coluna'=>$_GET['coluna'], 'status'=>$_GET['status']])->links() }}
                                        @elseif(isset($_GET['filtro']))
                                            {{ $orders->appends(['filtro'=>$_GET['filtro'], 'coluna'=>$_GET['coluna'], 'status'=>''])->links() }}
                                        @elseif(isset($_GET['status']))
                                            {{ $orders->appends(['filtro'=>'', 'coluna'=>'', 'status'=>$_GET['status']])->links() }}
                                        @else
                                            {{ $orders->links() }}
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
