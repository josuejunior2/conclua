@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Academico</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href=" {{ route('academico.edit', ['academico' => $academico->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a> {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
            <form id="form_{{$academico->id}}" method="post" action="{{ route('admin.academico.destroy', ['academico' => $academico->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$academico->id}}').submit()" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    Excluir cadastro
                </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $Academico->User->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $academico->matricula }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $Academico->User->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        @if (isset($tcc))
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">TCC</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Orientador</div>
            <div class="datagrid-content"></div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $especifico->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $especifico->resumo }}</div>
        </div>

        @elseif (isset($estagio))
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">Estágio</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Orientador</div>
            <div class="datagrid-content"></div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $especifico->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Função</div>
            <div class="datagrid-content">{{ $especifico->funcao }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Nome da Empresa</div>
            <div class="datagrid-content">{{ $especifico->Empresa->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">CNPJ da Empresa</div>
            <div class="datagrid-content">{{ $especifico->Empresa->cnpj }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Supervisor</div>
            <div class="datagrid-content">{{ $especifico->Empresa->supervisor }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email da Empresa/Supervisor</div>
            <div class="datagrid-content">{{ $especifico->Empresa->email }}</div>
        </div>

        @else
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">Cadastro incompleto.</div>
        </div>

        @endif
    </div>
</div>
@endsection
