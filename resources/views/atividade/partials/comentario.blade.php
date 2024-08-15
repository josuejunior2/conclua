<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Comentários</h3>
    </div>
    <div class="card-body">
        <div class="divide-y">
            <div>
                @foreach ($atividade->comentarios as $comentario)
                    <div class="card mb-2">
                        <div class="row p-2">
                            @if (!empty($comentario->respondidoWithTrashed))
                                <div class="row mt-2">
                                    <div class="col-auto ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="20"
                                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-corner-down-right-double">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 5v6a3 3 0 0 0 3 3h7" />
                                            <path d="M10 10l4 4l-4 4m5 -8l4 4l-4 4" />
                                        </svg>
                                    </div>
                                    <div class="col">
                                        @if (!empty($comentario->Respondido))
                                            <p><b>{{ $comentario->Respondido->Autor()->nome }}:</b>
                                                {{ $comentario->Respondido->texto }} </p>
                                        @else
                                            <i>[Comentário de {{ $comentario->respondidoWithTrashed->Autor()->nome }}
                                                excluído em
                                                {{ $comentario->respondidoWithTrashed->deleted_at->format('d/m/Y H:i') }}]</i>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="col-auto">
                                <span class="avatar">A</span>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <div class="col-auto">
                                        <strong>{{ $comentario->Autor()->nome }}</strong>
                                        {{ $comentario->created_at->format('d/m/Y H:i') }} @if ($comentario->created_at != $comentario->updated_at)
                                            <i>(editado em {{ $comentario->updated_at->format('d/m/Y H:i') }})</i>
                                        @endif

                                        @can('criar comentario')
                                            @if(session('semestreIsAtivo'))
                                                <a onclick="showResposta('{{ $comentario->Autor()->nome }}', '{{ $comentario->texto }}', {{ $comentario->id }})"
                                                    class="btn btn-pill p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="20"
                                                        height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-corner-down-left-double">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M19 5v6a3 3 0 0 1 -3 3h-7" />
                                                        <path d="M13 10l-4 4l4 4m-5 -8l-4 4l4 4" />
                                                    </svg>
                                                </a>
                                            @endif
                                        @endcan

                                        @if ($comentario->comentarioDoUsuario() && session('semestreIsAtivo'))
                                            @can('editar comentario')
                                                <a onclick="editar('{{ $comentario->id }}', '{{ $comentario->texto }}')"
                                                    class="btn btn-pill p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="20"
                                                        height="20" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </a>
                                            @endcan

                                            @can('excluir comentario')
                                                @if(session('semestreIsAtivo'))
                                                    <form id="form_destroy_comentario_{{ $comentario->id }}" method="post"
                                                        action="{{ route('comentario.destroy', ['comentario' => $comentario]) }}"
                                                        style="display: contents">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="#"
                                                            onclick="document.getElementById('form_destroy_comentario_{{ $comentario->id }}').submit()"
                                                            class="btn btn-pill p-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2"
                                                                width="20" height="20" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </a>
                                                    </form>
                                                @endif
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                                <p id="texto_comentario_{{ $comentario->id }}" class="texto_comentario">
                                    {{ $comentario->texto }}</p>

                                @can('editar comentario')
                                    @if(session('semestreIsAtivo'))
                                        <form method="POST" id="form_editar_comentario_{{ $comentario->id }}"
                                            action="{{ route('comentario.update', ['comentario' => $comentario]) }}"
                                            autocomplete="off" novalidate style="display: none" class="form_editar mt-1">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-2">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="texto"
                                                        id="texto_edicao_{{ $comentario->id }}" placeholder="Comente aqui...">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-send-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z" />
                                                            <path d="M6.5 12h14.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="mb-3">
            @can('criar comentario')
                @if(session('semestreIsAtivo'))
                    <form method="POST" action="{{ route('comentario.store') }}" autocomplete="off" novalidate>
                        @csrf
                        <div class="row resposta w-100" style="display: none;">
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-corner-down-right-double">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 5v6a3 3 0 0 0 3 3h7" />
                                    <path d="M10 10l4 4l-4 4m5 -8l4 4l-4 4" />
                                </svg>
                            </div>
                            <div class="col">
                                <p id="texto_resposta"></p>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <input id="comentario_id" name="comentario_id" type="hidden" class="form-control">
                                @if (auth()->guard('admin')->check())
                                    <input id="orientador_id" name="orientador_id" type="hidden" class="form-control"
                                        value="{{ auth()->user()->Orientador->id }}">
                                @elseif(auth()->guard('web')->check())
                                    <input id="academico_id" name="academico_id" type="hidden" class="form-control"
                                        value="{{ auth()->user()->Academico->id }}">
                                @endif
                                <input id="atividade_id" name="atividade_id" type="hidden" class="form-control"
                                    value="{{ $atividade->id }}">
                                <input type="text" class="form-control" name="texto" placeholder="Comente aqui...">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-send-2">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z" />
                                        <path d="M6.5 12h14.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @endcan
        </div>
    </div>
</div>

@section('js')
    <script>
        function showResposta(autor, texto, id) {
            $('.resposta').show();
            if (texto.length > 100) texto = texto.substring(0, 100) + '...'
            $('#texto_resposta').html(autor.bold() + ': ' + texto);
            $('#comentario_id').val(id);
        }

        function editar(id, texto) {
            $('.form_editar').hide();
            $('.texto_comentario').show();
            $('#texto_comentario_' + id).hide();
            $('#texto_edicao_' + id).val(texto);
            $('#form_editar_comentario_' + id).show();
        }
    </script>
@endsection
