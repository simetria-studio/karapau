@extends('layouts.painel.index')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div><h3 class="card-tilte">Pedidos</h3></div>
                            <div class="ml-auto"><a href="{{route('entregador')}}" class="btn btn-info btn-sm">Voltar</a></div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nº PEDIDO</th>
                                            <th>Itens</th>
                                            <th>Caixas</th>
                                            <th>ENTREGAR?</th>
                                            <th>Entrega concluida?</th>
                                            <th>PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-active">
                                            <td>{{$userProduct->orders->codigo}}</td>
                                            <td>{{$userProduct->item}}</td>
                                            <td>{{$userProduct->caixas}}</td>
                                            <td><button type="button" class="btn {{$userProduct->aceito == 0 ? 'btn-dark' : 'btn-success'}} btn-sm @if($userProduct->aceito == 0) btn_entrega_aceito @endif" data-route="{{route('entregador.aceito')}}" data-id="{{$userProduct->id}}">{{$userProduct->aceito == 0 ? 'ACEITAR' : 'ACEITO'}}</button></td>
                                            <td>
                                                @if ($userProduct->status >= 3)
                                                    <button type="button" class="btn btn-success btn-sm">ENTREGUE</button>
                                                @else
                                                    <button type="button" class="btn {{$userProduct->aceito == 0 ? 'btn-dark' : 'btn-primary'}} btn-sm @if($userProduct->aceito == 1) btn_entregue @endif" data-route="{{route('entregador.entregue')}}" data-id="{{$userProduct->id}}" id="status-{{$userProduct->id}}">{{$userProduct->aceito == 0 ? 'AGUARDANDO' : 'EM ENTREGA'}}</button>
                                                @endif
                                            </td>
                                            <td><button type="button"
                                                class="btn {{$userProduct->anexo ? 'btn-success' : 'btn-dark'}} btn-sm" data-toggle="modal" data-target="#anexarPDF" data-url="{{route('admin.pedidos.anexo')}}" data-id="{{$userProduct->id}}">ANEXO</button></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-light">
                                                            <th>Item</th>
                                                            <th>Pescador</th>
                                                            <th>Caixas</th>
                                                            <th>Espécime</th>
                                                            <th>Peso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="table-light">
                                                            <td>01</td>
                                                            <td><button type="button" class="btn btn-dark btn-sm">{{$userProduct->pescador->name}}</button></td>
                                                            <td>{{$userProduct->caixas}}</td>
                                                            <td>{{$userProduct->name}}</td>
                                                            <td>{{$userProduct->quantity}} Kg</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr class="table-active">
                                            <td colspan="6">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Comprador</th>
                                                            <th>Telemóvel</th>
                                                            <th>Morada</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$comprador->name}}</td>
                                                            <td>{{$comprador->telemovel}}</td>
                                                            <td>{{$address->morada}}, {{$address->porta}} / {{$address->codigo_postal}} / {{$address->conselho}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-light">
                                                            <th>Porto Origem</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="table-light">
                                                            <td><button type="button" class="btn btn-dark btn-sm">{{$userProduct->origem}}</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
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
