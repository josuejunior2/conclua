@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Semestre</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href=" {{ route('admin.semestre.edit', ['semestre' => $semestre->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a>
            <form id="form_{{$semestre->id}}" method="post" action="{{ route('admin.semestre.destroy', ['semestre' => $semestre->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$semestre->id}}').submit()" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    Excluir
                </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Ano</div>
            <div class="datagrid-content">{{ $semestre->ano }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">N° do Semestre</div>
            <div class="datagrid-content">{{ $semestre->periodo }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data de início</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($semestre->data_inicio)->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data final</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($semestre->data_fim)->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data-limite de envio da documentação de estágio</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($semestre->limite_doc_estagio)->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data-limite de envio da documentação de orientação</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($semestre->limite_orientacao)->format('d/m/Y') }}</div>
        </div>
    </div>
</div>
@endsection
