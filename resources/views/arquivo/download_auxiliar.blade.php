<div class="row">
    @foreach($atividade->arquivosAuxiliares as $arquivo)
    @can('excluir atividade')
        @include('arquivo.destroy_arquivo_aux')
    @endcan
    <div class="col-4 mb-3">
        <div class="card card-sm">
          <div class="card-body">
            <h3 class="card-title">{{ $arquivo->nome }}</h3>
            <div class="mt-4">
              <div class="row">
                <div class="col">
                    <form id="form" method="post" class="flex-2" action="{{ route('download.arquivo') }}">
                        @csrf
                        <input id="caminho" name="caminho" type="hidden" class="form-control" value="{{ $arquivo->caminho . '/' . $arquivo->nome }}">
                        <button type="submit" class="btn btn-outline-secondary w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 11l5 5l5 -5" />
                                <path d="M12 4l0 12" />
                            </svg>
                            Download do arquivo
                        </button>
                    </form>
                </div>
                @can('excluir atividade')
                    @if(session('semestreIsAtivo'))
                        <div class="col-auto">
                            <form id="form_destroy_arquivo_aux_{{ $arquivo->id }}" method="post" action="{{ route('arquivo.destroy.arquivo.aux', ['arquivo' => $arquivo]) }}">
                                @method('DELETE')
                                @csrf
                                <a href="#" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                    data-bs-target="#modal-destroy-arquivo-aux">
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
                    @endif
                @endcan
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
</div>