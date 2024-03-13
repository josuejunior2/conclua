@extends('layouts.app')

@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do(a) Professor(a) {{ $orientador->OrientadorGeral->nome }}</h3>
        {{-- <div class="d-flex justify-content-between col-auto">
        </div> --}}
    </div>
    <div class="card-body">
        <div class="datagrid mb-4">
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $orientador->OrientadorGeral->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Formação</div>
                <div class="datagrid-content">{{ $orientador->OrientadorGeral->Formacao->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de atuação</div>
                <div class="datagrid-content">{{ $orientador->OrientadorGeral->Area->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Lattes</div>
                <div class="datagrid-content">{{ $orientador->enderecoLattes }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Orcid</div>
                <div class="datagrid-content">{{ $orientador->enderecoOrcid }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 1</div>
                <div class="datagrid-content">{{ $orientador->subArea1 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 2</div>
                <div class="datagrid-content">{{ $orientador->subArea2 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Sub-área 3</div>
                <div class="datagrid-content">{{ $orientador->subArea3 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 1</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa1 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 2</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa2 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 3</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa3 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 4</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa4 }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Área de Pesquisa 5</div>
                <div class="datagrid-content">{{ $orientador->areaPesquisa5 }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('solicitacao.store') }}" autocomplete="off" novalidate>
            @csrf
            <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
            <input id="orientadorGeral_id" name="orientadorGeral_id" type="hidden" class="form-control" value="{{ $orientador->id }}">
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
