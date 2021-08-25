@extends('layouts.painel.index')


@section('content')


    <div class="card m-5 col-md-10">
        <p>Pedidos</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Comprador</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pedidos as $pedido)

                    <tr>
                        <th scope="row">{{ $pedido->id }}</th>
                        <td>{{ $pedido->orders->payment_mothod }}</td>
                        <td>{{ $pedido->orders->user_name }}</td>
                        <td>
                            <a href="{{ route('admin.pedidos.completo', $pedido->order_id) }}"> <button
                                    class="btn btn-dark">Ver Completo</button></a>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>




@endsection
