
@extends('adminlte::page')

@section('title', 'Transferência Saldo')

@section('content_header')
    <h1>Fazer Retirada</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3>Transferir Saldo (Informe o Recebedor)</h3>
        </div>
        <div class="box-body">
            @include('admin.includes.alerts')

            <form method="POST" action="{{ route('confirm.transfer') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <input type="text" name="sender" placeholder="Informação de quem vai receber o saque (Nome ou E-mail)" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Próxima Etapa</button>
                </div>
            </form>
        </div>
    </div>
@stop