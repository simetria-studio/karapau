@extends('layouts.painel.index')


@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h3 class="card-tilte">Pedidos</h3>
                            </div>
                            <div class="ml-auto"><a href="{{ route('admin.encomendas') }}"
                                    class="btn btn-info btn-sm">Voltar</a></div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nº PEDIDO</th>
                                            <th>Itens</th>
                                            <th>Caixas</th>
                                            <th></th>
                                            <th>TOTAL</th>
                                            <th>Taxa Entrega</th>
                                            <th>Hora do Pedido</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-active">
                                            <td>{{ $user_order->codigo }}</td>
                                            <td>{{ $arrayGeral->itens }}</td>
                                            <td>{{ $arrayGeral->caixas }}</td>
                                            <td>
                                                @if ($user_order->fatura)
                                                    <button type="button" class="btn btn-dark btn-sm ml-2">Faturado</button>
                                                @else

                                                    <form action="{{ route('admin.status.fatura', $user_order->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="fatura" value="1">
                                                        <button type="submit"
                                                            class="btn btn-dark btn-sm ml-2">Faturar</button>
                                                    </form>

                                                @endif

                                            </td>
                                            <td>€ {{ number_format($user_order->total, 2, ',', '.') }}</td>
                                            <td>€ {{ number_format($user_order->frete, 2, ',', '.') }}</td>
                                            <td> {{ date('d/m/Y H:m:i', strtotime($user_order->created_at)) }}</td>
                                            <td>

                                                <button type="button" data-toggle="modal" @if ($user_order->status == 3) disabled @endif
                                                    data-target="#exampleModal" class="btn btn-dark">
                                                    @if ($user_order->status == 3)
                                                    CANCELADO @else STATUS
                                                    @endif
                                                </button>


                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $ordemPedido = 0;
                                        @endphp
                                        @foreach ($orders->products2 as $userProduct)
                                            @php
                                                $ordemPedido++;
                                            @endphp
                                            <tr>
                                                <td colspan="7">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-light">
                                                                <th>Item</th>
                                                                <th>Pescador</th>
                                                                <th>Caixas</th>
                                                                <th>Espécime</th>
                                                                <th>Peso</th>
                                                                <th>Valor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="table-light">
                                                                <td>{{ str_pad($ordemPedido, 2, '0', STR_PAD_LEFT) }}</td>
                                                                <td><button type="button" data-toggle="modal" data-target="#pescadorModal-{{$userProduct->pescador->id}}" class="btn btn-dark btn-sm">{{ $userProduct->pescador->name }}</button>
                                                                </td>
                                                                <td>{{ $userProduct->caixas }}</td>
                                                                <td>{{ $userProduct->name }}</td>
                                                                <td>{{ $userProduct->quantity }} Kg</td>
                                                                <td>€
                                                                    {{ number_format($userProduct->price, 2, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr class="table-active">
                                                <td colspan="7">
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
                                                                <td><button type="button" class="btn btn-dark btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#compradorModal">{{ $comprador->name }}</button>
                                                                </td>
                                                                <td>{{ $comprador->telemovel }}</td>
                                                                <td>{{ $address->morada }}, {{ $address->porta }} /
                                                                    {{ $address->codigo_postal }} /
                                                                    {{ $address->conselho }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-light">
                                                                <th>Porto Origem</th>
                                                                <th>Status</th>
                                                                <th>Sage</th>
                                                                <th>PDF</th>
                                                                <th>Entregador</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="table-light">
                                                                <td><button type="button"
                                                                        class="btn btn-dark btn-sm">{{ $userProduct->origem }}</button>
                                                                </td>
                                                                <td><button type="button"
                                                                        class="btn {{ $userProduct->status == 0 ? 'btn-dark' : 'btn-success' }} btn-sm @if ($userProduct->status == 1) btn_liberar_pedido @endif"
                                                                        data-route="{{ route('admin.status.produto') }}"
                                                                        data-id="{{ $userProduct->id }}">
                                                                        @if ($userProduct->status == 1)
                                                                        A LIBERAR @elseif($userProduct->status == 0)
                                                                            AGUARDANDO
                                                                        @else
                                                                            LIBERADO
                                                                        @endif
                                                                    </button>
                                                                </td>
                                                                <td><button type="button"
                                                                        class="btn btn-dark btn-sm">ENVIAR</button></td>
                                                                <td><button type="button"
                                                                        class="btn {{ $userProduct->anexo ? 'btn-success' : 'btn-dark' }} btn-sm"
                                                                        data-toggle="modal" data-target="#anexarPDF"
                                                                        data-url="{{ route('admin.pedidos.anexo') }}"
                                                                        data-id="{{ $userProduct->id }}">{{ $userProduct->anexo ? 'ANEXO' : 'ANEXAR' }}</button>
                                                                </td>
                                                                <td><button type="button"
                                                                        data-id="{{ $userProduct->id }}"
                                                                        @if ($userProduct->deliveryman == 0) data-toggle="modal" data-target="#entregadorModal" @endif
                                                                        class="btn {{ $userProduct->deliveryman !== 0 ? 'btn-info' : 'btn-dark' }} btn-sm">{{ $userProduct->deliveryman !== 0 ? 'ENTREGADOR ATRIBUIDO' : 'ESCOLHER ENTREGADOR' }}</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/user/order/status/' . $user_order->id) }}" method="post">
                    <div class="modal-body">

                        @csrf

                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2">
                                <label class="form-check-label text-success" for="exampleRadios1">
                                    Pago
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="3">
                                <label class="form-check-label text-danger" for="exampleRadios1">
                                    Cancelar
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Alterar Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="compradorModal" tabindex="-1" aria-labelledby="compradorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="compradorModalLabel">Comprador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 py-2 px-3"><b>Nome:</b> {{ $comprador->name }} {{ $comprador->lastname }}
                        </div>
                        <div class="col-12 py-2 px-3"><b>Email:</b> {{ $comprador->email }}</div>
                        <div class="col-12 py-2 px-3">
                            <b>NIF:</b>
                            @if ($comprador->type == 'coletivo')
                                {{$comprador->coletivos->last()->nif ?? ''}}
                            @else
                                {{$comprador->individuais->last()->nif ?? ''}}
                            @endif
                        </div>
                        <div class="col-12 py-2 px-3"><b>Telemóvel:</b> {{ $comprador->telemovel }}</div>
                        <div class="col-12 py-2 px-3"><b>Morada:</b> {{ $address->morada }}, {{ $address->porta }} /
                            {{ $address->codigo_postal }} / {{ $address->conselho }}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="entregadorModal" tabindex="-1" aria-labelledby="entregadorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entregadorModalLabel">Escolha o Entregador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('entregador.atribuir') }}" method="post">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deliveryman">Entregador</label>
                            <select name="deliveryman" class="form-control">
                                <option value="">- Escolha um Entregador -</option>
                                @foreach ($entregadores as $entregador)
                                    <option value="{{ $entregador->id }}">{{ $entregador->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success btn-save"
                            data-save_target="#entregadorModal">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="anexarPDF" tabindex="-1" aria-labelledby="anexarPDFLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anexarPDFLabel">Anexar Arquivo PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pedidos.anexar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="anexo" class="anexo">
                        </div>

                        <div style="width: 100%" class="preview_anexo"></div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success btn-save-pdf"
                            data-save_target="#anexarPDF">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($orders->products2 as $pescador)
        <div class="modal fade" id="pescadorModal-{{$pescador->pescador->id}}" tabindex="-1" aria-labelledby="pescadorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pescadorModalLabel">Dados do Pescador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 py-2 px-3"><b>Nome:</b> {{ $userProduct->pescador->name ?? '' }}
                                {{ $userProduct->pescador->lastname ?? '' }}</div>
                            <div class="col-12 py-2 px-3"><b>Email:</b> {{ $userProduct->pescador->email ?? '' }}</div>
                            <div class="col-12 py-2 px-3"><b>NIF:</b> {{ $userProduct->pescador->nif ?? '' }}</div>
                            <div class="col-12 py-2 px-3"><b>Telemóvel:</b> {{ $userProduct->pescador->telefone ?? '' }}
                            </div>
                            <div class="col-12 py-2 px-3"><b>Morada:</b> {{ $userProduct->pescador->morada ?? '' }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
