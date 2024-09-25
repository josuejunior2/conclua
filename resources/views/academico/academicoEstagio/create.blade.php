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
                    <li class="step-item">Dados da empresa</li>
                    <li class="step-item active">Dados do estágio</li>
                    <li class="step-item">Confirmação</li>
                </ul>
                <form method="POST" action="{{ route('academicoEstagio.store') }}" autocomplete="off" novalidate>
                    @csrf
                    <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
                    <input id="empresa_id" name="empresa_id" type="hidden" class="form-control" value="{{ $empresa->id }}">
                    <input id="semestre_id" name="semestre_id" type="hidden" class="form-control" value="{{ session('semestre_id') }}">
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                           <div class="mb-3">
                               <div class="form-label required">Tema do Estágio</div>
                               <div><input id="tema" name="tema"  type="text" class="form-control" value="{{ old('tema', '') }}" /></div>
                               <span class="{{ $errors->has('tema') ? 'text-danger' : '' }}">
                                   {{ $errors->has('tema') ? $errors->first('tema') : '' }}
                               </span>
                           </div>
                           <div class="mb-3">
                               <div class="form-label required">Setor de atuação</div>
                               <input id="setor_atuacao" name="setor_atuacao"  type="text" class="form-control" value="{{ old('setor_atuacao', '') }}" />
                               <span class="{{ $errors->has('setor_atuacao') ? 'text-danger' : '' }}">
                                   {{ $errors->has('setor_atuacao') ? $errors->first('setor_atuacao') : '' }}
                               </span>
                           </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Nome do Supervisor</div>
                                <input id="supervisor" name="supervisor"  type="text" class="form-control" value="{{ old('supervisor', '') }}" />
                                <span class="{{ $errors->has('supervisor') ? 'text-danger' : '' }}">
                                    {{ $errors->has('supervisor') ? $errors->first('supervisor') : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Email do Supervisor</div>
                                <input id="email_supervisor" name="email_supervisor"  type="text" class="form-control" value="{{ old('email_supervisor', '') }}" />
                                <span class="{{ $errors->has('email_supervisor') ? 'text-danger' : '' }}">
                                    {{ $errors->has('email_supervisor') ? $errors->first('email_supervisor') : '' }}
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

@endsection

