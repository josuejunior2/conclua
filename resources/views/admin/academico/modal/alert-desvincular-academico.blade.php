<div class="modal modal-blur fade" id="modal-desvincular-academico-{{ $modalidade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-title">Você tem certeza?</div>
          <div>Se proceder, você irá desvincular {{ $orientacao->AcademicoTrashed->UserTrashed->nome }} de {{ $orientacao->OrientadorTrashed->AdminTrashed->nome }} e perder os dados da orientação e atividades.</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('form_desvincular_{{$modalidade->id}}').submit()">Sim, desvincular</button>
        </div>
      </div>
    </div>
</div>
