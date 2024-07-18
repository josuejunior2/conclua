@extends('layouts.app')

@include('academico.atividade.modal.entrega')

@section('content')
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Atividade {{ $atividade->titulo }}</h3>
            <div class="d-flex justify-content-between col-auto">
                @if(empty($atividade->SubmissaoAtividade) && $semestreIsAtual)
                    <div>
                        <a href="#" class="btn btn-primary w-100 mb-1" data-bs-toggle="modal" data-bs-target="#modal-entrega-atividade">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
                            Submeter atividade
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="datagrid mb-3">
                <div class="datagrid-item">
                    <div class="datagrid-title">Criada em</div>
                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->created_at)->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Atualizada em</div>
                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->updated_at)->format('d/m/Y H:i') }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Data-limite para entrega</div>
                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') }}
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Data de entrega</div>
                    <div class="datagrid-content">
                        {{ $atividade->data_entrega ? \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') : 'N/A' }}
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Nota</div>
                    <div class="datagrid-content">
                        <b>{{ $atividade->nota ? $atividade->nota : 'N/A' }}</b>
                    </div>
                </div>
            </div>
            <div class="col-12 markdown">
                <h3>Descrição</h3>
                <p>{{ $atividade->descricao }}</p>
            </div>
            @include('arquivo.download-auxiliar')
        </div>
    </div>
    @if(!empty($atividade->SubmissaoAtividade))
        <div class="card m-3">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Submissão {{ \Carbon\Carbon::parse($atividade->SubmissaoAtividade->created_at)->format('d/m/Y H:i') }}</h3>
            </div>
            <div class="card-body">
                <div class="col-12 markdown">

                    @include('arquivo.download-submissao')
                    
                    <h3>Comentário</h3>
                    <p>{{ $atividade->SubmissaoAtividade->comentario }}</p>
                </div>
            </div>
        </div>
    @endif
@endsection
