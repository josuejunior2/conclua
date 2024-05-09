@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Cadastro de semestre</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.semestre.update', ['semestre' => $semestre]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="col-3 col-form-label required">Ano</label>
            <div class="col">
                <input type="text" class="form-control" name="ano" id="ano" value="{{ $semestre->ano }}">
            </div>
            <span class="{{ $errors->has('ano') ? 'text-danger' : '' }}">
                {{ $errors->has('ano') ? $errors->first('ano') : '' }}
        </span>
        </div>
        <div class="col-md mb-3">
            <div class="form-label required">Número do semestre: {{ $semestre->periodo }}</div>
            <select class="d-none" name="periodo" id="periodo" value="{{ $semestre->periodo }}">
                <option value=""> -- Selecione o semestre -- </option>
                <option value="1" {{ $semestre->periodo == '1' ? 'selected' : '' }}>1º Semestre</option>
                <option value="2" {{ $semestre->periodo == '2' ? 'selected' : '' }}>2º Semestre</option>
            </select>
            <span class="{{ $errors->has('periodo') ? 'text-danger' : '' }}">
                    {{ $errors->has('periodo') ? $errors->first('periodo') : '' }}
            </span>
        </div>
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="form-label">Data de início</div>
                <div class="datagrid-content">
                    <input type="hidden" id="data_inicio" name="data_inicio" value="{{ old('data_inicio') ?? $semestre->data_inicio }}" autocomplete="off"/>
                    <span class="{{ $errors->has('data_inicio') ? 'text-danger' : '' }}">
                        {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Data de finalização</div>
                <div class="datagrid-content">
                    <input type="hidden" id="data_fim" name="data_fim" value="{{ old('data_fim') ?? $semestre->data_fim }}" autocomplete="off"/>
                    <span class="{{ $errors->has('data_fim') ? 'text-danger' : '' }}">
                        {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Data-limite de entrega de documentos de estágio</div>
                <div class="datagrid-content">
                    <input type="hidden" id="limite_doc_estagio" name="limite_doc_estagio" value="{{ old('limite_doc_estagio') ?? $semestre->limite_doc_estagio }}" autocomplete="off"/>
                    <span class="{{ $errors->has('limite_doc_estagio') ? 'text-danger' : '' }}">
                        {{ $errors->has('limite_doc_estagio') ? $errors->first('limite_doc_estagio') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Data-limite de entrega de documentos de orientação</div>
                <div class="datagrid-content">
                    <input type="hidden" id="limite_orientacao" name="limite_orientacao" value="{{ old('limite_orientacao') ?? $semestre->limite_orientacao }}" autocomplete="off"/>
                    <span class="{{ $errors->has('limite_orientacao') ? 'text-danger' : '' }}">
                        {{ $errors->has('limite_orientacao') ? $errors->first('limite_orientacao') : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
            Atualizar
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
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('ano');
        input.value = new Date().getFullYear(); // Define o valor do campo para o ano atual
    });
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();
        const year = today.getFullYear();
        const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
        const endDate = new Date(year, 11, 31); // Último dia do ano atual

    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('data_inicio'),
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
        onSelect: function (dateText) {
            document.getElementById('data_inicio').value = dateText;
        }
    	}));
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();
        const year = today.getFullYear();
        const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
        const endDate = new Date(year, 11, 31); // Último dia do ano atual

        window.Litepicker && (new Litepicker({
            element: document.getElementById('data_fim'),
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
            //autoApply: false
            inlineMode: true,
        }));
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const year = today.getFullYear();
    const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
    const endDate = new Date(year, 11, 31); // Último dia do ano atual

    window.Litepicker && (new Litepicker({
        element: document.getElementById('limite_doc_estagio'),
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
    }));
});
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();
        const year = today.getFullYear();
        const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
        const endDate = new Date(year, 11, 31); // Último dia do ano atual

        window.Litepicker && (new Litepicker({
            element: document.getElementById('limite_orientacao'),
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
        }));
    });
    // @formatter:on
</script>
@endsection

