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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-destroy-academico" class="btn btn-danger w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Excluir
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
                                        <div class="datagrid-content">{{ $tcc->Orientacao->Orientador->Admin->nome }}</div>
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
                                                                Desvincular acadêmico do orientador
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
                                            Desvincular acadêmico do orientador
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
                                        <div class="datagrid-content">{{ $estagio->Orientacao->Orientador->Admin->nome }}</div>
                                    </div>
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Data de vinculação</div>
                                        <div class="datagrid-content">{{ \Carbon\Carbon::parse($estagio->Orientacao->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-2 g-4">
                                <div class="col-12 markdown">
                                    <h2>Tema</h2>
                                    <p>{{ $estagio->tema }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Função</h2>
                                    <p>{{ $estagio->funcao }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Empresa</h2>
                                    <p>{{ $estagio->Empresa->nome }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if ($solicitacoes)
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
                            ({{ $solicitacao->Semestre->periodo }}/{{ $solicitacao->Semestre->ano }}) {{ $solicitacao->Orientador->Admin->nome }} - {{ \Carbon\Carbon::parse($solicitacao->created_at)->format('d/m/Y') }}
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
                                    <div class="datagrid-content"><a href="{{ route('admin.orientador.show', ['orientador' => $solicitacao->Orientador]) }}">{{ $solicitacao->Orientador->Admin->nome }}</a></div>
                                </div>
                                @if (isset($solicitacao->AcademicoTCC))
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Modalidade</div>
                                    <div class="datagrid-content">TCC</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Tema</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->tema }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Problema</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->problema }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Objetivo Geral</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->objetivo_geral }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Objetivo Específico</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->objetivo_especifico }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Justificativa</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->justificativa }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Metodologia</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->metodologia }}</div>
                                </div>
                                @elseif (isset($solicitacao->AcademicoEstagio))
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Modalidade</div>
                                    <div class="datagrid-content">Estágio</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Tema</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->tema }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Função</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->funcao }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Nome da Empresa</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->nome }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">CNPJ da Empresa</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->cnpj }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Supervisor</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->supervisor }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email da Empresa/Supervisor</div>
                                    <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->email }}</div>
                                </div>
                                @endif
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
