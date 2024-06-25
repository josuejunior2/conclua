@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Professor</h3>
        <div class="d-flex justify-content-between col-auto">
            {{-- <a href=" {{ route('orientador.edit', ['orientador' => $orientador->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a> --}} {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
            @can('CRUD usuarios')
                <form id="form_{{$orientador->id}}" method="post" action="{{ route('admin.orientador.destroy', ['orientador' => $orientador]) }}">
                    @method('DELETE')
                    @csrf
                    <!-- <button type="submit">Excluir</button>  -->
                    <a href="#" onclick="document.getElementById('form_{{$orientador->id}}').submit()" class="btn btn-danger w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Excluir cadastro
                    </a>
                </form>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $orientador->Admin->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $orientador->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $orientador->Admin->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content">{{$orientador->enderecoLattes}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content">{{$orientador->enderecoOrcid}}</div>
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
        <h3 class="card-title">Orientações</h3>
    </div>
    <div class="card-body">
        <div class="accordion" id="accordion">
            @foreach ($orientacoes->sortByDesc('created_at') as $key => $orientacao) {{-- ->sortBy('nome')--}}
                <div class="accordion-item m-3">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $orientacao->id }}" aria-expanded="true">
                            ({{ $orientacao->Semestre->periodo }}/{{ $orientacao->Semestre->ano }}) @if(isset($orientacao->AcademicoTCC)) TCC - @elseif(isset($orientacao->AcademicoEstagio)) Estágio - @endif {{ $orientacao->Academico->User->nome }}
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
                                            Desvincular acadêmico do orientador
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
                                    <div class="datagrid-content"><a href="{{ route('admin.academico.show', ['academico' => $orientacao->Academico]) }}">{{ $orientacao->Academico->User->nome }}</a></div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Data de vinculação</div>
                                    <div class="datagrid-content">{{ \Carbon\Carbon::parse($orientacao->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Semestre</div>
                                    <div class="datagrid-content">{{ $orientacao->Semestre->periodo }}º de {{ $orientacao->Semestre->ano }}</div>
                                </div>
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
                            @elseif(isset($orientacao->AcademicoEstagio))
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
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
