@extends('layouts.painel.index')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-tilte">Pedidos</h3></div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nº PEDIDO</th>
                                            <th>Itens</th>
                                            <th>Caixas</th>
                                            <th>Ações</th>
                                            <th>Status</th>
                                            <th>Caixas devolvidas?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userProducts as $userProduct)
                                            @if ($userProduct->orders->status == 2)
                                                <tr>
                                                    <td>{{$userProduct->orders->codigo}}</td>
                                                    <td>{{$userProduct->item}}</td>
                                                    <td>{{$userProduct->caixas}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{route('entregador.dados', $userProduct->id)}}" class="btn btn-info btn-sm">VER</a>
                                                            <button type="button" class="btn {{$userProduct->aceito == 0 ? 'btn-dark' : 'btn-success'}} btn-sm @if($userProduct->aceito == 0) btn_entrega_aceito @endif" data-route="{{route('entregador.aceito')}}" data-id="{{$userProduct->id}}">{{$userProduct->aceito == 0 ? 'ACEITAR' : 'ACEITO'}}</button>
                                                            @if ($userProduct->anexo)
                                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#anexarPDF" data-url="{{route('admin.pedidos.anexo')}}" data-id="{{$userProduct->id}}">ANEXO</button></
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($userProduct->status >= 3)
                                                            <button type="button" class="btn btn-success btn-sm">ENTREGUE</button>
                                                        @else
                                                            <button type="button" class="btn {{$userProduct->aceito == 0 ? 'btn-dark' : 'btn-primary'}} btn-sm" id="status-{{$userProduct->id}}">{{$userProduct->aceito == 0 ? 'AGUARDANDO' : 'EM ENTREGA'}}</button>
                                                        @endif
                                                    </td>
                                                    <td><button type="button" class="btn {{$userProduct->caixa_devolvida == 0 ? 'btn-dark' : 'btn-success'}} btn-sm caixa_devolvida" data-devolvida="{{$userProduct->caixa_devolvida == 0 ? 'S' : 'N'}}" data-route="{{route('entregador.caixa_devolvida')}}" data-id="{{$userProduct->id}}">{{$userProduct->caixa_devolvida == 0 ? 'NÃO' : 'SIM'}}</button></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="anexarPDF" tabindex="-1" aria-labelledby="anexarPDFLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anexarPDFLabel">Anexo PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pedidos.anexar') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div style="width: 100%" class="preview_anexo"></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
