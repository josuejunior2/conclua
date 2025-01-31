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
                <div class="datagrid-title">Currículo Lattes</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->enderecoLattes }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Orcid</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->enderecoOrcid }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Subáreas</div>
                <div class="datagrid-content">@foreach($solicitacao->Orientador->subAreas as $sub) {{ $sub->nome }}@if(!$loop->last),@endif @endforeach </div>
            </div>
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
