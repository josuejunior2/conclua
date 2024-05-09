@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Academico</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href=" {{ route('academico.edit', ['academico' => $academico->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a> {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
            <form id="form_{{$academico->id}}" method="post" action="{{ route('admin.academico.destroy', ['academico' => $academico->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$academico->id}}').submit()" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    Excluir cadastro
                </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $academico->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Matrícula</div>
            <div class="datagrid-content">{{ $academico->matricula }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $academico->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Criação do usuário</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($academico->created_at)->format('d/m/Y') }}</div>
        </div>
    </div>
</div>

@if (isset($tccs))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">TCC</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                @foreach ($tccs->sortByDesc('created_at') as $key => $tcc) {{-- ->sortBy('nome')--}}
                    <div class="accordion-item m-3">
                        <div class="d-flex justify-content-between" id="heading-1">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $tcc->id }}" aria-expanded="true">
                                ({{ $tcc->Semestre->periodo }}/{{ $tcc->Semestre->ano }}){{ $tcc->tema }}
                            </button>
                        </div>
                        <div id="accordion-collapse-{{ $tcc->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $tcc->id }}">
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
                                            <div class="datagrid-content">{{ $tcc->Orientacao->Orientador->nome }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Data de vinculação</div>
                                            <div class="datagrid-content">{{ \Carbon\Carbon::parse($tcc->Orientacao->created_at)->format('d/m/Y') }}</div>
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
                @endforeach
            </div>
        </div>
    </div>
@endif
@if (isset($estagios))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Estágio</h3>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordion">
                @foreach ($estagios->sortByDesc('created_at') as $key => $estagio) {{-- ->sortBy('nome')--}}
                    <div class="accordion-item m-3">
                        <div class="d-flex justify-content-between" id="heading-1">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $estagio->id }}" aria-expanded="true">
                                ({{ $estagio->Semestre->periodo }}/{{ $estagio->Semestre->ano }}){{ $estagio->tema }}
                            </button>
                        </div>
                        <div id="accordion-collapse-{{ $estagio->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $estagio->id }}">
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
                                            <div class="datagrid-content">{{ $estagio->Orientacao->Orientador->nome }}</div>
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
                @endforeach
            </div>
        </div>
    </div>
@endif

@endsection
