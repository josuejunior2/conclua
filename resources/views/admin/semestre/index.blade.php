@extends('layouts.admin')

@section('content')

<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de semestres</h3>
            <div>
                <a href="{{ route('admin.semestre.create') }}" class="btn btn-success w-100">
                    Iniciar novo semestre
                </a>
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
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-semestres">
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              <th>Ano</th>
              <th>Nº</th>
              <th>Data de início</th>
              <th>Data-limite doc. estágio</th>
              <th>Data-limite doc. orientação</th>
              <th>Data de fim</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($semestres as $s)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $s->id }}</span></td>
                <td>{{ $s->ano }}</td>
                <td>{{ $s->numero }}</td>
                <td>{{ \Carbon\Carbon::parse($s->data_inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->data_fim)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->limite_doc_estagio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($s->limite_orientacao)->format('d/m/Y') }}</td>
                <td>@if ($s->status == 0)
                    Inativo
                    @elseif ($s->status == 1)
                    Ativo
                @endif</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.semestre.show', ['semestre' => $s]) }}">
                            Visualizar
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.semestre.edit', ['semestre' => $s]) }}">
                            Editar
                        </a>
                        @if ($s->status == 0)
                        <form id="form_ativar_{{$s->id}}" method="post" action="{{ route('admin.semestre.ativar', ['semestre' => $s->id]) }}">
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_ativar_{{$s->id}}').submit()" class="dropdown-item">
                                Ativar
                            </a>
                        </form>
                        @else
                        <form id="form_desativar_{{$s->id}}" method="post" action="{{ route('admin.semestre.desativar', ['semestre' => $s->id]) }}">
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_desativar_{{$s->id}}').submit()" class="dropdown-item">
                                Desativar
                            </a>
                        </form>
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
                </td>
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
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
        });
    });
</script>
@endsection

