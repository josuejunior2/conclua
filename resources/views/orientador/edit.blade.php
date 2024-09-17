@extends('layouts.orientador')

@section('content')
    <div class="col-12">
        <div class="card m-3">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Editar meus dados</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('orientador.update', ['orientador' => $orientador]) }}"
                    autocomplete="off" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-4">
                        <div class="mb-3">
                            <label class="form-label required">Atualize sua senha</label>
                            <div>
                                <input name="password" type="password" class="form-control" placeholder="Password"
                                    value="">
                                <small class="form-hint">
                                    A senha deve ter no mínimo 8 caracteres, deve conter pelo menos uma letra maiúscula e
                                    minúscula, número e símbolo. (colocar regra no Request depois)
                                </small>
                                <span class="{{ $errors->has('password') ? 'text-danger' : '' }}">
                                    {{ $errors->has('password') ? $errors->first('password') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="form-label required">Selecione sua formação</div>
                            <select class="form-select" name="formacao_id" id="formacao_id">
                                <option value=""> -- Selecione a formação -- </option>
                                @foreach ($formacoes as $f)
                                    <option value="{{ $f->id }}"
                                        {{ (isset($orientador) && $orientador->formacao_id == $f->id) || old('formacao_id') == $f->id ? 'selected' : '' }}>
                                        {{ $f->nome }}
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
                                @foreach ($areas as $a)
                                    <option value="{{ $a->id }}"
                                        {{ (isset($orientador) && $orientador->area_id == $a->id) || old('area_id') == $a->id ? 'selected' : '' }}>
                                        {{ $a->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="{{ $errors->has('area_id') ? 'text-danger' : '' }}">
                                {{ $errors->has('area_id') ? $errors->first('area_id') : '' }}
                            </span>
                            {{-- {{ $errors->has('area_id') ? $errors->first('area_id') : '' }} --}}
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="form-label required">Link do Currículo Lattes</div>
                            <input id="enderecoLattes" name="enderecoLattes" type="text" class="form-control"
                                value="{{ isset($orientador) && $orientador->enderecoLattes ? $orientador->enderecoLattes : old('enderecoLattes', '') }}">
                            <small class="form-hint mb-3">
                                O link do curriculo Lattes deve estar no modelo: http://lattes.cnpq.br/0000000000000000
                            </small>
                            <span class="{{ $errors->has('enderecoLattes') ? 'text-danger' : '' }}">
                                {{ $errors->has('enderecoLattes') ? $errors->first('enderecoLattes') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 1</div>
                            <input id="areaPesquisa1" name="areaPesquisa1" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->areaPesquisa1 ? $orientador->areaPesquisa1 : old('areaPesquisa1', '') }}">
                            <span class="{{ $errors->has('areaPesquisa1') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa1') ? $errors->first('areaPesquisa1') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 2</div>
                            <input id="areaPesquisa2" name="areaPesquisa2" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->areaPesquisa2 ? $orientador->areaPesquisa2 : old('areaPesquisa2', '') }}">
                            <span class="{{ $errors->has('areaPesquisa2') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa2') ? $errors->first('areaPesquisa2') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 3</div>
                            <input id="areaPesquisa3" name="areaPesquisa3" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->areaPesquisa3 ? $orientador->areaPesquisa3 : old('areaPesquisa3', '') }}">
                            <span class="{{ $errors->has('areaPesquisa3') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa3') ? $errors->first('areaPesquisa3') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 4</div>
                            <input id="areaPesquisa4" name="areaPesquisa4" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->areaPesquisa4 ? $orientador->areaPesquisa4 : old('areaPesquisa4', '') }}">
                            <span class="{{ $errors->has('areaPesquisa4') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa4') ? $errors->first('areaPesquisa4') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 5</div>
                            <input id="areaPesquisa5" name="areaPesquisa5" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->areaPesquisa5 ? $orientador->areaPesquisa5 : old('areaPesquisa5', '') }}">
                            <span class="{{ $errors->has('areaPesquisa5') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa5') ? $errors->first('areaPesquisa5') : '' }}
                            </span>
                        </div>
                        <div class="col-md">
                            <div class="form-label required">Link do Currículo Orcid</div>
                            <input id="enderecoOrcid" name="enderecoOrcid" type="text" class="form-control"
                                value="{{ isset($orientador) && $orientador->enderecoOrcid ? $orientador->enderecoOrcid : old('enderecoOrcid', '') }}">
                            <small class="form-hint mb-3">
                                O link do curriculo Orcid deve estar no modelo: https://orcid.org/0000-0000-0000-0000
                            </small>
                            <span class="{{ $errors->has('enderecoOrcid') ? 'text-danger' : '' }}">
                                {{ $errors->has('enderecoOrcid') ? $errors->first('enderecoOrcid') : '' }}
                            </span>
                            <div class="form-label">Sub-área 1</div>
                            <input id="subArea1" name="subArea1" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->subArea1 ? $orientador->subArea1 : old('subArea1', '') }}">
                            <span class="{{ $errors->has('subArea1') ? 'text-danger' : '' }}">
                                {{ $errors->has('subArea1') ? $errors->first('subArea1') : '' }}
                            </span>
                            <div class="form-label">Sub-área 2</div>
                            <input id="subArea2" name="subArea2" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->subArea2 ? $orientador->subArea2 : old('subArea2', '') }}">
                            <span class="{{ $errors->has('subArea2') ? 'text-danger' : '' }}">
                                {{ $errors->has('subArea2') ? $errors->first('subArea2') : '' }}
                            </span>
                            <div class="form-label">Sub-área 3</div>
                            <input id="subArea3" name="subArea3" type="text" class="form-control mb-3"
                                value="{{ isset($orientador) && $orientador->subArea3 ? $orientador->subArea3 : old('subArea3', '') }}">
                            <span class="{{ $errors->has('subArea3') ? 'text-danger' : '' }}">
                                {{ $errors->has('subArea3') ? $errors->first('subArea3') : '' }}
                            </span>
                            <div class="col-3 mb-3">
                                <div class="form-label required">Disponibilidade</div>
                                <select id="disponibilidade" name="disponibilidade" class="form-select"
                                    value="{{ old('disponibilidade', '') }}"
                                    {{ $orientador->disponibilidade == 6 ?? 'disabled' }}>
                                    @php
                                        if ($orientacoes->isEmpty(0) || $orientador->disponibilidade == 6) {
                                            $i = $orientador->disponibilidade;
                                        } else {
                                            $i = $orientacoes->count() + 1;
                                        }
                                    @endphp
                                    @for ($i; $i <= 6; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('disponibilidade') == $i || $orientador->disponibilidade == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                    {{-- <option value="0">0</option>
                                        <option value="1" {{ old('disponibilidade') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('disponibilidade') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('disponibilidade') == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('disponibilidade') == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('disponibilidade') == '5' ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ old('disponibilidade') == '6' ? 'selected' : '' }}>6</option> --}}
                                </select>
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
@endsection
