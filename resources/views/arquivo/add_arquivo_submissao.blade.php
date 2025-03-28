<div class="modal modal-blur fade" id="modal-add-arquivo-submissao" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar arquivo(s) na submissão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="{{ route('arquivo.store.arquivo.submissao', ['submissao' => $atividade->SubmissaoAtividade]) }}"
                    enctype="multipart/form-data" class="row g-3 align-items-center">
                    @csrf
                    <div class="form-label">Arquivo(s)</div>
                    <input type="file" name="arquivos_submissao[]" id="arquivos_submissao" accept=".pdf,.odf,.jpg,.jpeg,.png,.bmp,.gif,.svg" class="form-control"
                        multiple>
                    <span class="{{ $errors->has('arquivos_submissao') ? 'text-danger' : '' }}">
                        {{ $errors->has('arquivos_submissao') ? $errors->first('arquivos_submissao') : '' }}
                    </span>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancelar
                </a>
                <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Enviar
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
