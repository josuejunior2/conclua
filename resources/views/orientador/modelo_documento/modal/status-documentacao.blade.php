<div class="modal modal-blur fade w-55" id="modal-status-documentacao-{{ $arquivo->id }}" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Avaliar documentação</div>
                <form method="POST" id="form_status_documentacao_{{ $arquivo->id }}"
                    action="{{ route('arquivo.documentacao.status', ['arquivo' => $arquivo]) }}">
                    @csrf
                    <select class="form-select" name="status_documentacao" id="select-status-{{ $arquivo->id }}">
                        <option class="badge bg-yellow text-white" value="" @if($arquivo->status_documentacao =="") selected @endif>Em análise</option>
                        <option class="badge bg-red text-white" value="0" @if($arquivo->status_documentacao =="0") selected @endif>Reprovado</option>
                        <option class="badge bg-green text-white" value="1" @if($arquivo->status_documentacao =="1") selected @endif>Aprovado</option>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Avaliar</button>
            </div>
            </form>
        </div>
    </div>
</div>
