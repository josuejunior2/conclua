@extends('layouts.app');

@section('content')
@can('permissao de escrita academico')
adasa
{{ $tcc->tema }}<br>
{{ $tcc->problema }}<br>
{{ $tcc->objetivo_especifico }}<br>
{{ $tcc->objetivo_geral }}<br>
{{ $tcc->justificativa }}<br>
@endcan
{{ $tcc->metodologia }}<br>
@endsection
