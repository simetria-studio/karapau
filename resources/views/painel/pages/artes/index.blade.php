@extends('layouts.painel.index')

@section('content')


    <div class="card m-5 col-md-10">

        <div>
            <a href="{{ route('admin.artes.create') }}"><button class="btn btn-dark my-2">Adicionar
                    Arte</button></a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Arte</th>
                        <th scope="col">Acões</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artes as $arte)
                        <tr>
                            <th scope="row">{{ $arte->id }}</th>
                            <td>{{ $arte->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a href="{{ route('admin.artes.delete', $arte->id) }}"
                                            onclick="return confirm('Você tem certeza?');"> <button
                                                class="btn btn-danger ">Apagar</button></a>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.artes.show', $arte->id) }}"> <button
                                                class="btn btn-primary ml-2">Editar</button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $artes->links() }}
        </div>
    </div>
@endsection
