@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de admins</h3>
            @can('criar admin')
                <div>
                    <a href="{{ route('admin.admin.create') }}" class="btn btn-success w-100 mb-1">
                        Adicionar novo admin
                    </a>
                </div>
            @endcan
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-admins">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Perfil</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->nome }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->roles->pluck('name')->first() }}</td>
                <td class="text-end">
                    <a class="btn justify-content-center" href="{{ route('admin.admin.show', ['admin' => $admin]) }}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        Visualizar
                    </a>
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
        $('#tabela-admins').DataTable({
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
