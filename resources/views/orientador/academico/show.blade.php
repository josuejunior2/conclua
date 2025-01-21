@extends('layouts.orientador')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Academico</h3>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nome</div>
                <div class="datagrid-content">{{ $academico->UserTrashed->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Matrícula</div>
                <div class="datagrid-content">{{ $academico->matricula }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $academico->UserTrashed->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Criação do usuário</div>
                <div class="datagrid-content">{{ \Carbon\Carbon::parse($academico->created_at)->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>
</div>

@if (!empty($orientacao->AcademicoTCC))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">TCC</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-tcc-{{ $orientacao->AcademicoTCC->id }}" aria-expanded="true">
                            ({{ $orientacao->AcademicoTCC->Semestre->periodo }}/{{ $orientacao->AcademicoTCC->Semestre->ano }}){{ $orientacao->AcademicoTCC->tema }}
                        </button>
                    </div>
                    <div id="accordion-collapse-tcc-{{ $orientacao->AcademicoTCC->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $orientacao->AcademicoTCC->id }}">
                        <div class="accordion-body pt-0">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Data de vinculação</div>
                                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($orientacao->created_at)->format('d/m/Y') }}</div>
                                </div>
                            </div>
                            <div class="row mt-2 g-4">
                                <div class="col-12 markdown">
                                    <h2>Tema</h2>
                                    <p>{{ $orientacao->AcademicoTCC->tema }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Problema</h2>
                                    <p>{{ $orientacao->AcademicoTCC->problema }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Objetivo específico</h2>
                                    <p>{{ $orientacao->AcademicoTCC->objetivo_especifico }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Objetivo geral</h2>
                                    <p>{{ $orientacao->AcademicoTCC->objetivo_geral }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Justificativa</h2>
                                    <p>{{ $orientacao->AcademicoTCC->justificativa }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Metodologia</h2>
                                    <p>{{ $orientacao->AcademicoTCC->metodologia }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (!empty($orientacao->AcademicoEstagio))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Estágio</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-estagio-{{ $orientacao->AcademicoEstagio->id }}" aria-expanded="true">
                            ({{ $orientacao->AcademicoEstagio->Semestre->periodo }}/{{ $orientacao->AcademicoEstagio->Semestre->ano }}){{ $orientacao->AcademicoEstagio->tema }}
                        </button>
                    </div>
                    <div id="accordion-collapse-estagio-{{ $orientacao->AcademicoEstagio->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $orientacao->AcademicoEstagio->id }}">
                        <div class="accordion-body pt-0">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title">Data de vinculação</div>
                                        <div class="datagrid-content">{{ \Carbon\Carbon::parse($orientacao->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Tema</div>
                                    <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->tema }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Setor de atuação</div>
                                    <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->setor_atuacao }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Nome da Empresa</div>
                                    <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->Empresa->nome }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email da empresa</div>
                                    <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->Empresa->email }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Supervisor</div>
                                    <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->supervisor }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email do supervisor</div>
                                    <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->email_supervisor }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- @if (!empty($solicitacoes))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Solicitações</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                @foreach ($solicitacoes->sortByDesc('created_at') as $key => $solicitacao)
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
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif --}}

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Avaliação</h3>
    </div>
    <div class="card-body">
        <div class="accordion" id="accordion">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                        <th>Título</th>
                        <th>Criada em</th>
                        <th>Data-limite</th>
                        <th>Entregue em</th>
                        <th>Nota</th>
                        <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orientacao->atividades->sortByDesc('created_at') as $key => $atividade) {{-- ->sortBy('nome')--}}
                            <tr>
                                <td>{{ $atividade->titulo }}</td>
                                <td>{{ \Carbon\Carbon::parse($atividade->created_at)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') }}</td>
                                <td>{{ $atividade->data_entrega ? \Carbon\Carbon::parse($atividade->data_entrega)->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td><b>{{ $atividade->nota ? $atividade->nota : 'N/A' }}</b></td>
                                <td class="d-flex align-items-center justify-content-center text-end">
                                    <a href="{{ route('orientador.atividade.show', ['atividade' => $atividade]) }}" class="btn btn-secondary w-100 ">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer text-end d-flex justify-content-end">
        <form method="POST" action="{{ route('orientador.avaliacao.store', ['orientacao' => $orientacao]) }}" autocomplete="off" novalidate class="w-75">
            @csrf
            @method('PUT')
            <div class="row justify-content-end">
                <div class="col align-content-center">
                    Nota total: {{ $orientacao->notaTotal() }}
                </div>
                <div class="col-md-2">
                    <select class="form-select w-100" name="avaliacao_final" id="avaliacao_final" value="{{ $orientacao->avaliacao_final }}">
                        <option value="">Selecione um conceito</option>
                        <option value="APTO" @if($orientacao->avaliacao_final =='APTO') selected @endif>APTO</option>
                        <option value="APTO COM RESTRICOES" @if($orientacao->avaliacao_final == 'APTO COM RESTRICOES') selected @endif>APTO COM RESTRIÇÕES</option>
                        <option value="INAPTO" @if($orientacao->avaliacao_final =='INAPTO') selected @endif>INAPTO</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <div class="btn-list justify-content-end">
                        @if(session('semestreIsAtivo'))
                            <button type="submit" class="btn btn-primary">
                                Enviar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
