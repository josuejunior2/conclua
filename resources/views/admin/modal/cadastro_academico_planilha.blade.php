<div class="modal modal-blur fade" id="modal-cadastro-academico-planilha" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cadastrar novos acadêmicos via planilha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Instruções: <br>
            Para cadastrar, basta enviar um arquivo excel com a extensão '.xlsx' contendo as seguintes informações: <br>
            <ol>
                <li>Na primeira coluna, o nome completo do acadêmico; </li>
                <li>Na segunda coluna, o email do acadêmico;</li>
                <li>Na terceira coluna, a matricula do acadêmico. </li>
            </ol>
            <form id="form" method="post"
                action="{{ route('admin.academico.download.modelo.planilha') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 11l5 5l5 -5" />
                        <path d="M12 4l0 12" />
                    </svg>
                    Baixe aqui a planilha de modelo
                </button>
            </form>
            <form method="POST" action="{{ route('admin.cadastro.planilha.academico') }}" enctype="multipart/form-data" class="row g-3 align-items-center">
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


