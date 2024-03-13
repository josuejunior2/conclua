@extends('layouts.guest')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <ul class="steps steps-green steps-counter my-4">
                    <li class="step-item">Informações gerais</li>
                    <li class="step-item active">Especificações</li>
                    <li class="step-item">Confirmação</li>
                </ul>
                <form method="POST" action="{{ route('academicoTCC.store') }}" autocomplete="off" novalidate>
                    @csrf
                    <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Tema do Trabalho de Conclusão de Curso</div>
                                <div><input id="tema" name="tema"  type="text" class="form-control" value="{{ old('tema', '') }}" /></div>
                                <span class="{{ $errors->has('tema') ? 'text-danger' : '' }}">
                                    {{ $errors->has('tema') ? $errors->first('tema') : '' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Resumo do Trabalho de Conclusão de Curso</label>
                                <textarea id="resumo" class="form-control" name="resumo" rows="6" placeholder="Este trabalho..." value="{{ old('resumo', '') }}"></textarea>
                                <span class="{{ $errors->has('resumo') ? 'text-danger' : '' }}">
                                    {{ $errors->has('resumo') ? $errors->first('resumo') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
