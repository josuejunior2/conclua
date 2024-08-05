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
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              {{-- <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th> --}}
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
                <td>{{ $s->ano }}</td>
                <td>{{ $s->periodo }}</td>
                <td>{{ \Carbon\Carbon::parse($s->data_inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->limite_doc_estagio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->limite_orientacao)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->data_fim)->format('d/m/Y') }}</td>
                <td class="d-flex align-items-center justify-content-center text-end">
                    <div class=" me-2">
                        <a href="{{ route('admin.semestre.show', ['semestre' => $s]) }}" class="btn btn-secondary w-100">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24" class="d-flex justify-content-center"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                    </div>
                    <div class=" me-2">
                        <a href="{{ route('admin.semestre.edit', ['semestre' => $s]) }}" class="btn btn-primary w-100">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24" class="d-flex justify-content-center"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                        </a>
                    </div>
                    <div class=" me-2">
                        <form id="form_{{$s->id}}" method="post" action="{{ route('admin.semestre.destroy', ['semestre' => $s->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_{{$s->id}}').submit()" class="btn btn-danger w-100">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24" class="d-flex justify-content-center"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </a>
                        </form>
                    </div>
                </td>
                {{-- <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.semestre.show', ['semestre' => $s]) }}">
                            Visualizar
                        </a>
                        @if($s->id == $semestreSession)
                        <a class="dropdown-item" href="{{ route('admin.semestre.edit', ['semestre' => $s]) }}">
                            Editar
                        </a>
                        @endif
                        <form id="form_destroy_{{$s->id}}" method="post" action="{{ route('admin.semestre.destroy', ['semestre' => $s->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_destroy_{{$s->id}}').submit()" class="dropdown-item">
                                Excluir cadastro
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

