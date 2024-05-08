@extends('layouts.app');

@section('content')
{{ $estagio->funcao }}<br>
{{ $estagio->tema }}<br>
{{ $estagio->Empresa->nome }}<br>
{{ $estagio->Empresa->email }}<br>
{{ $estagio->Empresa->cnpj }}<br>
{{ $estagio->Empresa->supervisor }}<br>
@endsection
