@extends('layouts.admin')

@include('admin.role.modal.destroy')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Perfil</h3>
        <div class="d-flex justify-content-between col-auto">
            <div class="me-2">
                <a href=" {{ route('admin.role.edit', ['role' => $role ]) }}" class="btn me-2 btn-secondary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                    Editar
                </a>
            </div>
            <div>
                <form id="form_{{$role->id}}" method="post" action="{{ route('admin.role.destroy', ['role' => $role]) }}">
                    @method('DELETE')
                    @csrf
                    <!-- <button type="submit">Excluir</button>  -->
                    <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modal-destroy-role">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Excluir
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nome</div>
                <div class="datagrid-content">{{ $role->name }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Descrição</div>
                <div class="datagrid-content">{{ $role->description }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Tipo de perfil</div>
                <div class="datagrid-content">{{ $role->guard_name == "web" ? 'Usuário comum' : 'Administração' }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Criado em:</div>
                <div class="datagrid-content">{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y G:h') }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Atualizado em:</div>
                <div class="datagrid-content">{{ \Carbon\Carbon::parse($role->updated_at)->format('d/m/Y G:h') }}</div>
            </div>
        </div>
    </div>
</div>
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Permissões</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href="{{ route('admin.role.edit-permissions', ['role' => $role]) }}" class="btn btn-info w-100 ">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                Editar permissões
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
              <thead>
                <tr>
                  <th>Nome</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($role->permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                    </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>
@endsection
