@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Professor</h3>
        <div class="d-flex justify-content-between col-auto">
            {{-- <a href=" {{ route('orientadorgeral.edit', ['orientadorgeral' => $orientadorgeral->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a> --}} {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
            <form id="form_{{$orientadorgeral->id}}" method="post" action="{{ route('orientadorgeral.destroy', ['orientadorgeral' => $orientadorgeral->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$orientadorgeral->id}}').submit()" class="btn btn-danger w-100">Excluir cadastro</a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $orientadorgeral->name }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $orientadorgeral->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $orientadorgeral->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Formação</div>
            <div class="datagrid-content">{{ $orientadorgeral->Formacao ? $orientadorgeral->Formacao->formacao : 'Cadastro incompleto' }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de atuação</div>
            <div class="datagrid-content">{{ $orientadorgeral->Area ? $orientadorgeral->Area->area : 'Cadastro incompleto' }}</div>
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
