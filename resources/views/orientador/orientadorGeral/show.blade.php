@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Cadastro do Professor</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $orientadorGeral->name }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $orientadorGeral->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $orientadorGeral->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Formação</div>
            <div class="datagrid-content">{{ $orientadorGeral->Formacao ? $orientadorGeral->Formacao->formacao : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de atuação</div>
            <div class="datagrid-content">{{ $orientadorGeral->Area ? $orientadorGeral->Area->area : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->enderecoLattes : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->enderecoOrcid : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 1</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->subArea1 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 2</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->subArea2 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 3</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->subArea3 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 1</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->areaPesquisa1 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 2</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->areaPesquisa2 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 3</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->areaPesquisa3 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 4</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->areaPesquisa4 : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 5</div>
            <div class="datagrid-content">{{ $orientador ? $orientador->areaPesquisa5 : 'Cadastro incompleto' }}</div>
        </div>

        </div>
    </div>
    </div>
</div>
@endsection
