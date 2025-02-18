@extends('layouts.app')

@section('content')

    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Cadastro do Academico</h3>
            @if(session('semestreIsAtivo'))
            <div class="d-flex justify-content-between col-auto">
                <a href=" {{ route('academico.edit', ['academico' => $academico]) }}"
                    class="btn me-2 btn-secondary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                        <path d="M13.5 6.5l4 4" />
                    </svg>
                    Editar
                </a>
            </div>
            @endif
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
            </div>
        </div>
    </div>

    @if (isset($tcc))
        <div class="card m-3">
            <div class="card-header justify-content-between">
                <h3 class="card-title">TCC</h3>
            @if(session('semestreIsAtivo'))
                <div class="d-flex justify-content-between col-auto">
                    <a href=" {{ route('academicoTCC.edit', ['academicoTCC' => $tcc]) }}"
                        class="btn me-2 btn-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                        Editar
                    </a> {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
                </div>
            @endif
            </div>
            <div class="card-body">
                @if (isset($tcc->Orientacao))
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Orientador</div>
                            <div class="datagrid-content">{{ $tcc->Orientacao->OrientadorTrashed->AdminTrashed->nome }} <a href="mailto:{{ $tcc->Orientacao->OrientadorTrashed->AdminTrashed->email }}">{{ $tcc->Orientacao->OrientadorTrashed->AdminTrashed->email }}</a></div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Data de vinculação</div>
                            <div class="datagrid-content">
                                {{ \Carbon\Carbon::parse($tcc->Orientacao->created_at)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                @endif
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
    @elseif (isset($estagio))
        <div class="card m-3">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Estágio</h3>
            @if(session('semestreIsAtivo') && empty($estagio->Orientacao->avaliacao_final))
                <div class="d-flex justify-content-between col-auto">
                    <a href=" {{ route('empresa.alteraEmpresa', ['empresa' => $estagio->Empresa, 'estagio' => $estagio]) }}"
                        class="btn me-2 btn-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                        Alterar empresa
                    </a>
                    <a href=" {{ route('academicoEstagio.edit', ['academicoEstagio' => $estagio]) }}"
                        class="btn me-2 btn-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                        </svg>
                        Editar
                    </a> {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
                </div>
            @endif
            </div>
            <div class="card-body">
                <div class="datagrid">
                @if (isset($estagio->Orientacao))
                    <div class="datagrid-item">
                        <div class="datagrid-title">Orientador</div>
                        <div class="datagrid-content">{{ $estagio->Orientacao->OrientadorTrashed->AdminTrashed->nome }} <a href="mailto:{{ $estagio->Orientacao->OrientadorTrashed->AdminTrashed->email }}">{{ $estagio->Orientacao->OrientadorTrashed->AdminTrashed->email }}</a></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Data de vinculação</div>
                        <div class="datagrid-content">
                            {{ \Carbon\Carbon::parse($estagio->Orientacao->created_at)->format('d/m/Y') }}</div>
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
    @endif
@endsection
