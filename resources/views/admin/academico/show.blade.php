@extends('layouts.admin')

@include('admin.academico.modal.destroy')
@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Academico</h3>
        <div class="d-flex justify-content-between col-auto">
            @can('editar academico')
                <div class="me-2">
                    <a href=" {{ route('admin.academico.edit', ['academico' => $academico ]) }}" class="btn me-2 btn-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                        Editar
                    </a>
                </div>
            @endcan
            @can('excluir academico')
                <form id="form_destroy_{{$academico->id}}" method="post" action="{{ route('admin.academico.destroy', ['academico' => $academico]) }}">
                    @method('DELETE')
                    @csrf
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-destroy-academico-{{$academico->id}}" class="btn btn-danger w-100">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                        Bloquear acesso
                    </a>
                </form>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nome</div>
                <div class="datagrid-content">{{ $academico->User->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Matrícula</div>
                <div class="datagrid-content">{{ $academico->matricula }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $academico->User->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Criação do usuário</div>
                <div class="datagrid-content">{{ \Carbon\Carbon::parse($academico->created_at)->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>
</div>

@if (!empty($tcc))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">TCC</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-tcc-{{ $tcc->id }}" aria-expanded="true">
                            ({{ $tcc->Semestre->periodo }}/{{ $tcc->Semestre->ano }}){{ $tcc->tema }}
                        </button>
                    </div>
                    <div id="accordion-collapse-tcc-{{ $tcc->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $tcc->id }}">
                        <div class="accordion-body pt-0">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Data do cadastro</div>
                                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($tcc->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Semestre</div>
                                    <div class="datagrid-content">{{ $tcc->Semestre->periodo }}º de {{ $tcc->Semestre->ano }}</div>
                                </div>
                                @if(isset($tcc->Orientacao))
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Orientador</div>
                                        <div class="datagrid-content">{{ $tcc->Orientacao->OrientadorTrashed->AdminTrashed->nome }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Data de vinculação</div>
                                        <div class="datagrid-content">{{ \Carbon\Carbon::parse($tcc->Orientacao->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="d-flex justify-content-between col-auto">
                                            @include('admin.academico.modal.alert-desvincular-academico', ['modalidade' => $tcc])
                                            @can('desvincular academico')
                                                @if(session('semestreIsAtivo'))
                                                    <div>
                                                        <form id="form_desvincular_{{ $tcc->id }}" method="post" action="{{ route('admin.academico.desvincular.tcc', ['tcc' => $tcc]) }}" class="me-2">
                                                            @csrf
                                                            <!-- <button type="submit">Excluir</button> $orcamento->sites[$key] -->
                                                            <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modal-desvincular-academico-{{ $tcc->id }}">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l3 -3m2 -2l1 -1" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M3 3l18 18" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                                                Desvincular
                                                            </a>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endcan
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-2 g-4">
                                <div class="col-12 markdown">
                                    <h2>Tema</h2>
                                    <p>{{ $tcc->tema }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Problema</h2>
                                    <p>{{ $tcc->problema }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Objetivo específico</h2>
                                    <p>{{ $tcc->objetivo_especifico }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Objetivo geral</h2>
                                    <p>{{ $tcc->objetivo_geral }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Justificativa</h2>
                                    <p>{{ $tcc->justificativa }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Metodologia</h2>
                                    <p>{{ $tcc->metodologia }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (!empty($estagio))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Estágio</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-estagio-{{ $estagio->id }}" aria-expanded="true">
                            ({{ $estagio->Semestre->periodo }}/{{ $estagio->Semestre->ano }}){{ $estagio->tema }}
                        </button>
                        <div class="d-flex justify-content-between col-auto">
                            @if(isset($estagio->Orientacao))
                                @include('admin.academico.modal.alert-desvincular-academico', ['modalidade' => $estagio])
                                @can('desvincular academico')
                                @if(session('semestreIsAtivo'))
                                <div>
                                    <form id="form_desvincular_{{ $estagio->id }}" method="post" action="{{ route('admin.academico.desvincular.estagio', ['estagio' => $estagio ]) }}" class="me-2">
                                        @csrf
                                        <!-- <button type="submit">Excluir</button> $orcamento->sites[$key] -->
                                        <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modal-desvincular-academico-{{ $estagio->id }}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l3 -3m2 -2l1 -1" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M3 3l18 18" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                            Desvincular
                                        </a>
                                    </form>
                                </div>
                                @endif
                                @endcan
                            @endif
                        </div>
                    </div>
                    <div id="accordion-collapse-estagio-{{ $estagio->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $estagio->id }}">
                        <div class="accordion-body pt-0">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Data do cadastro</div>
                                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($estagio->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Semestre</div>
                                    <div class="datagrid-content">{{ $estagio->Semestre->periodo }}º de {{ $estagio->Semestre->ano }}</div>
                                </div>
                                @if(isset($estagio->Orientacao))
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Orientador</div>
                                        <div class="datagrid-content">{{ $estagio->Orientacao->OrientadorTrashed->AdminTrashed->nome }} <a href="mailto:{{ $estagio->Orientacao->OrientadorTrashed->AdminTrashed->email }}">{{ $estagio->Orientacao->OrientadorTrashed->AdminTrashed->email }}</a></div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Data de vinculação</div>
                                        <div class="datagrid-content">{{ \Carbon\Carbon::parse($estagio->Orientacao->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                @endif
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Tema</div>
                                    <div class="datagrid-content">{{ $estagio->tema }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Setor de atuação</div>
                                    <div class="datagrid-content">{{ $estagio->setor_atuacao }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Nome da Empresa</div>
                                    <div class="datagrid-content">{{ $estagio->Empresa->nome }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">CNPJ da Empresa</div>
                                    <div class="datagrid-content">{{ $estagio->Empresa->cnpj }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email da empresa</div>
                                    <div class="datagrid-content">{{ $estagio->Empresa->email }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Supervisor</div>
                                    <div class="datagrid-content">{{ $estagio->supervisor }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email do supervisor</div>
                                    <div class="datagrid-content">{{ $estagio->email_supervisor }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($modelos)
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Documentação <span class="badge bg-{{ $orientacao->getStatusDocumentacao()["badge"] }} text-white ms-2">{{ $orientacao->getStatusDocumentacao()["status"] }}</span></h3>
            @include('admin.modelo_documento.modal.status-documentacao-orientacao')
            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-status-documentacao-orientacao-{{ $orientacao->id }}">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-like"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 16m0 1a1 1 0 0 1 1 -1h1a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1z" /><path d="M6 20a1 1 0 0 0 1 1h3.756a1 1 0 0 0 .958 -.713l1.2 -3c.09 -.303 .133 -.63 -.056 -.884c-.188 -.254 -.542 -.403 -.858 -.403h-2v-2.467a1.1 1.1 0 0 0 -2.015 -.61l-1.985 3.077v4z" /><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12.1v-7.1a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-2.3" /></svg>
                Avaliar
            </a>
        </div>
        <div class="card-body">
            @foreach ($modelos as $modelo)
            @include('academico.modelo_documento.modal.add_arquivo_documentacao')
            <div class="accordion" id="accordion-{{ $modelo->id }}">
                <div class="accordion-item m-3 @if($modelo->isAtrasado($orientacao->id)) border-danger shadow-lg bg-white rounded @endif">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $modelo->id }}" aria-expanded="true">
                            @if($modelo->isAtrasado($orientacao->id))
                                <div class="ribbon ribbon-top bg-red">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" /></svg>
                                </div>
                            @endif
                            {{$modelo->nome}} <small class="ms-3">{{$modelo->getNomeModalidade()}}</small>
                            @if(!empty($modelo->data_limite)) 
                                <div class="btn p-1 pe-none user-select-all ms-2">Data-limite:  {{ \Carbon\Carbon::parse($modelo->data_limite)->format('d/m/Y H:i') }}</div>
                            @endif
                        </button>
                    </div>
                    <div id="accordion-collapse-{{ $modelo->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $modelo->id }}">
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
                                @foreach ($modelo->arquivosOrientacao($orientacao->id) as $arquivo)
                                    @include('orientador.modelo_documento.modal.status-documentacao')
                                    <div class="col-auto">
                                        <div class="card card-sm">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $arquivo->nome }} <small class="form-hint">{{ \Carbon\Carbon::parse($arquivo->created_at)->format('d/m/Y H:i') }}</small></h3>
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
                                                    @can('avaliar documentacao')
                                                        <div class="col">
                                                            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-status-documentacao-{{$arquivo->id}}">
                                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-progress"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" /><path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" /><path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" /><path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" /><path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" /></svg>
                                                                Avaliar
                                                            </a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif

@if ($solicitacoes->isNotEmpty())
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitações</h3>
    </div>
    <div class="card-body">
        <div class="accordion" id="accordion">
            @foreach ($solicitacoes->sortByDesc('created_at') as $key => $solicitacao) {{-- ->sortBy('nome')--}}
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $solicitacao->id }}" aria-expanded="true">
                            ({{ $solicitacao->Semestre->periodo }}/{{ $solicitacao->Semestre->ano }}) {{ $solicitacao->OrientadorTrashed->AdminTrashed->nome }} - {{ \Carbon\Carbon::parse($solicitacao->created_at)->format('d/m/Y') }}
                        </button>
                    </div>
                    <div id="accordion-collapse-{{ $solicitacao->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $solicitacao->id }}">
                        <div class="accordion-body pt-0">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Data da solicitação</div>
                                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($solicitacao->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Status da solicitação</div>
                                    <div class="datagrid-content">
                                        @if (is_null($solicitacao->status))
                                            <span class="badge bg-indigo text-white">Aguardando resposta</span>
                                        @elseif (!$solicitacao->status)
                                            <span class="badge bg-red text-white">Rejeitada</span>
                                        @elseif ($solicitacao->status)
                                            <span class="badge bg-green text-white">Aceita</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Mensagem enviada</div>
                                    <div class="datagrid-content">{{ $solicitacao->mensagem }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Orientador</div>
                                    <div class="datagrid-content"><a href="{{ route('admin.orientador.show', ['orientador' => $solicitacao->OrientadorTrashed]) }}">{{ $solicitacao->OrientadorTrashed->AdminTrashed->nome }}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
