@extends('layouts.painel.index')


@section('content')
      <div class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-12 mt-5">
                              <div class="card">
                                    <div class="card-header">
                                          <div class="row">
                                                <div class="col-6"><h3 class="card-tilte">Dados do Cliente</h3></div>
      
                                                <div class="col-6 text-right"><a href="{{route('admin.clientes')}}" class="btn btn-sm btn-dark">Voltar</a></div>
                                          </div>
                                    </div>

                                    <div class="card-body pad">
                                          <form action="{{ route('admin.update.individual', $comprador->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Nome</label>
                                                            <input type="text" class="form-control" value="{{ $comprador->name }}" name="name">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Sobrenome</label>
                                                            <input type="text" class="form-control" value="{{ $comprador->lastname }}"
                                                                  name="lastname">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Email</label>
                                                            <input type="email" class="form-control" value="{{ $comprador->email }}" name="email">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Senha</label>
                                                            <input type="password" class="form-control" name="password">
                                                      </div>

                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">NIF</label>
                                                            <input type="text" value="{{ $comprador->individuais[0]->nif }}" class="form-control" name="nif">
                                                      </div>

                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Código Postal</label>
                                                            <div class="input-group">
                                                                  <input type="text" class="form-control" value="{{$comprador->adresses2->last()->codigo_postal}}" id="ceping" name="codigo_postal">
                                                                  <div class="input-group-append">
                                                                        <button type="button" id="buscaring" class="btn btn-dark">Buscar</button>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Morada</label>
                                                            <input type="text" id="morada" value="{{$comprador->adresses2->last()->morada}}" class="form-control" name="morada">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Região</label>
                                                            <input type="text" id="regiao" value="{{$comprador->adresses2->last()->regiao}}" class="form-control" name="regiao">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Porta</label>
                                                            <input type="text" id="porta" value="{{$comprador->adresses2->last()->porta}}" class="form-control" name="porta">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Distrito</label>
                                                            <input type="text" id="distrito" value="{{$comprador->adresses2->last()->distrito}}" class="form-control" name="distrito">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Conselho</label>
                                                            <input type="text" id="conselho" value="{{$comprador->adresses2->last()->conselho}}" class="form-control" name="conselho">
                                                      </div>
                                                      <div class="form-group col-12 col-md-6">
                                                            <label for="exampleInputEmail1">Freguesia</label>
                                                            <input type="text" id="freguesia" value="{{$comprador->adresses2->last()->freguesia}}" class="form-control" name="freguesia">
                                                      </div>

                                                      <input type="hidden" id="latitude" value="{{$comprador->adresses2->last()->latitude}}" name="latitude">
                                                      <input type="hidden" id="longitude" value="{{$comprador->adresses2->last()->longitude}}" name="longitude">

                                                      <div class="form-group col-12 d-flex justify-content-center">
                                                            <div class="col-12 col-md-4">
                                                                  <button type="submit" class="form-control btn btn-dark">Cadastrar</button>
                                                            </div>
                                                      </div>
                                                </div>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
@endsection
