@extends('layouts.app')

@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitação de vinculação a {{ $solicitacao->Orientador->Admin->nome }}</h3>
        <div class="d-flex justify-content-between col-auto">
        @if (is_null($solicitacao->status))
            @can('editar solicitacao')
                <a href=" {{ route('solicitacao.edit', ['solicitacao' => $solicitacao ]) }}" class="btn me-2 btn-secondary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                    Editar
                </a>
            @endcan
            @can('excluir solicitacao')
                <form id="form_{{$solicitacao->id}}" method="post" action="{{ route('solicitacao.destroy', ['solicitacao' => $solicitacao]) }}">
                    @method('DELETE')
                    @csrf
                    <a href="#" onclick="document.getElementById('form_{{$solicitacao->id}}').submit()" class="btn btn-danger w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Excluir solicitacao
                    </a>
                </form>
            @endcan
        @endif
    </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Data de envio da solicitação</div>
                <div class="datagrid-content">{{ $solicitacao->created_at->format('d/m/Y') }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Status da solicitação</div>
                <div class="datagrid-content">
                    @if (is_null($solicitacao->status))
                        <span class="badge bg-indigo text-white">Aguardando resposta</span>
                    @elseif (!$solicitacao->status)
                        <span class="badge bg-red text-white">Rejeitada</span>
                    @elseif ($solicitacao->status)
                        <span class="badge bg-green text-white">Aceita</span>
                    @endif
                </div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Mensagem enviada</div>
                <div class="datagrid-content">{{ $solicitacao->mensagem }}</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nome</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->Admin->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">MASP</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->masp }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email</div>
                <div class="datagrid-content">{{ $solicitacao->Orientador->Admin->email }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Lattes</div>
                <div class="datagrid-content"><a href="{{ $solicitacao->Orientador->enderecoLattes }}" target="_blank">{{$solicitacao->Orientador->enderecoLattes}}</a></div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Currículo Orcid</div>
                <div class="datagrid-content"><a href="{{ $solicitacao->Orientador->enderecoOrcid }}" target="_blank">{{$solicitacao->Orientador->enderecoOrcid}}</a></div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Subáreas</div>
                <div class="datagrid-content">@foreach($solicitacao->Orientador->subAreas as $sub) {{ $sub->nome }}@if(!$loop->last),@endif @endforeach </div>
            </div>
        </div>
    </div>
</div>
@endsection

