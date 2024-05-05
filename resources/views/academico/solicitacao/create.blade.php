@extends('layouts.app')

@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do(a) Professor(a) {{ $orientador->nome }}</h3>
        {{-- <div class="d-flex justify-content-between col-auto">
        </div> --}}
    </div>
    <div class="card-body">
        <div class="datagrid mb-4">
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $orientador->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Formação</div>
                <div class="datagrid-content">{{ $orientador->Formacao->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de atuação</div>
                <div class="datagrid-content">{{ $orientador->Area->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Lattes</div>
                <div class="datagrid-content">{{ $orientador->enderecoLattes }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Orcid</div>
                <div class="datagrid-content">{{ $orientador->enderecoOrcid }}</div>
            </div>
            @if ($orientador->subArea1)
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 1</div>
                <div class="datagrid-content">{{ $orientador->subArea1 }}</div>
            </div>
            @endif
            @if ($orientador->subArea2)
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 2</div>
                <div class="datagrid-content">{{ $orientador->subArea2 }}</div>
            </div>
            @endif
            @if ($orientador->subArea3)
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 3</div>
                <div class="datagrid-content">{{ $orientador->subArea3 }}</div>
            </div>
            @endif
            @if ($orientador->areaPesquisa1)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 1</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa1 }}</div>
            </div>
            @endif
            @if ($orientador->areaPesquisa2)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 2</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa2 }}</div>
            </div>
            @endif
            @if ($orientador->areaPesquisa3)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 3</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa3 }}</div>
            </div>
            @endif
            @if ($orientador->areaPesquisa4)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 4</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa4 }}</div>
            </div>
            @endif
            @if ($orientador->areaPesquisa5)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 5</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa5 }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Revise seus dados</h3>
        <div class="d-flex justify-content-between col-auto">
        @if ($academico->AcademicoTCC)
        <a href=" {{ route('academicoTCC.edit', ['academicoTCC' => $academico->AcademicoTCC ]) }}" class="btn me-2 btn-secondary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
            Editar
        </a>
        @elseif ($academico->AcademicoEstagio)
        <a href=" {{ route('empresa.edit', ['empresa' => $academico->AcademicoEstagio->Empresa ]) }}" class="btn me-2 btn-secondary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
            Editar Empresa
        </a>
        <a href=" {{ route('academicoEstagio.edit', ['academicoEstagio' => $academico->AcademicoEstagio ]) }}" class="btn me-2 btn-secondary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
            Editar Estagio
        </a>
        @endif
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid mb-4">
            @if ($academico->AcademicoTCC)
            <div class="datagrid-item">
                <div class="datagrid-title">Modalidade</div>
                <div class="datagrid-content">TCC</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Tema</div>
                <div class="datagrid-content">{{ $academico->AcademicoTCC->tema }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Problema</div>
                <div class="datagrid-content">{{ $academico->AcademicoTCC->problema }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Objetivo Geral</div>
                <div class="datagrid-content">{{ $academico->AcademicoTCC->objetivo_geral }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Objetivo Específico</div>
                <div class="datagrid-content">{{ $academico->AcademicoTCC->objetivo_especifico }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Justificativa</div>
                <div class="datagrid-content">{{ $academico->AcademicoTCC->justificativa }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Metodologia</div>
                <div class="datagrid-content">{{ $academico->AcademicoTCC->metodologia }}</div>
            </div>
            @elseif ($academico->AcademicoEstagio)
            <div class="datagrid-item">
                <div class="datagrid-title">Modalidade</div>
                <div class="datagrid-content">Estágio</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Tema</div>
                <div class="datagrid-content">{{ $academico->AcademicoEstagio->tema }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Função</div>
                <div class="datagrid-content">{{ $academico->AcademicoEstagio->funcao }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Nome da Empresa</div>
                <div class="datagrid-content">{{ $academico->AcademicoEstagio->Empresa->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">CNPJ da Empresa</div>
                <div class="datagrid-content">{{ $academico->AcademicoEstagio->Empresa->cnpj }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Supervisor</div>
                <div class="datagrid-content">{{ $academico->AcademicoEstagio->Empresa->supervisor }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email da Empresa/Supervisor</div>
                <div class="datagrid-content">{{ $academico->AcademicoEstagio->Empresa->email }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="card m-3">
    <div class="card-body">
    <form method="POST" action="{{ route('solicitacao.store') }}" autocomplete="off" novalidate>
        @csrf
        <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
        <input id="orientador_id" name="orientador_id" type="hidden" class="form-control" value="{{ $orientador->id }}">
        <input id="semestre_id" name="semestre_id" type="hidden" class="form-control" value="{{ $semestreAtual   }}">
        <div class="mb-3">
            <label class="form-label">Mensagem ao orientador</label>
            <textarea id="mensagem" class="form-control" name="mensagem" rows="6" placeholder="(Opcional)" value="{{ old('mensagem', '') }}"></textarea>
            <span class="{{ $errors->has('mensagem') ? 'text-danger' : '' }}">
                {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}
            </span>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Enviar solicitação
                </button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
