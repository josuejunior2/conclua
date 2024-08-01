@extends(auth()->guard('admin')->user()->hasRole('Orientador') ? 'layouts.orientador' : 'layouts.admin')

@include('atividade.modal.destroy')

@section('content')
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Atividade "{{ $atividade->titulo }}"</h3>
            <div class="d-flex justify-content-between col-auto">
                @can('editar atividade')
                    <div class="me-2">
                        <a href=" {{ route('orientador.atividade.edit', ['atividade' => $atividade]) }}" class="btn btn-secondary">
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
                            action="{{ route('orientador.atividade.destroy', ['atividade' => $atividade]) }}">
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
        @include('atividade.partials.info')
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
                
                @include('arquivo.download_submissao')
                
                <h3>Comentário</h3>
                <p>{{ $atividade->SubmissaoAtividade->comentario }}</p>
            </div>
        </div>
    </div>
    @endif
@endsection
