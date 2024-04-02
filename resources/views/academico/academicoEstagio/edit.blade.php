@extends('layouts.guest')

@section('content')

<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <ul class="steps steps-green steps-counter my-4">
                    <li class="step-item">Editar dados da empresa</li>
                    <li class="step-item active">Editar dados do estágio</li>
                </ul>
                <form method="POST" action="{{ route('academicoEstagio.update', ['academicoEstagio' => $academicoEstagio]) }}" autocomplete="off" novalidate>
                    @csrf
                    @method('PUT')
                    <input id="empresa_id" name="empresa_id" type="hidden" class="form-control" value="{{ $academicoEstagio->Empresa->id }}">
                    <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academicoEstagio->academico_id }}">
                    <input id="semestre_id" name="semestre_id" type="hidden" class="form-control" value="{{ $academicoEstagio->Semestre->id }}">
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                           <div class="mb-3">
                               <div class="form-label required">Tema do Estágio</div>
                               <div><input id="tema" name="tema"  type="text" class="form-control" value="{{ $academicoEstagio->tema }}" /></div>
                               <span class="{{ $errors->has('tema') ? 'text-danger' : '' }}">
                                   {{ $errors->has('tema') ? $errors->first('tema') : '' }}
                               </span>
                           </div>
                           <div class="mb-3">
                               <div class="form-label required">Função exercida na empresa</div>
                               <input id="funcao" name="funcao"  type="text" class="form-control" value="{{ $academicoEstagio->funcao }}" />
                               <span class="{{ $errors->has('funcao') ? 'text-danger' : '' }}">
                                   {{ $errors->has('funcao') ? $errors->first('funcao') : '' }}
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

