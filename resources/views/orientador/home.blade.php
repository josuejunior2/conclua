@extends('layouts.admin')


@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="row row-cards">
                    <div class="col-12">
                    <div class="card" style="height: 28rem">
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            @foreach ($solicitacoes as $s)
                            <div>
                            <div class="row">
                                <div class="col">
                                <div class="text-truncate">
                                    {{ $s->Academico->nome }}
                                </div>
                                <div class="text-muted">{{ $s->created_at->format('d/m/Y') }}</div>
                                </div>
                                <div class="col-auto align-self-center">
                                    <a href="{{ route('solicitacao.orientador.show', ['solicitacao' => $s]) }}" class="btn btn-primary btn-pill w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        Visualizar
                                    </a>
                                </div>
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
