@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de permissões</h3>
            
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-permissions"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th>Nome</th>
              <th>Tipo de perfil</th>
              <th>Criado em</th>
              <th>Atualizado em</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->getTipoPerfil() }}</td>
                <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/Y G:h') }}</td>
                <td>{{ \Carbon\Carbon::parse($permission->updated_at)->format('d/m/Y G:h') }}</td>
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
        $('#tabela-permissions').DataTable({
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

