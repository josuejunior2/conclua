@extends('layouts.guest')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <ul class="steps steps-green steps-counter my-4">
                    <li class="step-item active">Editar dados da empresa</li>
                    <li class="step-item">Editar dados do estágio</li>
                </ul>
                <form method="POST" action="{{ route('empresa.update', ['empresa' => $empresa]) }}" autocomplete="off" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-4">
                    <div class="col-md">
                    <div class="mb-3">
                        <div class="form-label required">Nome da Empresa</div>
                        <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ $empresa->nome }}" /></div>
                        <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <div class="form-label required">Nome do Supervisor</div>
                        <input id="supervisor" name="supervisor"  type="text" class="form-control" value="{{ $empresa->supervisor }}" />
                        <span class="{{ $errors->has('supervisor') ? 'text-danger' : '' }}">
                            {{ $errors->has('supervisor') ? $errors->first('supervisor') : '' }}
                        </span>
                    </div>
                    </div>
                    <div class="col-md">
                    <div class="mb-3">
                        <div class="form-label required">Cadastro Nacional de Pessoa Jurídica (CNPJ)</div>
                        <input id="cnpj" name="cnpj" type="text" class="form-control" value="{{ $empresa->cnpj }}" data-mask="00.000.000/0000-00" data-mask-visible="true" placeholder="00.000.000/0000-00"autocomplete="off" />
                        <span class="{{ $errors->has('cnpj') ? 'text-danger' : '' }}">
                            {{ $errors->has('cnpj') ? $errors->first('cnpj') : '' }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <div class="form-label required">Email do Supervisor</div>
                        <input id="email" name="email"  type="text" class="form-control" value="{{ $empresa->email }}" />
                        <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                            {{ $errors->has('email') ? $errors->first('email') : '' }}
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
