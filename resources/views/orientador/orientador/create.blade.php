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
                <form method="POST" action="{{ route('orientador.store') }}" autocomplete="off" novalidate>
                    @csrf
                    <input id="orientadorGeral_id" name="orientadorGeral_id" type="hidden" class="form-control" value="{{ $orientadorGeral_id }}">
                    <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="form-label required">Link do Currículo Lattes</div>
                        <input id="enderecoLattes" name="enderecoLattes"  type="text" class="form-control" value="{{ old('enderecoLattes', '') }}">
                        <small class="form-hint mb-3">
                            O link do curriculo Lattes deve estar no modelo: http://lattes.cnpq.br/0000000000000000
                        </small>
                        <span class="{{ $errors->has('enderecoLattes') ? 'text-danger' : '' }}">
                            {{ $errors->has('enderecoLattes') ? $errors->first('enderecoLattes') : '' }}
                        </span>
                        <div class="form-label">Área de Pesquisa 1</div>
                        <input id="areaPesquisa1" name="areaPesquisa1"  type="text" class="form-control mb-3" value="{{ old('areaPesquisa1', '') }}">
                        <span class="{{ $errors->has('areaPesquisa1') ? 'text-danger' : '' }}">
                            {{ $errors->has('areaPesquisa1') ? $errors->first('areaPesquisa1') : '' }}
                        </span>
                        <div class="form-label">Área de Pesquisa 2</div>
                        <input id="areaPesquisa2" name="areaPesquisa2"  type="text" class="form-control mb-3" value="{{ old('areaPesquisa2', '') }}">
                        <span class="{{ $errors->has('areaPesquisa2') ? 'text-danger' : '' }}">
                            {{ $errors->has('areaPesquisa2') ? $errors->first('areaPesquisa2') : '' }}
                        </span>
                        <div class="form-label">Área de Pesquisa 3</div>
                        <input id="areaPesquisa3" name="areaPesquisa3"  type="text" class="form-control mb-3" value="{{ old('areaPesquisa3', '') }}">
                        <span class="{{ $errors->has('areaPesquisa3') ? 'text-danger' : '' }}">
                            {{ $errors->has('areaPesquisa3') ? $errors->first('areaPesquisa3') : '' }}
                        </span>
                        <div class="form-label">Área de Pesquisa 4</div>
                        <input id="areaPesquisa4" name="areaPesquisa4"  type="text" class="form-control mb-3" value="{{ old('areaPesquisa4', '') }}">
                        <span class="{{ $errors->has('areaPesquisa4') ? 'text-danger' : '' }}">
                            {{ $errors->has('areaPesquisa4') ? $errors->first('areaPesquisa4') : '' }}
                        </span>
                        <div class="form-label">Área de Pesquisa 5</div>
                        <input id="areaPesquisa5" name="areaPesquisa5"  type="text" class="form-control mb-3" value="{{ old('areaPesquisa5', '') }}">
                        <span class="{{ $errors->has('areaPesquisa5') ? 'text-danger' : '' }}">
                            {{ $errors->has('areaPesquisa5') ? $errors->first('areaPesquisa5') : '' }}
                        </span>
                    </div>
                    <div class="col-md">
                        <div class="form-label required">Link do Currículo Orcid</div>
                        <input id="enderecoOrcid" name="enderecoOrcid" type="text" class="form-control" value="{{ old('enderecoOrcid', '') }}">
                        <small class="form-hint mb-3">
                            O link do curriculo Orcid deve estar no modelo: https://orcid.org/0000-0000-0000-0000
                        </small>
                        <span class="{{ $errors->has('enderecoOrcid') ? 'text-danger' : '' }}">
                            {{ $errors->has('enderecoOrcid') ? $errors->first('enderecoOrcid') : '' }}
                        </span>
                            <div class="form-label">Sub-área 1</div>
                        <input id="subArea1" name="subArea1"  type="text" class="form-control mb-3" value="{{ old('subArea1', '') }}">
                        <span class="{{ $errors->has('subArea1') ? 'text-danger' : '' }}">
                            {{ $errors->has('subArea1') ? $errors->first('subArea1') : '' }}
                        </span>
                        <div class="form-label">Sub-área 2</div>
                        <input id="subArea2" name="subArea2"  type="text" class="form-control mb-3" value="{{ old('subArea2', '') }}">
                        <span class="{{ $errors->has('subArea2') ? 'text-danger' : '' }}">
                            {{ $errors->has('subArea2') ? $errors->first('subArea2') : '' }}
                        </span>
                        <div class="form-label">Sub-área 3</div>
                        <input id="subArea3" name="subArea3"  type="text" class="form-control mb-3" value="{{ old('subArea3', '') }}">
                        <span class="{{ $errors->has('subArea3') ? 'text-danger' : '' }}">
                            {{ $errors->has('subArea3') ? $errors->first('subArea3') : '' }}
                        </span>
                        <div class="col-3">
                            <div class="form-label required">Disponibilidade</div>
                            <select id="disponibilidade" name="disponibilidade" class="form-select" value="{{ old('disponibilidade', '') }}">
                                <option value="0" selected>0</option>
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                                <option value="6" >6</option>
                            </select>
                            </div>
                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <a href="{{ route('login') }}" class="btn">
                                Cancel
                            </a>
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

