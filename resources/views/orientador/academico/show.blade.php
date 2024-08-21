@extends(auth()->guard('admin')->user()->hasRole('Orientador') ? 'layouts.orientador' : 'layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Academico</h3>
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
                            </div>
                            <div class="row mt-2 g-4">
                                <div class="col-12 markdown">
                                    <h2>Tema</h2>
                                    <p>{{ $orientacao->AcademicoEstagio->tema }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Função</h2>
                                    <p>{{ $orientacao->AcademicoEstagio->funcao }}</p>
                                </div>
                                <div class="col-12 markdown">
                                    <h2>Empresa</h2>
                                    <p>{{ $orientacao->AcademicoEstagio->Empresa->nome }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if (!empty($solicitacoes))
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
