@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de áreas de atuação do Orientador</h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div>
                @can('criar area')
                    <a href="{{ route('admin.area.create') }}" class="btn btn-success w-100 mb-1">
                        Adicionar nova área
                    </a>
                @endcan
            </div>
        </div>
        <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-areas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Criado em</th>
                    <th>Atualizado em</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($areas as $area)
                @include('admin.area.modal.destroy')
                <tr>
                    <td>{{ $area->id }}</td>
                    <td>{{ $area->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($area->created_at)->format('d/m/Y G:h') }}</td>
                    <td>{{ \Carbon\Carbon::parse($area->updated_at)->format('d/m/Y G:h') }}</td>
                    <td class="d-flex align-items-center justify-content-center text-end">
                        <div class="btn-group w-100"role="group">
                            @can('editar area')
                                <a class="btn text-primary" href="{{ route('admin.area.edit', ['area' => $area]) }}">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                </a>
                            @endcan
                            @can('excluir area')
                                <a class="btn text-danger" data-bs-toggle="modal" data-bs-target="#modal-destroy-area-{{ $area->id }}">
                                    <form id="form_{{$area->id}}" method="post" action="{{ route('admin.area.destroy', ['area' => $area]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    </form>
                                </a>
                            @endcan
                        </div>
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
        $('#tabela-areas').DataTable({
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

