@extends('layouts.admin')

@section('content')

<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de semestres</h3>
            @if (session('error'))
            <div class="alert alert-danger m-3">
                {{ session('error') }}
            </div>
            @endif
            <div>
                <a href="{{ route('admin.semestre.create') }}" class="btn btn-success w-100">
                    Iniciar novo semestre
                </a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-semestres">
          <thead>
            <tr>
              <th>ID</th>
              <th>Ano</th>
              <th>Nº</th>
              <th>Data de início</th>
              <th>Data-limite doc. estágio</th>
              <th>Data-limite doc. orientação</th>
              <th>Data de fim</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($semestres->sortByDesc('created_at') as $s)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                {{-- <td><span class="text-muted">{{ $s->id }}</span></td> --}}
                <td>{{ $s->id }}</td>
                <td>{{ $s->ano }}</td>
                <td>{{ $s->periodo }}</td>
                <td>{{ \Carbon\Carbon::parse($s->data_inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->limite_doc_estagio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->limite_orientacao)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->data_fim)->format('d/m/Y') }}</td>
                <td class="d-flex align-items-center justify-content-center text-end">
                    @can('visualizar semestre')
                        <a class="btn justify-content-center"
                        href="{{ route('admin.semestre.show', ['semestre' => $s]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            Visualizar
                        </a>
                    @endcan
                </td>
                {{-- <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.semestre.show', ['semestre' => $s]) }}">
                            Visualizar
                        </a>
                        @if($s->id == session('semestre_id'))
                        <a class="dropdown-item" href="{{ route('admin.semestre.edit', ['semestre' => $s]) }}">
                            Editar
                        </a>
                        @endif
                        <form id="form_destroy_{{$s->id}}" method="post" action="{{ route('admin.semestre.destroy', ['semestre' => $s->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_destroy_{{$s->id}}').submit()" class="dropdown-item">
                                Excluir
                            </a>
                        </form>
                    </div>
                  </span>
                </td> --}}
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {
        $('#tabela-semestres').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '//cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
            },
        });
    });
</script>
@endsection

