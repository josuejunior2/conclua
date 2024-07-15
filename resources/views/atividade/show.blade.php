@extends(auth()->guard('admin')->user()->hasRole('Orientador') ? 'layouts.orientador' : 'layouts.admin')

@include('atividade.modal.destroy')
@include('atividade.modal.avaliar')

@section('content')
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Atividade {{ $atividade->titulo }}</h3>
            <div class="d-flex justify-content-between col-auto">
                @can('avaliar atividade')
                    <div class="me-2">
                        <a href="#" class="btn btn-primary w-100  " data-bs-toggle="modal" data-bs-target="#modal-avaliar-atividade">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-stars"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17.8 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /><path d="M6.2 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /><path d="M12 9.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /></svg>
                            {{ !empty($atividade->nota) ? 'Alterar nota' : 'Avaliar atividade' }}
                        </a>
                    </div>
                @endcan
                @can('editar atividade')
                    <div class="me-2">
                        <a href=" {{ route('atividade.edit', ['atividade' => $atividade]) }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                            </svg>
                            Editar
                        </a>
                    </div>
                @endcan
                @can('deletar atividade')
                    <div>
                        <form id="form_destroy_{{ $atividade->id }}" method="post"
                            action="{{ route('atividade.destroy', ['atividade' => $atividade]) }}">
                            @method('DELETE')
                            @csrf
                            <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal"
                                data-bs-target="#modal-destroy-atividade">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                Excluir
                            </a>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="datagrid mb-3">
                <div class="datagrid-item">
                    <div class="datagrid-title">Acadêmico</div>
                    <div class="datagrid-content">{{ $atividade->Orientacao->Academico->User->nome }}</div>
                </div>
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
                        {{ $atividade->data_entrega ? \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') : 'N/A' }}
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">Nota</div>
                    <div class="datagrid-content">
                        <b>{{ $atividade->nota ? $atividade->nota : 'N/A' }}</b>
                    </div>
                </div>
            </div>
            <div class="col-12 markdown">
                <h3>Descrição</h3>
                <p>{{ $atividade->descricao }}</p>
            </div>
        </div>
    </div>
    @if(!empty($atividade->SubmissaoAtividade))
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Submissão {{ \Carbon\Carbon::parse($atividade->SubmissaoAtividade->created_at)->format('d/m/Y H:i') }}</h3>
            <div class="d-flex justify-content-between col-auto">
                {{-- edição, deleção, nota aqui? --}}
            </div>
        </div>
        <div class="card-body">
            <div class="col-12 markdown">
                <h3>arquivo?</h3>
                <h3>Comentário</h3>
                <p>{{ $atividade->SubmissaoAtividade->comentario }}</p>
            </div>
        </div>
    </div>
    @endif
@endsection
