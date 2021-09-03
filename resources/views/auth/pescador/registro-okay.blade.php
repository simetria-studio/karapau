@extends('layouts.app-pescador')


@section('content')
<div class="container mt-5">
    <div class="py-4 text-center">
        <img class="img-fluid " src="{{ url('app-comercial/img/logo-img.svg') }}" alt="">
    </div>
</div>
<div class="text-center text-white p-5">
    <h2><strong>CADASTRO CONCLUIDO COM SUCESSO!</strong></h2>

    <h4 class="mt-5">Nossa equipe irá entrar em contato convosco em até 24 hras para valiarseu cadastro.</h4>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            setTimeout(() => {
                window.location.href = '{{route("login.pescador")}}';
            }, 10000);
        });
    </script>
@endsection