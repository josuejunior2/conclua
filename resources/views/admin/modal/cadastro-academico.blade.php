<div class="modal modal-blur fade" id="modal-cadastro-academico" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cadastrar novos orientadores</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Instruções: <br>
            Para cadastrar, basta enviar um arquivo excel com a extensão '.xlsx' contendo as seguintes informações: <br>
            Na primeira coluna, o nome completo do professor; <br>
            Na segunda coluna, o email do professor; <br>
            Na terceira coluna, o MASP do professor. <br>
            <form method="POST" action="{{ route('admin.cadastro-academico') }}" enctype="multipart/form-data" class="row g-3 align-items-center">
                @csrf
                <label for="tabela_orientadores" class="visually-hidden">Escolha um arquivo</label>
                <input type="file" name="tabela_academicos" id="tabela_academicos" accept=".xlsx" class="form-control">
                @error('tabela_academicos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancelar
          </a>
          <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Enviar
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>


