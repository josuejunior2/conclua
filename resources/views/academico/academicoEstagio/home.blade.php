@extends('layouts.app');

@section('content')
{{ $academico->AcademicoTCC->tema }}<br>
{{ $academico->AcademicoTCC->funcao }}<br>
{{ $academico->AcademicoTCC->Empresa->nome }}<br>
{{ $academico->AcademicoTCC->Empresa->email }}<br>
{{ $academico->AcademicoTCC->Empresa->cnpj }}<br>
{{ $academico->AcademicoTCC->Empresa->supervisor }}<br>
@endsection
