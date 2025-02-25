@extends('layouts.admin')


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Home
                    </div>
                    <h2 class="page-title">
                        Administrador
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl m-1">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="row row-cards">
                        <div class="col-md-2">
                            <a class="card card-link" href="{{ route('admin.semestre.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">Semestres</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a class="card card-link" href="{{ route('admin.orientador.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">Orientadores</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a class="card card-link" href="{{ route('admin.academico.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">Acadêmicos</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a class="card card-link" href="{{ route('admin.orientacao.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-safari"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 16l2 -6l6 -2l-2 6l-6 2" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /></svg>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">Orientações</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a class="card card-link" href="{{ route('admin.atividade.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z" /></svg>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">Atividades</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a class="card card-link" href="{{ route('admin.empresa.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21h18" /><path d="M5 21v-12l5 4v-4l5 4h4" /><path d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582" /><path d="M9 17h1" /><path d="M14 17h1" /></svg>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">Empresas</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xl m-1">
            <div class="row row-deck row-cards">
                <div class="col-md-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 37rem">
                                <div class="card-header justify-content-between">
                                    <h3 class="card-title">Orientadores ativos</h3>
                                    <div class="text-muted">Quantidade:
                                        {{ $orientadores->count() }}</div>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        @foreach ($orientadores as $orientador)
                                            <div>
                                                <div class="row">
                                                    <a href="{{ route('admin.orientador.show', ['orientador' => $orientador]) }}"
                                                        class="card card-link card-link-pop">
                                                        <div class="card-body">
                                                            {{ $orientador->AdminTrashed->nome }} completou o cadastro no sistema.
                                                            <div class="text-muted">{{ $orientador->updated_at->format('d/m/Y H:i') }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 37rem">
                                <div class="card-header justify-content-between">
                                    <h3 class="card-title">Solicitações</h3>
                                    <div class="text-muted">Quantidade:
                                        {{ $solicitacoes->count() }}</div>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        @foreach ($solicitacoes as $solicitacao)
                                            <div>
                                                <div class="row">
                                                    <a href="{{ route('admin.academico.show', ['academico' => $solicitacao->AcademicoTrashed]) }}"
                                                        class="card card-link card-link-pop">
                                                        <div class="card-body">
                                                            {{ $solicitacao->AcademicoTrashed->UserTrashed->nome }} solicitou vinculação a {{ $solicitacao->OrientadorTrashed->AdminTrashed->nome }}.
                                                            <div class="text-muted">{{ $solicitacao->created_at->format('d/m/Y H:i') }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 37rem">
                                <div class="card-header justify-content-between">
                                    <h3 class="card-title">Orientações</h3>
                                    <div class="text-muted">Quantidade:
                                        {{ $orientacoes->count() }}</div>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        @foreach ($orientacoes as $orientacao)
                                            <div>
                                                <div class="row">
                                                    <a href="{{ route('admin.academico.show', ['academico' => $orientacao->AcademicoTrashed]) }}"
                                                        class="card card-link card-link-pop">
                                                        <div class="card-body">
                                                            {{ $orientacao->OrientadorTrashed->AdminTrashed->nome }} está orientando {{ $orientacao->AcademicoTrashed->UserTrashed->nome }}.
                                                            <div class="text-muted">{{ $orientacao->created_at->format('d/m/Y H:i') }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
