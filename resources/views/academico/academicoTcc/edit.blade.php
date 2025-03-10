@extends('layouts.guest')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <form method="POST" action="{{ route('academicoTCC.update', ['academicoTCC' => $academicoTCC]) }}" autocomplete="off" novalidate>
                    @csrf
                    @method('PUT')
                    <input id="semestre_id" name="semestre_id" type="hidden" class="form-control" value="{{ $academicoTCC->Semestre->id }}">
                    <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academicoTCC->Academico->id }}">
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Tema</div>
                                <div><input id="tema" name="tema"  type="text" class="form-control" value="{{ $academicoTCC->tema }}" /></div>
                                <span class="{{ $errors->has('tema') ? 'text-danger' : '' }}">
                                    {{ $errors->has('tema') ? $errors->first('tema') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Problema</div>
                                <div><input id="problema" name="problema"  type="text" class="form-control" value="{{ $academicoTCC->problema }}" /></div>
                                <span class="{{ $errors->has('tema') ? 'text-danger' : '' }}">
                                    {{ $errors->has('tema') ? $errors->first('problema') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label">Objetivo Geral</label>
                                <textarea id="objetivo_geral" class="form-control" name="objetivo_geral" rows="6">{{ $academicoTCC->objetivo_geral }}</textarea>
                                <span class="{{ $errors->has('objetivo_geral') ? 'text-danger' : '' }}">
                                    {{ $errors->has('objetivo_geral') ? $errors->first('objetivo_geral') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label">Objetivo Específico</label>
                                <textarea id="objetivo_especifico" class="form-control" name="objetivo_especifico" rows="6" placeholder="Este trabalho...">{{ $academicoTCC->objetivo_especifico }}</textarea>
                                <span class="{{ $errors->has('objetivo_especifico') ? 'text-danger' : '' }}">
                                    {{ $errors->has('objetivo_especifico') ? $errors->first('objetivo_especifico') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label">Justificativa</label>
                                <textarea id="justificativa" class="form-control" name="justificativa" rows="6" placeholder="Este trabalho...">{{ $academicoTCC->justificativa }}</textarea>
                                <span class="{{ $errors->has('justificativa') ? 'text-danger' : '' }}">
                                    {{ $errors->has('justificativa') ? $errors->first('justificativa') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label">Metodologia</label>
                                <textarea id="metodologia" class="form-control" name="metodologia" rows="6" placeholder="Este trabalho...">{{ $academicoTCC->metodologia }}</textarea>
                                <span class="{{ $errors->has('metodologia') ? 'text-danger' : '' }}">
                                    {{ $errors->has('metodologia') ? $errors->first('metodologia') : '' }}
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
        </div>
    </div>
    </div>
</div>
@endsection
