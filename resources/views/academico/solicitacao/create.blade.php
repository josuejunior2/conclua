@extends('layouts.app')

@section('content')
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Cadastro do(a) Professor(a) {{ $orientador->Admin->nome }}</h3>
            {{-- <div class="d-flex justify-content-between col-auto">
        </div> --}}
        </div>
        <div class="card-body">
            <div class="datagrid mb-4">
                <div class="datagrid-item">
                    <div class="datagrid-title">Email</div>
                    <div class="datagrid-content">{{ $orientador->Admin->email }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Formação</div>
                    <div class="datagrid-content">{{ $orientador->Formacao->nome ?? 'N/A'  }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Área de atuação</div>
                    <div class="datagrid-content">{{ $orientador->Area->nome ?? 'N/A'  }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Currículo Lattes</div>
                    <div class="datagrid-content">{{ $orientador->enderecoLattes }}</div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Currículo Orcid</div>
                    <div class="datagrid-content">{{ $orientador->enderecoOrcid }}</div>
                </div>
                @if ($orientador->subArea1)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Sub-área 1</div>
                        <div class="datagrid-content">{{ $orientador->subArea1 }}</div>
                    </div>
                @endif
                @if ($orientador->subArea2)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Sub-área 2</div>
                        <div class="datagrid-content">{{ $orientador->subArea2 }}</div>
                    </div>
                @endif
                @if ($orientador->subArea3)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Sub-área 3</div>
                        <div class="datagrid-content">{{ $orientador->subArea3 }}</div>
                    </div>
                @endif
                @if ($orientador->areaPesquisa1)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Área de Pesquisa 1</div>
                        <div class="datagrid-content">{{ $orientador->areaPesquisa1 }}</div>
                    </div>
                @endif
                @if ($orientador->areaPesquisa2)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Área de Pesquisa 2</div>
                        <div class="datagrid-content">{{ $orientador->areaPesquisa2 }}</div>
                    </div>
                @endif
                @if ($orientador->areaPesquisa3)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Área de Pesquisa 3</div>
                        <div class="datagrid-content">{{ $orientador->areaPesquisa3 }}</div>
                    </div>
                @endif
                @if ($orientador->areaPesquisa4)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Área de Pesquisa 4</div>
                        <div class="datagrid-content">{{ $orientador->areaPesquisa4 }}</div>
                    </div>
                @endif
                @if ($orientador->areaPesquisa5)
                    <div class="datagrid-item">
                        <div class="datagrid-title">Área de Pesquisa 5</div>
                        <div class="datagrid-content">{{ $orientador->areaPesquisa5 }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Revise seus dados</h3>
            <div class="d-flex justify-content-between col-auto">
                @if (isset($tcc))
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
                    </a>
                @elseif (isset($estagio))
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
                        Editar Estagio
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if (isset($tcc))
                <div class="accordion" id="accordion">
                    <div class="accordion-item m-3">
                        <div class="d-flex justify-content-between" id="heading-1">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                data-bs-target="#accordion-collapse-{{ $tcc->id }}" aria-expanded="true">
                                {{ $tcc->tema }}
                            </button>
                        </div>
                        <div id="accordion-collapse-{{ $tcc->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordion-{{ $tcc->id }}">
                            <div class="accordion-body pt-0">
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
            @elseif (isset($estagio))
                <div class="datagrid mb-4">
                    <div class="datagrid-item">
                        <div class="datagrid-title">Modalidade</div>
                        <div class="datagrid-content">Estágio</div>
                    </div>
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
        </div>
    </div>

    <div class="card m-3">
        <div class="card-body">
            <form method="POST" action="{{ route('solicitacao.store') }}" autocomplete="off" novalidate>
                @csrf
                @if (isset($tcc))
                    <input id="academico_tcc_id" name="academico_tcc_id" type="hidden" class="form-control"
                        value="{{ $tcc->id }}">
                @elseif (isset($estagio))
                    <input id="academico_estagio_id" name="academico_estagio_id" type="hidden" class="form-control"
                        value="{{ $estagio->id }}">
                @endif
                <input id="academico_id" name="academico_id" type="hidden" class="form-control"
                    value="{{ $academico->id }}">
                <input id="orientador_id" name="orientador_id" type="hidden" class="form-control"
                    value="{{ $orientador->id }}">
                <input id="semestre_id" name="semestre_id" type="hidden" class="form-control"
                    value="{{ session('semestre_id') }}">
                <div class="mb-3">
                    <label class="form-label">Mensagem ao orientador</label>
                    <textarea id="mensagem" class="form-control" name="mensagem" rows="6" placeholder="(Opcional)"
                        value="{{ old('mensagem', '') }}"></textarea>
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
