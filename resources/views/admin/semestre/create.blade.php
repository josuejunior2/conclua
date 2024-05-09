@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Cadastro de semestre: @if($tem1periodo) 2/{{ now()->format('Y') }} @elseif($tem2periodo || (!$tem1periodo && !$tem2periodo)) 1/{{ now()->format('Y') }} @endif</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.semestre.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ano" id="ano" value="{{ now()->format('Y') }}">
        <span class="{{ $errors->has('ano') ? 'text-danger' : '' }}">
            {{ $errors->has('ano') ? $errors->first('ano') : '' }}
        </span>
        @if($tem1periodo)
            <input type="hidden" name="periodo" id="periodo" value="2">
        @elseif($tem2periodo || (!$tem1periodo && !$tem2periodo))
            <input type="hidden" name="periodo" id="periodo" value="1">
        @endif
        <span class="{{ $errors->has('periodo') ? 'text-danger' : '' }}">
            {{ $errors->has('periodo') ? $errors->first('periodo') : '' }}
        </span>

        <div class="datagrid">
            <div class="datagrid-item">
                <div class="form-label">Data de início</div>
                <div class="datagrid-content">
                    <input type="hidden" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', '') }}" autocomplete="off"/>
                    <span class="{{ $errors->has('data_inicio') ? 'text-danger' : '' }}">
                        {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Data de finalização</div>
                <div class="datagrid-content">
                    <input type="hidden" id="data_fim" name="data_fim" value="{{ old('data_fim', '') }}" autocomplete="off"/>
                    <span class="{{ $errors->has('data_fim') ? 'text-danger' : '' }}">
                        {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Data-limite de entrega de documentos de estágio</div>
                <div class="datagrid-content">
                    <input type="hidden" id="limite_doc_estagio" name="limite_doc_estagio" value="{{ old('limite_doc_estagio', '') }}" autocomplete="off"/>
                    <span class="{{ $errors->has('limite_doc_estagio') ? 'text-danger' : '' }}">
                        {{ $errors->has('limite_doc_estagio') ? $errors->first('limite_doc_estagio') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Data-limite de entrega de documentos de orientação</div>
                <div class="datagrid-content">
                    <input type="hidden" id="limite_orientacao" name="limite_orientacao" value="{{ old('limite_orientacao', '') }}" autocomplete="off"/>
                    <span class="{{ $errors->has('limite_orientacao') ? 'text-danger' : '' }}">
                        {{ $errors->has('limite_orientacao') ? $errors->first('limite_orientacao') : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
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

