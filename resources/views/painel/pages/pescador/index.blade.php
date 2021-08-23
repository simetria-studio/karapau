@extends('layouts.painel.index')


@section('content')
      <div class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-12 mt-5">
                              <div class="card">
                                    <div class="card-header"><h3 class="card-tilte">Pescadores</h3></div>
      
                                    <div class="card-body">
                                          <div class="table-responsive">
                                                <table class="table">
                                                      <thead class="thead-dark">
                                                            <tr>
                                                                  <th scope="col">Nome</th>
                                                                  <th scope="col">Embarcação</th>
                                                                  <th scope="col">E-mail</th>
                                                                  <th scope="col">Ação</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            @foreach ($pescadores as $pescador)
                                                            <tr>
                                                                  <th scope="row">{{ $pescador->name }}</th>
                                                                  <td>{{ $pescador->nome_embarcacao }}</td>
                                                                  <td>{{ $pescador->email }}</td>
                                                                  <td>
                                                                        <div class="d-flex justify-content-around icones">
                                                                              <div class="mx-1">
                                                                                    <a href="{{route('admin.pescador.cadastro.produto', $pescador->id)}}"><i class="fas fa-user"></i></a>
                                                                              </div>
                                                                              <div class="mx-1">
                                                                                    <a href="{{ route('admin.pescador.produtos', $pescador->id) }}"><i class="fas fa-box-open"></i></a>
                                                                              </div>
                                                                              <div class="mx-1">
                                                                                    <a href="{{ route('admin.pescador.edit', $pescador->id) }}"><i class="fas fa-edit"></i></a>
                                                                              </div>
                                                                              <div class="mx-1">
                                                                                    <form action="{{ route('admin.pescador.update.status', $pescador->id) }}">
                                                                                          @csrf
                                                                                          @if($pescador->status == 0)
                                                                                          <input type="hidden" value="1" name="status">
                                                                                          <button type="submit" style="background: none; border: none; font-size: 1.5em; color: red;" class="fas fa-ban"></button>
                                                                                          @else
                                                                                          <input type="hidden" value="0" name="status">
                                                                                          <button type="submit" style="background: none; border: none; font-size: 1.5em; color: green;" class="fas fa-check"></button>
                                                                                          @endif
                                          
                                          
                                                                                    </form>
                                                                              </div>
                                                                              <div class="mx-1">
                                                                                    <a href="{{ route('admin.pescador.pedidos', $pescador->id) }}"> <i class="fas fa-shopping-cart"></i></a>
                                                                              </div>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                            @endforeach
                                          
                                          
                                                      </tbody>
                                                </table>
                                          </div>
      
                                          <div>{{ $pescadores->links() }}</div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection
