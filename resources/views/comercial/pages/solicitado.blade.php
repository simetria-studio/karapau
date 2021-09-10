@extends('layouts.app-comercial')

@section('content')

    <div>
        <div class="d-flex justify-content-between container voltar py-4 mb-5">
            <div>
                <a href="javascript:history.back()"> <i class="fas fa-chevron-left"></i> Voltar</a>
            </div>
            <div>
                <span>WALLET</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="pt-5 ">
            <div class="text-center wallet-2">
                <h3>SOLICITAÇÃO DE RETIRADA ENVIADA</h3>
            </div>
            <div class="d-flex  justify-content-center  pt-4 pb-4">
                <div>
                    <a href="{{ route('wallet') }}"><button class="btn btn-filter-novo" type="submit">VOLTAR</button></a>
                </div>
            </div>
        </div>
    </div>



@endsection
