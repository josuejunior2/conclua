@extends('layouts.orientador')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Meu cadastro</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href=" {{ route('orientador.edit', ['orientador' => $admin->Orientador ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $admin->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $admin->Orientador->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $admin->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">SubÁreas</div>
            <div class="datagrid-content">@foreach($admin->Orientador->subAreas as $sub) {{ $sub->nome }}@if(!$loop->last),@endif @endforeach </div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Disponibilidade</div>
            <div class="datagrid-content">{{ $admin->Orientador->disponibilidade }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content"><a href="{{ $admin->Orientador->enderecoLattes }}" target="_blank">{{$admin->Orientador->enderecoLattes}}</a></div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content"><a href="{{ $admin->Orientador->enderecoOrcid }}" target="_blank">{{$admin->Orientador->enderecoOrcid}}</a></div>
        </div>
    </div>
    </div>
</div>

@endsection
