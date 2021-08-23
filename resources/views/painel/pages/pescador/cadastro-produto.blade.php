@extends('layouts.painel.index')

@section('content')
      <div class="content">
            <div class="container-fluid">
                  <div class="row">
                        <div class="col-12 mt-5">
                              <div class="card">
                                    <div class="card-header"><h3 class="card-title">Pescador - Adcionar Produtos</h3></div>

                                    <div class="card-body">
                                          <form action="{{route('admin.pescador.produto.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_pescador" value="{{$id_pescador}}">
                                                <div class="row">
                                                      <div class="form-group col-12 col-md-6">
                                                            <select class="form-control" name="especie_id" id="margem">
                                                                  <option>Escolha a Espécie</option>
                                                                  @foreach ($especies as $especie)
                                                                        <option value="{{ $especie->id }}" data-margem="{{ $especie->margem }}">{{ $especie->nome_portugues }}</option>
                                                                  @endforeach
                                                            </select>
                                                      </div>

                                                      <div class="form-group col-12 col-md-6">
                                                            <select class="form-control" name="porto_id" id="exampleFormControlSelect1">
                                                                  <option>Escolha o Porto de descarga</option>
                                                                  @foreach ($portos as $porto)
                                                                        <option value="{{ $porto->id }}">{{ $porto->nome }}</option>
                                                                  @endforeach
                                                            </select>
                                                      </div>

                                                      <div class="form-group col-12 col-md-4">
                                                            <select class="form-control" name="embarcacao" id="exampleFormControlSelect1">
                                                                  <option>Escolha a Embarcação</option>
                                                                  <option value="{{ $pescador->nome_embarcacao }}">{{ $pescador->nome_embarcacao }}</option>
                                                                  <option value="{{ $pescador->nome_embarcacao2 }}">{{ $pescador->nome_embarcacao2 }}</option>
                                                                  <option value="{{ $pescador->nome_embarcacao3 }}">{{ $pescador->nome_embarcacao3 }}</option>
                                                            </select>
                                                      </div>

                                                      <div class="form-group col-12 col-md-4">
                                                            <select class="form-control" name="tamanho" id="exampleFormControlSelect1">
                                                                  <option>Escolha o Tamanho</option>
                                                                  <option value="tamanho1">Tamanho 1 (T1)</option>
                                                                  <option value="tamanho2">Tamanho 2 (T2)</option>
                                                                  <option value="tamanho3">Tamanho 3 (T3)</option>
                                                                  <option value="tamanho4">Tamanho 4 (T4)</option>
                                                                  <option value="pequeno">Pequeno</option>
                                                                  <option value="medio">Médio</option>
                                                                  <option value="grande">Grande</option>
                                                            </select>
                                                      </div>

                                                      <div class="form-group col-12 col-md-4">
                                                            <select class="form-control" name="arte" id="exampleFormControlSelect1">
                                                                  <option>Escolha a Arte</option>
                                                                  <option value="rede">Rede</option>
                                                                  <option value="vara">Vara</option>
                                                                  <option value="cerco">Cerco</option>
                                                                  <option value="arrasto">Arrasto</option>
                                                                  <option value="redes_de_emalhar">Redes de emalhar</option>
                                                                  <option value="redes_de_tresmalho">Redes de Tresmalho</option>
                                                                  <option value="anzol">Anzol</option>
                                                                  <option value="armadilhas">Armadilhas</option>
                                                                  <option value="envolventes_arrastantes">Envolventes arrastantes</option>
                                                                  <option value="arte_xavega">Arte Xávega</option>
                                                                  <option value="apanha">Apanha</option>
                                                            </select>
                                                      </div>

                                                      <div class="col-12 d-flex justify-content-center">
                                                            <div class="col-12 col-md-4 row">
                                                                  <div class="form-group col-6 text-center">
                                                                        <label for="name-field">Kg</label>
                                                                        <input id="check_kg" class="form-control" value="Kg" name="unidade" type="radio">
                                                                  </div>
                                                                  <div class="form-group col-6 text-center">
                                                                        <label for="name-field">Unidade</label>
                                                                        <input id="check_unidade" value="Unidade" class="form-control" name="unidade" type="radio">
                                                                  </div>
                                                            </div>
                                                      </div>

                                                      <div id="kg" class="form-group d-none col-12">
                                                            <div class="row justify-content-center">
                                                                  <div class="col-12 col-md-4">
                                                                        <input type="number" class="form-control" name="quantidade_kg">
                                                                        <label for="name-field">Quantos Kg</label>
                                                                  </div>
                                                            </div>
                                                      </div>
                                    
                                                      <div id="unidade" class="form-group d-none col-12">
                                                            <div class="row justify-content-center">
                                                                  <div class="col-12 col-md-4">
                                                                        <input type="number" class="form-control" name="quantidade_unidade">
                                                                        <label for="name-field">Quantos peixes tem</label>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div id="kg_total" class="form-group d-none col-12">
                                                            <div class="row justify-content-center">
                                                                  <div class="col-12 col-md-4">
                                                                        <input type="number" class="form-control" name="total_kg">
                                                                        <label for="name-field">Total de Kg</label>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div id="price_div" class="form-group d-none col-12">
                                                            <div class="row justify-content-center">
                                                                  <div class="col-12 col-md-4">
                                                                        <input type="number" id="price" class="form-control" onkeyup="getPriceValue()" name="preco">
                                                                        <label for="name-field">Preço por KG</label>
                                                                  </div>
                                                            </div>
                                                      </div>

                                                      <div class="col-12 d-flex justify-content-center">
                                                            <div class="col-12 col-md-3">
                                                                  <div class="receber">
                                                                        <input id="percent" class="form-control" disabled placeholder="Vai Receber" type="text" value="">
                                                                  </div>
                                                            </div>
                                                      </div>

                                                      <div class="col-12 mt-3 d-flex justify-content-center">
                                                            <div class="col-12 col-md-4">
                                                                  <button class="btn btn-dark btn-block" type="submit">Cadastrar</button>
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
      <script>
            function getPriceValue(){
                  var input1 = $("#price").val();
                  var margem = $("#margem").find(":selected").data("margem");
                  // var margem = $("#margem");
                  console.log(margem);
                  var valor = 0;
                  var value = input1 - input1 * (margem/100);
                  var input2 = $("#percent").val("Vai receber"+" "+value.toFixed(2));
            }
      </script>
@endsection
