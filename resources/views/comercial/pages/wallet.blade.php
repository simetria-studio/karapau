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
    @php
    $value = 0;
    @endphp
    @foreach ($wallet as $wal)

        @if ($wal->orders)
            @if ($wal->orders->status != 0 and $wal->orders->status != 1 and $wal->orders->status != 4)
                @php
                    $value += $wal->value;
                @endphp
            @endif
        @endif
        @if ($wal->order_id == 0)
            @php
                $value += $wal->value;
            @endphp
        @endif
    @endforeach
    <div class="container mt-2">
        <div class="wallet d-flex px-4">
            <a href="{{ route('wallet') }}">
                <div class="py-4 ">
                    <i class="fas fa-wallet a-2"></i> Seu Wallet
                    <h3 class="balance"> {{ '€ ' . number_format($value, 2, ',', '.') }}</h3>
                </div>
            </a>
            <div class="col-4 eye">
                <span onclick="hide()"><i class="fas fa-eye"></i></span>
            </div>
            <div class="col-4 eye-close d-none">
                <span onclick="show()"><i class="fas fa-eye-slash"></i></span>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('wallet.draw') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
            <input type="hidden" name="qty" value="{{ $value }}">
            <div class="d-flex justify-content-center  pt-4 pb-4">
                <div>
                    <button class="btn btn-filter-novo" type="submit">RETIRAR</button>
                </div>
            </div>
        </form>
    </div>
    @if ($draws->status == 0)
    <div class="wallet-3">
        <div class="textos">
            <h3>SOLICITAÇÃO</h3>
            <p>VALOR {{ '€ ' . number_format($draws->qty, 2, ',', '.') }}</p>
            <span >AGUARDANDO PAGAMENTO</span>
        </div>
    </div>
    @endif

    <div class="wallet-1">
        <div class="textos">
            <h3>TOTAL RECEBIDO ATÉ HOJE</h3>
            <p>VALOR € 0,00</p>
        </div>
    </div>



@endsection
