@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <ul class="steps steps-green steps-counter my-4">
                    <li class="step-item">Informações gerais</li>
                    <li class="step-item active">Dados da empresa</li>
                    <li class="step-item">Dados do estágio</li>
                    <li class="step-item">Confirmação</li>
                </ul>
                <form method="POST" action="{{ route('empresa.store') }}" autocomplete="off" novalidate>
                    @csrf
                    <div class="row g-3 mb-4">
                    <div class="col-md">
                    <div class="mb-3">
                        <div class="form-label required">Nome da Empresa</div>
                        <div><input id="name" name="name"  type="text" class="form-control" value="{{ old('name', '') }}" /></div>
                        <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">
                            {{ $errors->has('name') ? $errors->first('name') : '' }}
                        </span>
                    </div>
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
                        <div class="form-label required">Cadastro Nacional de Pessoa Jurídica (CNPJ)</div>
                        <input id="cnpj" name="cnpj" type="text" class="form-control" value="{{ old('cnpj', '') }}" data-mask="00.000.000/0000-00" data-mask-visible="true" placeholder="00.000.000/0000-00"autocomplete="off" />
                        <span class="{{ $errors->has('cnpj') ? 'text-danger' : '' }}">
                            {{ $errors->has('cnpj') ? $errors->first('cnpj') : '' }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <div class="form-label required">Email do Supervisor</div>
                        <input id="email" name="email"  type="text" class="form-control" value="{{ old('email', '') }}" />
                        <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                            {{ $errors->has('email') ? $errors->first('email') : '' }}
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
@endsection