@extends(auth()->guard('admin')->user()->hasRole('Orientador') ? 'layouts.orientador' : 'layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Atividade {{ $atividade->titulo }}</h3>
        @can('editar atividade')
            <div class="d-flex justify-content-between col-auto">
                <a href=" {{ route('atividade.edit', ['atividade' => $atividade ]) }}" class="btn me-2 btn-secondary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                    Editar
                </a>
            </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="datagrid mb-3">
            <div class="datagrid-item">
                <div class="datagrid-title">Acadêmico</div>
                <div class="datagrid-content">{{ $atividade->Orientacao->Academico->User->nome }}</div>
            </div>
            @if(auth()->guard('admin')->user()->hasRole('Admin'))
                <div class="datagrid-item">
                    <div class="datagrid-title">Orientador</div>
                    <div class="datagrid-content">{{ $atividade->Orientacao->Orientador->Admin->nome }}</div>
                </div>
            @endif
            <div class="datagrid-item">
                <div class="datagrid-title">Criado em</div>
                <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->created_at)->format('d/m/Y H:i') }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Data-limite para entrega</div>
                <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Data de entrega</div>
                <div class="datagrid-content">{{ $atividade->data_entrega ? \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') : 'N/A'}}</div>
            </div>
        </div>
        <div class="col-12 markdown">
            <h3>Descrição</h3>
            <p>{{ $atividade->descricao }}</p>
        </div>
    </div>
</div>

@endsection