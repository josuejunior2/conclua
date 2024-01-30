@extends('layouts.app')

@section('content')
<div class="page">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                Complete seu cadastro
                </h2>
            </div>
            </div>
        </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
        <div class="container-xl">
            <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                <div class="card-body">
                    <ul class="steps steps-green steps-counter my-4">
                        <li class="step-item active">Informações gerais</li>
                        <li class="step-item">Especificações</li>
                        <li class="step-item">Confirmação</li>
                    </ul>

                    <form method="POST" action="{{ route('orientadorgeral.store') }}" autocomplete="off" novalidate>
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="mb-3">
                                <label class="form-label required">Atualize sua senha</label>
                                <div>
                                    <input name="password" type="password" class="form-control" placeholder="Password">
                                    <small class="form-hint">
                                    A senha deve ter no mínimo 8 caracteres, deve conter pelo menos uma letra maiúscula e minúscula, número e símbolo. (colocar regra no Request depois)
                                    </small>
                                    <span class="{{ $errors->has('passoword') ? 'text-danger' : '' }}">
                                    {{ $errors->has('passoword') ? $errors->first('passoword') : '' }}
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="form-label required">Selecione sua formação</div>
                            <select class="form-select" name="formacao_id" id="formacao_id">
                                <option value=""> -- Selecione a formação -- </option>
                                @foreach($formacoes as $f)
                                    <option value="{{ $f->id }}" {{ (isset($orientadorgeral) && $orientadorgeral->formacao_id == $f->id) || old('formacao_id') == $f->id ? 'selected' : '' }}>
                                        {{ $f->formacao }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="{{ $errors->has('formacao_id') ? 'text-danger' : '' }}">
                                {{ $errors->has('formacao_id') ? $errors->first('formacao_id') : '' }}
                            </span>
                        </div>
                        <div class="col-md">
                            <div class="form-label required">Selecione sua área de atuação</div>
                            <select class="form-select" name="area_id" id="area_id">
                                <option value=""> -- Selecione a área de atuação -- </option>
                                @foreach($areas as $a)
                                    <option value="{{ $a->id }}" {{ (isset($orientadorgeral) && $orientadorgeral->area_id == $a->id) || old('area_id') == $a->id ? 'selected' : '' }}>
                                        {{ $a->area }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="{{ $errors->has('area_id') ? 'text-danger' : '' }}">
                                {{ $errors->has('area_id') ? $errors->first('area_id') : '' }}
                            </span>
                            {{-- {{ $errors->has('area_id') ? $errors->first('area_id') : '' }} --}}
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
</div>
@endsection
