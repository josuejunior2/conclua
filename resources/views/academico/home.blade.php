@extends('layouts.app');

@section('content')
{{-- HOME DO ACAD QUE NAO TEM ORIENTADOR AINDA --}}

<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de orientadores</h3>
        </div>
    <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-orientadores-web">
        <thead>
            <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Subáreas</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orientadores as $o)
            <tr>
                <td>{{ $o->AdminTrashed->nome }}</td>
                <td>{{ $o->AdminTrashed->email }}</td>
                <td>@foreach($o->subAreas as $sub) {{ $sub->nome }}@if(!$loop->last),@endif @endforeach </td>
                <td class="text-end">
                    @can('criar solicitacao')
                        <a class="btn btn-outline-success" href="{{ route('solicitacao.create', ['orientador' => $o, 'academico' => $academico]) }}">
                            Solicitar vinculação
                        </a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
    @if ($solicitacoes->isNotEmpty())
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="row row-cards">
                    <div class="col-12">
                    <div class="card" style="height: 27rem">
                        <div class="card-header justify-content-between">
                            <h3 class="card-title">Solicitação enviada</h3>
                        </div>
                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            @foreach($solicitacoes as $as)
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-truncate">
                                            {{ $as->OrientadorTrashed->AdminTrashed->nome }}
                                        </div>
                                        <div class="text-muted">{{ $as->created_at->format('d/m/Y') }}</div>
                                        @if (is_null($as->status))
                                            <span class="badge bg-indigo text-white">Aguardando resposta</span>
                                        @elseif (!$as->status)
                                            <span class="badge bg-red text-white">Rejeitada</span>
                                        @elseif ($as->status)
                                            <span class="badge bg-green text-white">Aceita</span>
                                        @endif
                                    </div>
                                    <div class="col-auto align-self-center">
                                        @can('visualizar solicitacao')
                                            <a href="{{ route('solicitacao.show.web', ['solicitacao' => $as]) }}" class="btn btn-primary btn-pill w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                                Visualizar
                                            </a>
                                        @endcan
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
    @endif
    </div>
</div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {
        $('#tabela-orientadores-web').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '/pt-br-datatables.json',
            },
        });
    });
</script>
@endsection

