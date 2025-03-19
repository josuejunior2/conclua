@extends('layouts.admin')

@section('content')
    <div class="card m-3">
        <div class="card-header">
            <h3 class="card-title">Cadastro de modelo de documento</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.modelo_documento.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="mb-3">
                            <label class="form-label required" for="nome">Nome</label>
                            <div><input id="nome" name="nome" type="text" class="form-control"
                                    value="{{ old('nome', '') }}" /></div>
                            <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                                {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label">Modalidade</label>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modalidade" id="modalidade" value=""
                                        {{ old('modalidade') == '' ? 'checked' : '' }}>
                                    <span class="form-check-label">Todos</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modalidade" id="modalidade" value="tcc"
                                        {{ old('modalidade') == 'tcc' ? 'checked' : '' }}>
                                    <span class="form-check-label">TCC</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modalidade" id="modalidade" value="estagio"
                                        {{ old('modalidade') == 'estagio' ? 'checked' : '' }}>
                                    <span class="form-check-label">Estágio</span>
                                </label>
                                <span class="{{ $errors->has('modalidade') ? 'text-danger' : '' }}">
                                    {{ $errors->has('modalidade') ? $errors->first('modalidade') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="mb-3">
                            <label class="form-label" for="arquivos">Arquivos</label>
                            <input type="file" name="arquivos[]" id="arquivos" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.bmp,.gif,.svg,.xlsx,.csv" class="form-control" multiple>
                            <span class="{{ $errors->has('arquivos') ? 'text-danger' : '' }}">
                                {{ $errors->has('arquivos') ? $errors->first('arquivos') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="mb-3">
                            <label class="form-label" for="descricao">Descrição</label>
                            <textarea id="descricao" class="form-control" name="descricao" rows="12">{{ old('descricao', '') }}</textarea>
                            <span class="{{ $errors->has('descricao') ? 'text-danger' : '' }}">
                                {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="row d-flex justify-content-start">
                            <div class="col flex-column">
                                <label class="form-label required" for="data_limite">Data limite para entrega</label>
                                <div>
                                    <input type="hidden" id="data_limite" name="data_limite" value="{{ old('data_limite', '') }}" autocomplete="off" />
                                </div>
                                <div>
                                    <span class="{{ $errors->has('data_limite') ? 'text-danger' : '' }}">
                                        {{ $errors->has('data_limite') ? $errors->first('data_limite') : '' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label" for="hora">Hora</label>
                                <input type="time" name="hora" id="hora" class="form-control w-auto" autocomplete="off" value="{{ old('hora', '') }}"/>
                                <span class="{{ $errors->has('hora') ? 'text-danger' : '' }}">
                                    {{ $errors->has('hora') ? $errors->first('hora') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar
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