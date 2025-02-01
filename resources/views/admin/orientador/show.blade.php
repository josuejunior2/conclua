@extends('layouts.admin')

@include('admin.orientador.modal.destroy')
@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Orientador</h3>
        <div class="d-flex justify-content-between col-auto">
            @can('editar orientador')
                <div class="me-2">
                    <a href=" {{ route('admin.orientador.edit', ['orientador' => $orientador ]) }}" class="btn btn-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                        Editar
                    </a>
                </div>
            @endcan
            @can('excluir orientador')
                <form id="form_destroy_{{$orientador->id}}" method="post" action="{{ route('admin.orientador.destroy', ['orientador' => $orientador]) }}">
                    @method('DELETE')
                    @csrf
                    <!-- <button type="submit">Excluir</button>  -->
                    <a href="#" data-bs-toggle="modal"
                    data-bs-target="#modal-destroy-orientador-{{$orientador->id}}" class="btn btn-danger w-100">
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
            <div class="datagrid-content">{{ $orientador->AdminTrashed->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $orientador->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $orientador->AdminTrashed->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content"><a href="{{ $orientador->enderecoLattes }}" target="_blank">{{$orientador->enderecoLattes}}</a></div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content"><a href="{{ $orientador->enderecoOrcid }}" target="_blank">{{$orientador->enderecoOrcid}}</a></div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Subáreas</div>
            <div class="datagrid-content">@foreach($orientador->subAreas as $sub) {{ $sub->nome }}@if(!$loop->last),@endif @endforeach </div>
        </div>
    </div>
    </div>
</div>
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Orientações</h3>
    </div>
    <div class="card-body">
        <div class="accordion" id="accordion">
            @foreach ($orientacoes->sortByDesc('created_at') as $key => $orientacao) {{-- ->sortBy('nome')--}}
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $orientacao->id }}" aria-expanded="true">
                            ({{ $orientacao->Semestre->periodo }}/{{ $orientacao->Semestre->ano }}) @if(isset($orientacao->AcademicoTCC)) TCC - @elseif(isset($orientacao->AcademicoEstagio)) Estágio - @endif {{ $orientacao->AcademicoTrashed->UserTrashed->nome }}
                        </button>
                        <div class="d-flex justify-content-between col-auto">
                            @if(isset($orientacao->AcademicoTCC))
                                @include('admin.academico.modal.alert-desvincular-academico', ['modalidade' => $orientacao->AcademicoTCC])
                                @can('desvincular academico')
                                <div>
                                    <form id="form_desvincular_{{ $orientacao->AcademicoTCC->id }}" method="post" action="{{ route('admin.academico.desvincular.tcc', ['tcc' => $orientacao->AcademicoTCC]) }}" class="me-2">
                                        @csrf
                                        <!-- <button type="submit">Excluir</button> $orcamento->sites[$key] -->
                                        <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modal-desvincular-academico-{{ $orientacao->AcademicoTCC->id }}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l3 -3m2 -2l1 -1" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M3 3l18 18" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                            Desvincular
                                        </a>
                                    </form>
                                </div>
                                @endcan
                            @elseif(isset($orientacao->AcademicoEstagio))
                                @include('admin.academico.modal.alert-desvincular-academico', ['modalidade' => $orientacao->AcademicoEstagio])
                                @can('desvincular academico')
                                <div>
                                    <form id="form_desvincular_{{ $orientacao->AcademicoEstagio->id }}" method="post" action="{{ route('admin.academico.desvincular.estagio', ['estagio' => $orientacao->AcademicoEstagio]) }}" class="me-2">
                                        @csrf
                                        <!-- <button type="submit">Excluir</button> $orcamento->sites[$key] -->
                                        <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modal-desvincular-academico-{{ $orientacao->AcademicoEstagio->id }}">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l3 -3m2 -2l1 -1" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M3 3l18 18" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                            Desvincular acadêmico do orientador
                                        </a>
                                    </form>
                                </div>
                                @endcan
                            @endif
                        </div>
                    </div>
                    <div id="accordion-collapse-{{ $orientacao->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $orientacao->id }}">
                        <div class="accordion-body pt-0">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Nome</div>
                                    <div class="datagrid-content"><a href="{{ route('admin.academico.show', ['academico' => $orientacao->Academico]) }}">{{ $orientacao->AcademicoTrashed->UserTrashed->nome }}</a></div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Data de vinculação</div>
                                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($orientacao->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Semestre</div>
                                    <div class="datagrid-content">{{ $orientacao->Semestre->periodo }}º de {{ $orientacao->Semestre->ano }}</div>
                                </div>
                                @if(isset($orientacao->AcademicoEstagio))
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
                                        <div class="datagrid-title">CNPJ da Empresa</div>
                                        <div class="datagrid-content">{{ $orientacao->AcademicoEstagio->Empresa->cnpj }}</div>
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
                                @endif
                            </div>
                            @if(isset($orientacao->AcademicoTCC))
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
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
