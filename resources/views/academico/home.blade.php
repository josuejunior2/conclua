@extends('layouts.app');

@section('content')
{{-- preciso melhorar essa condição depois, talvez um middleware para checar se tem orientador? --}}
@php

@endphp
@if (
    (is_null($academico->AcademicoEstagio) || is_null($academico->AcademicoEstagio->Orientador)) &&
    (is_null($academico->AcademicoTCC) || is_null($academico->AcademicoTCC->Orientador))
)
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de orientadores</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-orientadores-web"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              {{-- <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th> --}}
              <th>Nome</th>
              <th>Email</th>
              <th>Formação</th>
              <th>Área</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orientadores as $o)
            <tr>
                {{-- <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $o->Orientador->id }}</span></td> --}}
                <td>{{ $o->Orientador->nome }}</td>
                <td>{{ $o->Orientador->email }}</td>
                <td>{{ $o->Orientador->Formacao ? $o->Orientador->Formacao->nome : 'N/A' }}</td>
                <td>{{ $o->Orientador->Area ? $o->Orientador->Area->nome : 'N/A' }}</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('orientador.show.web', ['Orientador' => $o, 'academico' => $academico]) }}">
                            Visualizar
                        </a>
                        <a class="dropdown-item" href="{{ route('solicitacao.create', ['orientador' => $o, 'academico' => $academico]) }}">
                            Solicitar vinculação
                        </a>

                    </div>
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @if ($academico->solicitacoes->isNotEmpty())
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
                            @foreach($academico->solicitacoes as $as)
                            <div>
                                <div class="row">
                                    <div class="col">
                                    <div class="text-truncate">
                                        {{ $as->Orientador->nome }}
                                    </div>
                                    <div class="text-muted">{{ $as->created_at->format('d/m/Y') }}</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <a href="{{ route('solicitacao.show.web', ['solicitacao' => $as]) }}" class="btn btn-primary btn-pill w-100">
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
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
        });
    });
</script>
@else
oi parabens vc tem orientador
@endif

@endsection

