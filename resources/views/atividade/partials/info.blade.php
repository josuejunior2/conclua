<div class="card-body">
    <div class="datagrid mb-3">
        @if (! auth()->guard('admin')->user()->hasRole('Academico'))
            <div class="datagrid-item">
                <div class="datagrid-title">Acadêmico</div>
                <div class="datagrid-content">{{ $atividade->Orientacao->Academico->User->nome }}</div>
            </div>
        @endif
        @if (auth()->guard('admin')->user()->hasRole('Admin'))
            <div class="datagrid-item">
                <div class="datagrid-title">Orientador</div>
                <div class="datagrid-content">{{ $atividade->Orientacao->Orientador->Admin->nome }}</div>
            </div>
        @endif
        <div class="datagrid-item">
            <div class="datagrid-title">Criado em</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->created_at)->format('d/m/Y H:i') }}
            </div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Atualizado em:</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->updated_at)->format('d/m/Y H:i') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data-limite para entrega</div>
            <div class="datagrid-content">{{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') }}
            </div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data de entrega</div>
            <div class="datagrid-content">
                {{ $atividade->data_entrega ? \Carbon\Carbon::parse($atividade->data_entrega)->format('d/m/Y H:i') : 'N/A' }}
            </div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Nota</div>
            <div class="datagrid-content">
                <b>{{ $atividade->nota ? $atividade->nota : 'N/A' }}</b>
            </div>
        </div>
    </div>
    @if(!empty($atividade->descricao))
    <div class="col-12 markdown">
        <h3>Descrição</h3>
        <p>{{ $atividade->descricao }}</p>
    </div>
    @endif

    @include('orientador.atividade.modal.add_arquivo_aux')
    <div class="card-footer mt-3">
        <div class="d-flex justify-content-between col-auto">
            <h3>Arquivos auxiliares</h3>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-add-arquivo-aux">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                Adicionar arquivo auxiliar
            </a>
        </div>
        @include('arquivo.download_auxiliar')
    </div>   
</div>