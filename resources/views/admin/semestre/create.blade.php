@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header flex-column align-items-start">
        <h3 class="card-title">Cadastro de semestre</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.semestre.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="input-group d-flex justify-content-center">
                <div class="col-sm-2">
                    <input type="number" min="1" max="3" name="periodo" id="periodo" class="form-control" autocomplete="off" value="{{ old('periodo', '') }}" placeholder="Período"/>
                    <span class="{{ $errors->has('periodo') ? 'text-danger' : '' }}">
                        {{ $errors->has('periodo') ? $errors->first('periodo') : '' }}
                    </span>
                </div>
                <div>
                    <span class="input-group-text">
                      /
                    </span>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="ano" id="ano" value="{{ old('ano', '') }}">
                        <option value="">Ano</option>
                        <option value="{{ now()->format('Y') }}" {{ old('ano') == now()->format('Y') ? 'selected' : '' }}>{{ now()->format('Y') }}</option>
                        <option value="{{ now()->addYear()->format('Y') }}" {{ old('ano') == now()->addYear()->format('Y') ? 'selected' : '' }}>{{ now()->addYear()->format('Y') }}</option>
                    </select>
                    <span class="{{ $errors->has('ano') ? 'text-danger' : '' }}">
                        {{ $errors->has('ano') ? $errors->first('ano') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="card-title">Datas limite do semestre</div>
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="form-label">Início</div>
                <div class="datagrid-content">
                    <input type="hidden" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', '') }}" autocomplete="off"/>
                    <span class="{{ $errors->has('data_inicio') ? 'text-danger' : '' }}">
                        {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
                    </span>
                </div>
            </div>
            <div class="datagrid-item">
                <div class="form-label">Finalização</div>
                <div class="datagrid-content">
                    <input type="hidden" id="data_fim" name="data_fim" value="{{ old('data_fim', '') }}" autocomplete="off"/>
                    <span class="{{ $errors->has('data_fim') ? 'text-danger' : '' }}">
                        {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}
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
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date();
        const year = today.getFullYear();
        const nextYear = today.getFullYear() + 1;
        const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
        const endDate = new Date(nextYear, 11, 31); // Último dia do ano atual

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
        const nextYear = today.getFullYear() + 1;
        const startDate = new Date(year, 0, 1); // Primeiro dia do ano atual
        const endDate = new Date(nextYear, 11, 31); // Último dia do ano atual

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
@endsection

