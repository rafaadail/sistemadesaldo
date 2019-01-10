
@extends('adminlte::page')

@section('title', 'Nova Recarga')

@section('content_header')
    <h1>Fazer Recarga</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depositar</a></li>
    </ol>
@stop

@section('content')

    <div class="box">
        <form method="POST" action="{{ route('deposit.store') }}">
            {!! csrf_field() !!}

            <div class="box-header">
               <h3>Fazer Recarga</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <input type="text" placeholder="Valor Recarga">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Recarregar</button>
                </div>
            </div>
        </form>
    </div>
@stop