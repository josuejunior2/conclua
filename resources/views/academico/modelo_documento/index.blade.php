@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Documentação
                @if (!empty($orientacao))
                    <span class="badge bg-{{ $orientacao->getStatusDocumentacao()["badge"] }} text-white ms-2">{{ $orientacao->getStatusDocumentacao()["status"] }}</span>
                @endif
            </h3>
        </div>
        <div class="card-body">
            @foreach ($modelos as $modelo)
            @if (session('semestreIsAtivo') && !empty($orientacao))
                @include('academico.modelo_documento.modal.add_arquivo_documentacao')
            @endif
            <div class="accordion" id="accordion-{{ $modelo->id }}">
                <div class="accordion-item m-3 @if(!empty($orientacao) && $modelo->isAtrasado($orientacao->id)) border-danger shadow-lg bg-white rounded @endif">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $modelo->id }}" aria-expanded="true">
                            @if(!empty($orientacao) && $modelo->isAtrasado($orientacao->id))
                                <div class="ribbon ribbon-top bg-red">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" /></svg>
                                </div>
                            @endif
                            {{$modelo->nome}} <small class="ms-3">{{$modelo->getNomeModalidade()}}</small>
                            @if(!empty($modelo->data_limite)) 
                                <div class="btn p-1 pe-none user-select-all ms-2">Data-limite:  {{ \Carbon\Carbon::parse($modelo->data_limite)->format('d/m/Y H:i') }}</div>
                            @endif
                        </button>
                        <div class="d-flex justify-content-between col-auto">
                            <div class="btn-group" role="group">
                                @if (session('semestreIsAtivo') && !empty($orientacao) && !$orientacao->status_documentacao)
                                    @can('submeter documentacao')
                                        <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-add-arquivo-documentacao-{{$modelo->id}}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9.5 13.5l2.5 -2.5l2.5 2.5" /></svg>
                                            Submeter
                                        </a>
                                    @endcan
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="accordion-collapse-{{ $modelo->id }}" class="accordion-collapse collapse show" data-bs-parent="#accordion-{{ $modelo->id }}">
                        <div class="accordion-body pt-1">
                            <div class="row">
                                @foreach ($modelo->arquivosModelo() as $arquivo)
                                    <div class="col-auto mb-3">
                                        <form id="form" method="post" class="flex-2 mb-0"
                                            action="{{ route('download.arquivo') }}">
                                            @csrf
                                            <input id="caminho" name="caminho" type="hidden" class="form-control"
                                                value="{{ $arquivo->caminho . '/' . $arquivo->nome }}">
                                            <button type="submit" class="btn btn-outline-secondary w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 11l5 5l5 -5" />
                                                    <path d="M12 4l0 12" />
                                                </svg>
                                                {{ $arquivo->nome }}
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <p>{{$modelo->descricao}}</p>
                            <hr class="m-2">
                            <div class="row">
                                @if (session('semestreIsAtivo') && !empty($orientacao))
                                    @foreach ($modelo->arquivosOrientacao($orientacao->id) as $arquivo)
                                        <div class="col-auto">
                                            <div class="card card-sm">
                                                <div class="card-header">
                                                    <h3 class="card-title">{{ $arquivo->nome }}</h3>
                                                    <span class="badge bg-{{ $arquivo->getStatusDocumentacao()["badge"] }} text-white ms-2">{{ $arquivo->getStatusDocumentacao()["status"] }}</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <form id="form" method="post" class="flex-2"
                                                                action="{{ route('download.arquivo') }}">
                                                                @csrf
                                                                <input id="caminho" name="caminho" type="hidden" class="form-control"
                                                                    value="{{ $arquivo->caminho . '/' . $arquivo->nome }}">
                                                                <button type="submit" class="btn btn-outline-secondary w-100">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                        <path d="M7 11l5 5l5 -5" />
                                                                        <path d="M12 4l0 12" />
                                                                    </svg>
                                                                    Baixar
                                                                </button>
                                                            </form>
                                                        </div>
                                                        @if($arquivo->status_documentacao != 1)
                                                            @can('excluir documentacao')
                                                                @include('academico.modelo_documento.modal.destroy_arquivo_documentacao')
                                                                <div class="col-auto">
                                                                    <form id="form_destroy_arquivo_documentacao{{ $arquivo->id }}" method="post"
                                                                        action="{{ route('arquivo.destroy.arquivo.documentacao', ['arquivo' => $arquivo]) }}">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <a href="#" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                                                            data-bs-target="#modal-destroy-arquivo-documentacao{{ $arquivo->id }}">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                                <path d="M4 7l16 0" />
                                                                                <path d="M10 11l0 6" />
                                                                                <path d="M14 11l0 6" />
                                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                            </svg>
                                                                            Excluir
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

