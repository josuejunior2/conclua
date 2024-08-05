<div class="modal modal-blur fade" id="modal-destroy-submissao" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body flex-start">
          <div class="modal-title">Você tem certeza?</div>
          <div>Se proceder, você irá excluir a submissão e os arquivos submetidos.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('form_destroy_submissao{{$atividade->SubmissaoAtividade->id}}').submit()">Sim, excluir</button>
        </div>
      </div>
    </div>
</div>
