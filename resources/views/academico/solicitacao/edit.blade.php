@extends('layouts.app')

@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitação de vinculação a {{ $solicitacao->Orientador->Admin->nome }}</h3>
    </div>
    <div class="card-body">
        <div class="datagrid mb-4">
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->Admin->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Formação</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->Formacao->nome ?? 'N/A'  }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de atuação</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->Area->nome ?? 'N/A'  }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Lattes</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->enderecoLattes }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Orcid</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->enderecoOrcid }}</div>
            </div>
            @if ($solicitacao->Orientador->subArea1)
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 1</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->subArea1 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->subArea2)
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 2</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->subArea2 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->subArea3)
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 3</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->subArea3 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->areaPesquisa1)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 1</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->areaPesquisa1 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->areaPesquisa2)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 2</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->areaPesquisa2 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->areaPesquisa3)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 3</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->areaPesquisa3 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->areaPesquisa4)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 4</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->areaPesquisa4 }}</div>
            </div>
            @endif
            @if ($solicitacao->Orientador->areaPesquisa5)
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 5</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->areaPesquisa5 }}</div>
            </div>
            @endif
        </div>
        <form method="POST" action="{{ route('solicitacao.update', ['solicitacao' => $solicitacao]) }}" autocomplete="off" novalidate>
            @csrf
            @method('PUT')
            <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $solicitacao->Academico->id }}">
            <input id="orientador_id" name="orientador_id" type="hidden" class="form-control" value="{{ $solicitacao->Orientador->id }}">
            <input id="semestre_id" name="semestre_id" type="hidden" class="form-control" value="{{ $solicitacao->Semestre->id }}">
            <div class="mb-3">
                <label class="form-label">Mensagem ao orientador</label>
                <textarea id="mensagem" class="form-control" name="mensagem" rows="6" placeholder="(Opcional)">{{ $solicitacao->mensagem }}</textarea>
                <span class="{{ $errors->has('mensagem') ? 'text-danger' : '' }}">
                    {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}
                </span>
            </div>
            <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Atualizar solicitação
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
