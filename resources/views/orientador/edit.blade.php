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
                    <div class="row g-3 mb-2">
                        <div class="col-md">
                            <label class="form-label">Atualize sua senha</label>
                            <div>
                                <input name="password" type="password" class="form-control" placeholder="Senha"
                                    value="">
                                <small class="form-hint">
                                    A senha deve ter no mínimo 8 caracteres, incluir letras maiúsculas e minúsculas, conter pelo menos um número, um símbolo (como !, @, #, $) e não deve ter sido comprometida em violações de dados conhecidas.
                                </small>
                                <span class="{{ $errors->has('password') ? 'text-danger' : '' }}">
                                    {{ $errors->has('password') ? $errors->first('password') : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="form-label required" for="sub_areas">Sub Áreas</label>
                            <select class="form-select" type="text" name="sub_areas[]" id="sub_areas" multiple>
                                @foreach ($subAreas as $subarea)
                                    <option value="{{ $subarea->id }}" {{ in_array($subarea->id, old('sub_area_id', $orientador->subAreas->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $subarea->nome }}</option>
                                @endforeach
                            </select>
                            <span class="{{ $errors->has('sub_area_id') ? 'text-danger' : '' }}">
                                {{ $errors->has('sub_area_id') ? $errors->first('sub_area_id') : '' }}
                            </span>
                        </div>    
                    </div>
                    <div class="row g-3 mb-2">
                        <div class="col-md">
                            <div class="form-label">Link do Currículo Lattes</div>
                            <input id="enderecoLattes" name="enderecoLattes" type="text" class="form-control"
                                value="{{ isset($orientador) && $orientador->enderecoLattes ? $orientador->enderecoLattes : old('enderecoLattes', '') }}">
                            <small class="form-hint mb-3">
                                O link do curriculo Lattes deve estar no modelo: http://lattes.cnpq.br/0000000000000000
                            </small>
                            <span class="{{ $errors->has('enderecoLattes') ? 'text-danger' : '' }}">
                                {{ $errors->has('enderecoLattes') ? $errors->first('enderecoLattes') : '' }}
                            </span>
                        </div>
                        <div class="col-md">
                            <div class="form-label">Link do Currículo Orcid</div>
                            <input id="enderecoOrcid" name="enderecoOrcid" type="text" class="form-control"
                                value="{{ isset($orientador) && $orientador->enderecoOrcid ? $orientador->enderecoOrcid : old('enderecoOrcid', '') }}">
                            <small class="form-hint mb-3">
                                O link do curriculo Orcid deve estar no modelo: https://orcid.org/0000-0000-0000-0000
                            </small>
                            <span class="{{ $errors->has('enderecoOrcid') ? 'text-danger' : '' }}">
                                {{ $errors->has('enderecoOrcid') ? $errors->first('enderecoOrcid') : '' }}
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

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('sub_areas'), {
            options: [
                @foreach($subAreas as $s)
                    {value: '{{ $s->id }}', text: '{{ $s->nome }}'},
                @endforeach
            ],
        }));
    });
</script>
@endsection
