@extends('layouts.app');

@section('content')
{{ $academico->AcademicoTCC->tema }}<br>
{{ $academico->AcademicoTCC->problema }}<br>
{{ $academico->AcademicoTCC->objetivo_especifico }}<br>
{{ $academico->AcademicoTCC->objetivo_geral }}<br>
{{ $academico->AcademicoTCC->justificativa }}<br>
{{ $academico->AcademicoTCC->metodologia }}<br>
@endsection
