<div class="modal modal-blur fade mw-50" id="modal-avaliar-atividade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="modal-title">Avaliar atividade {{ $atividade->titulo }}</div>
            <form id="form" method="post" action="{{ route('atividade.avaliar', ['atividade' => $atividade]) }}">
                @method('POST')
                @csrf
                    {{-- <div class="form-label"></div> --}}
                    {{-- <input type="file" name="arquivo" id="arquivo" class="form-control" /> --}}
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="mb-3">
                            <div class="form-label required">Nota</div>
                            <input id="nota" name="nota" type="number" class="form-control" step="0.01" max="100" min="0" value="{{ old('nota', '') }}" />
                            <span class="{{ $errors->has('nota') ? 'text-danger' : '' }}">
                                {{ $errors->has('nota') ? $errors->first('nota') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                {{-- <div class="row g-3 mb-4">
                    <div class="mb-3">
                        <label class="form-label required">Senha do orientador</label>
                        <div>
                            <input name="password" type="password" class="form-control" placeholder="Senha">
                            <span class="{{ $errors->has('password') ? 'text-danger' : '' }}">
                            {{ $errors->has('password') ? $errors->first('password') : '' }}
                        </span>
                        </div>
                    </div>
                </div> --}}
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Avaliar</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
