@extends($layout)

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de modelos de documento</h3>
            @can('criar modelo de documento')
                <div>
                    <a href="{{ route('admin.modelo_documento.create') }}" class="btn btn-success w-100 mb-1">
                        Adicionar novo modelo
                    </a>
                </div>
            @endcan
        </div>
        <div class="card-body">
            @foreach ($modelos as $modelo)
            <div class="accordion" id="accordion-{{ $modelo->id }}">
                <div class="accordion-item m-3 @if(!empty($orientacao) && $modelo->isAtrasado($orientacao->id)) border-danger shadow-lg bg-white rounded @endif">
                    <div class="d-flex justify-content-between" id="heading-1">
                        <button class="accordion-header p-2" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $modelo->id }}" aria-expanded="true">
                            {{$modelo->nome}} <small class="ms-3">{{$modelo->getNomeModalidade()}}</small>
                            @if(!empty($modelo->data_limite)) 
                                <div class="btn p-1 pe-none user-select-all ms-2">Data-limite:  {{ \Carbon\Carbon::parse($modelo->data_limite)->format('d/m/Y H:i') }}</div>
                            @endif
                        </button>
                        <div class="d-flex justify-content-between col-auto">
                            <div class="btn-group" role="group">
                                @can('editar modelo de documento')
                                    <a href=" {{ route('admin.modelo_documento.edit', ['modelo' => $modelo]) }}" class="btn btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                        Editar
                                    </a>
                                @endcan
                                @can('excluir modelo de documento')
                                    @include('admin.modelo_documento.modal.destroy')
                                    <a href="#" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                    data-bs-target="#modal-destroy-modelo{{$modelo->id}}">
                                        <form id="form_destroy_{{ $modelo->id }}" method="post"
                                            action="{{ route('admin.modelo_documento.destroy', ['modelo' => $modelo]) }}">
                                            @method('DELETE')
                                            @csrf
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
                                        </form>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div id="accordion-collapse-{{ $modelo->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{ $modelo->id }}">
                        <div class="accordion-body pt-1">
                            <p>{{$modelo->descricao}}</p>
                            <div class="row">
                                @foreach ($modelo->arquivos as $arquivo)
                                    <div class="col-auto mb-3">
                                        <div class="card card-sm">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $arquivo->nome }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <form id="form" method="post" class="flex-2"
                                                            action="{{ route('download.arquivo') }}">
                                                            @csrf
                                                            <input id="caminho" name="caminho" type="hidden" class="form-control"
                                                                value="{{ $arquivo->caminho . '/' . $arquivo->nome }}">
                                                            <button type="submit" class="btn btn-outline-secondary w-100">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                    <path d="M7 11l5 5l5 -5" />
                                                                    <path d="M12 4l0 12" />
                                                                </svg>
                                                                Baixar
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @can('excluir modelo de documento')
                                                        @include('admin.modelo_documento.modal.destroy_arquivo')
                                                        <div class="col-auto">
                                                            <form id="form_destroy_arquivo_modelo{{ $arquivo->id }}" method="post"
                                                                action="{{ route('admin.destroy.arquivo.modelo', ['arquivo' => $arquivo]) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="#" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-destroy-arquivo-modelo{{ $arquivo->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

