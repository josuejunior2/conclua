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
            @include('admin.admin.modal.destroy')
            <tr>
                <td>{{ $admin->nome }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->roles->pluck('name')->first() }}</td>
                <td class="text-end">
                    @if(!$admin->trashed())
                      <a class="btn justify-content-center" href="{{ route('admin.admin.show', ['admin' => $admin]) }}">
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                          Visualizar
                      </a>
                    @else
                      <div>
                          <form id="form_destroy_{{$admin->id}}" method="post" action="{{ route('admin.admin.destroy', ['admin' => $admin]) }}">
                              @method('DELETE')
                              @csrf
                              <!-- <button type="submit">Excluir</button>  -->
                              <a href="#" data-bs-toggle="modal" data-bs-target="#modal-destroy-admin-{{$admin->id}}" class="btn btn-outline-danger" @can('excluir admin') @else disabled @endcan>
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
                                  Desbloquear
                              </a>
                          </form>
                      </div>

                    @endif
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
                url: '/pt-br-datatables.json',
            },
        });
    });
</script>
@endsection

