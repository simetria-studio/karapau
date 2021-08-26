@extends('layouts.painel.index')

@section('content')


    <div class="card m-5 col-md-10">
        <p>Espécies</p>
        <div>
            <a href="{{ route('admin.tamanhos.create') }}"><button class="btn btn-dark my-2">Adicionar
                    Tamanho</button></a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tamanho</th>
                        <th scope="col">Acões</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tamanhos as $tamanho)
                        <tr>
                            <th scope="row">{{ $tamanho->id }}</th>
                            <td>{{ $tamanho->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <div>
                                        <a href="{{ route('admin.tamanhos.delete', $tamanho->id) }}"
                                            onclick="return confirm('Você tem certeza?');"> <button
                                                class="btn btn-danger ">Apagar</button></a>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.tamanhos.show', $tamanho->id) }}"> <button
                                                class="btn btn-primary ml-2">Editar</button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $tamanhos->links() }}
        </div>
    </div>
@endsection
