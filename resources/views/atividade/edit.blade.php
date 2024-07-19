@extends(auth()->guard('admin')->user()->hasRole('Orientador') ? 'layouts.orientador' : 'layouts.admin')

@section('content')
    <div class="card m-3">
        <div class="card-header">
            <h3 class="card-title">Editar cadastro de atividade</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('orientador.atividade.update', ['atividade' => $atividade]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-label required">Orientando</div>
                    <select class="form-select" name="orientacao_id" id="orientacao_id" >
                        <option value=""> -- Selecione o orientando -- </option>
                        @foreach($orientacoes as $orientacao)
                            <option value="{{ $orientacao->id }}" {{ old('orientacao_id') == $orientacao->id || $atividade->Orientacao->id == $orientacao->id ? 'selected' : '' }}>
                                {{ $orientacao->Academico->User->nome }} @if(!empty($orientacao->AcademicoTCC)) - TCC @elseif(!empty($orientacao->AcademicoEstagio)) - Estágio @endif
                            </option>
                        @endforeach
                    </select>
                    <span class="{{ $errors->has('orientacao_id') ? 'text-danger' : '' }}">
                        {{ $errors->has('orientacao_id') ? $errors->first('orientacao_id') : '' }}
                    </span>
                </div>
                <div class="row g-3 mb-4">
                    {{-- <input id="orientacao_id" name="orientacao_id" type="hidden" class="form-control" value="{{ $orientacao->id }}"> --}}
                    <div class="col-md">
                        <div class="mb-3">
                            <div class="form-label required">Título</div>
                            <div><input id="titulo" name="titulo" type="text" class="form-control"
                                    value="{{ old('titulo', $atividade->titulo) }}" /></div>
                            <span class="{{ $errors->has('titulo') ? 'text-danger' : '' }}">
                                {{ $errors->has('titulo') ? $errors->first('titulo') : '' }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Descrição</div>
                            <input id="descricao" name="descricao" type="text" class="form-control"
                                value="{{ old('descricao', $atividade->descricao) }}" />
                            <span class="{{ $errors->has('descricao') ? 'text-danger' : '' }}">
                                {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Arquivos auxiliares</div>
                            <input type="file" name="arquivos_aux[]" id="arquivos_aux" accept=".xlsx" class="form-control" multiple>
                            <span class="{{ $errors->has('arquivos_aux') ? 'text-danger' : '' }}">
                                {{ $errors->has('arquivos_aux') ? $errors->first('arquivos_aux') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row d-flex justify-content-start">
                        <div class="col flex-column">
                            <div class="form-label required">Data limite para entrega</div>
                            <div>
                                <input type="hidden" id="data_limite" name="data_limite" value="{{ old('data_limite', $atividade->data_limite) }}" autocomplete="off" />
                            </div>
                            <div>
                                <span class="{{ $errors->has('data_limite') ? 'text-danger' : '' }}">
                                    {{ $errors->has('data_limite') ? $errors->first('data_limite') : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Hora</label>
                            <input type="text" name="hora" id="hora" class="form-control" data-mask="00:00" data-mask-visible="true" placeholder="00:00" autocomplete="off" value="{{ old('hora', \Carbon\Carbon::parse($atividade->data_limite)->format('H:i')) }}"/>
                            <span class="{{ $errors->has('hora') ? 'text-danger' : '' }}">
                                {{ $errors->has('hora') ? $errors->first('hora') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date();
            const year = today.getFullYear();
            const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
            const endDate = new Date(year, 11, 31); // Último dia do ano atual

            window.Litepicker && (new Litepicker({
                element: document.getElementById('data_limite'),
                buttonText: {
                    previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    apply: 'Aplicar',
                    cancel: 'Cancelar',
                    reset: 'Resetar'
                },
                minDate: startDate,
                maxDate: endDate,
                // format: 'D/MM/YYYY',
                lang: 'pt-BR',
                autoApply: true,
                //autoApply: false // Desativar aplicação automática
                inlineMode: true,
                onSelect: function(dateText) {
                    document.getElementById('data_limite').value = dateText;
                }
            }));
        });
        // @formatter:on
    </script>
@endsection
