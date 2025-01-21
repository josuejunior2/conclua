<div class="modal modal-blur fade" id="modal-destroy-admin-{{$admin->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body flex-start">
          <div class="modal-title">Você tem certeza?</div>
          <div>Se proceder, o acesso do admin {{ $admin->nome }} @if($admin->trashed()) será desbloqueado. @else será bloqueado. @endif </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" onclick="document.getElementById('form_destroy_{{$admin->id}}').submit()">Sim</button>
        </div>
      </div>
    </div>
</div>
