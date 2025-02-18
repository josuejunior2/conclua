<div class="modal modal-blur fade" id="modal-add-arquivo-documentacao-{{$modelo->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submeter documentação - {{$modelo->nome}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('arquivo.store.arquivo.documentacao', ['orientacao' => $orientacao]) }}"
                    enctype="multipart/form-data" class="row g-3 align-items-center">
                    @csrf
                    <input id="modelo_documento_id" name="modelo_documento_id" type="hidden" class="form-control" value="{{ $modelo->id }}">
                    <div class="form-label">Arquivo(s)</div>
                    <input type="file" name="arquivos_documentacao[]" id="arquivos_documentacao" accept=".pdf,.odf,.jpg,.jpeg,.png,.bmp,.gif,.svg" class="form-control"
                        multiple>
                    <span class="{{ $errors->has('arquivos_documentacao') ? 'text-danger' : '' }}">
                        {{ $errors->has('arquivos_documentacao') ? $errors->first('arquivos_documentacao') : '' }}
                    </span>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancelar
                </a>
                <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-upload"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11v6" /><path d="M9.5 13.5l2.5 -2.5l2.5 2.5" /></svg>
                    Enviar
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
