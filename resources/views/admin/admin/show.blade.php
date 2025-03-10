@extends('layouts.admin')

@include('admin.admin.modal.destroy')
@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Admin</h3>
        <div class="d-flex justify-content-between col-auto">
            @can('editar admin')
                <div class="me-2">
                    <a href=" {{ route('admin.admin.edit', ['admin' => $admin ]) }}" class="btn btn-secondary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                        Editar
                    </a>
                </div>
            @endcan
            @can('excluir admin')
                <div>
                    <form id="form_destroy_{{$admin->id}}" method="post" action="{{ route('admin.admin.destroy', ['admin' => $admin]) }}">
                        @method('DELETE')
                        @csrf
                        <!-- <button type="submit">Excluir</button>  -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-destroy-admin-{{$admin->id}}" class="btn btn-danger w-100">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                            Bloquear acesso 
                        </a>
                    </form>
                </div>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nome</div>
                <div class="datagrid-content">{{ $admin->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $admin->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Perfil</div>
                <div class="datagrid-content">{{ $admin->roles->pluck('name')->first() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

