<div class="modal modal-blur fade mw-50" id="modal-entrega-atividade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="modal-title">Submeter atividade {{ $atividade->titulo }}</div>
            <form id="form" method="post" action="{{ route('academico.atividade.store') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <input id="atividade_id" name="atividade_id" type="hidden" class="form-control" value="{{ $atividade->id }}">
                    {{-- <div class="form-label"></div> --}}
                    {{-- <input type="file" name="arquivo" id="arquivo" class="form-control" /> --}}
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="mb-3">
                            <div class="form-label">Comentário</div>
                            <input id="comentario" name="comentario" type="text" class="form-control"
                                value="{{ old('comentario', '') }}" />
                            <span class="{{ $errors->has('comentario') ? 'text-danger' : '' }}">
                                {{ $errors->has('comentario') ? $errors->first('comentario') : '' }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Arquivo(s)</div>
                            <input type="file" name="arquivos_submissao[]" id="arquivos_submissao" accept=".xlsx" class="form-control" multiple>
                            <span class="{{ $errors->has('arquivos_submissao') ? 'text-danger' : '' }}">
                                {{ $errors->has('arquivos_submissao') ? $errors->first('arquivos_submissao') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Submeter</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
