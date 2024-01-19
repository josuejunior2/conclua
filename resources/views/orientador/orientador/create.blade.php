{{--
checklist

orientadoresgeral = email, nome e senha do user    =
 ^ deixar habilitado as mudanças, só que depois igualar com user
preencher role_id ao submeter o form               =
criar tabelas orientadores, formacoes e areas      =
CRUD de área (or. geral) e subárea (orientadores)  =


Depois
lógica de Semestre em tudo (middleware ?)
 --}}


<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Settings - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
        <!-- CSS files -->
        <link href="/back/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
        <link href="/back/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
        <link href="/back/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
        <link href="/back/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
        <link href="/back/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
        <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
        </style>
    </head>
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
                            <div class="form-label">Link do Currículo Lattes</div>
                            <input id="enderecoLattes" name="enderecoLattes"  type="text" class="form-control" value="{{ old('enderecoLattes', '') }}">
                            <span class="{{ $errors->has('enderecoLattes') ? 'text-danger' : '' }}">
                                {{ $errors->has('enderecoLattes') ? $errors->first('enderecoLattes') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 1</div>
                            <input id="areaPesquisa1" name="areaPesquisa1"  type="text" class="form-control" value="{{ old('areaPesquisa1', '') }}">
                            <span class="{{ $errors->has('areaPesquisa1') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa1') ? $errors->first('areaPesquisa1') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 2</div>
                            <input id="areaPesquisa2" name="areaPesquisa2"  type="text" class="form-control" value="{{ old('areaPesquisa2', '') }}">
                            <span class="{{ $errors->has('areaPesquisa2') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa2') ? $errors->first('areaPesquisa2') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 3</div>
                            <input id="areaPesquisa3" name="areaPesquisa3"  type="text" class="form-control" value="{{ old('areaPesquisa3', '') }}">
                            <span class="{{ $errors->has('areaPesquisa3') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa3') ? $errors->first('areaPesquisa3') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 4</div>
                            <input id="areaPesquisa4" name="areaPesquisa4"  type="text" class="form-control" value="{{ old('areaPesquisa4', '') }}">
                            <span class="{{ $errors->has('areaPesquisa4') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa4') ? $errors->first('areaPesquisa4') : '' }}
                            </span>
                            <div class="form-label">Área de Pesquisa 5</div>
                            <input id="areaPesquisa5" name="areaPesquisa5"  type="text" class="form-control" value="{{ old('areaPesquisa5', '') }}">
                            <span class="{{ $errors->has('areaPesquisa5') ? 'text-danger' : '' }}">
                                {{ $errors->has('areaPesquisa5') ? $errors->first('areaPesquisa5') : '' }}
                            </span>
                        </div>
                        <div class="col-md">
                            <div class="form-label">Link do Currículo Orcid</div>
                            <input id="enderecoOrcid" name="enderecoOrcid" type="text" class="form-control" value="{{ old('enderecoOrcid', '') }}">
                            <span class="{{ $errors->has('enderecoOrcid') ? 'text-danger' : '' }}">
                                {{ $errors->has('enderecoOrcid') ? $errors->first('enderecoOrcid') : '' }}
                            </span>
                             <div class="form-label">Sub-área 1</div>
                            <input id="subArea1" name="subArea1"  type="text" class="form-control" value="{{ old('subArea1', '') }}">
                            <span class="{{ $errors->has('subArea1') ? 'text-danger' : '' }}">
                                {{ $errors->has('subArea1') ? $errors->first('subArea1') : '' }}
                            </span>
                            <div class="form-label">Sub-área 2</div>
                            <input id="subArea2" name="subArea2"  type="text" class="form-control" value="{{ old('subArea2', '') }}">
                            <span class="{{ $errors->has('subArea2') ? 'text-danger' : '' }}">
                                {{ $errors->has('subArea2') ? $errors->first('subArea2') : '' }}
                            </span>
                            <div class="form-label">Sub-área 3</div>
                            <input id="subArea3" name="subArea3"  type="text" class="form-control" value="{{ old('subArea3', '') }}">
                            <span class="{{ $errors->has('subArea3') ? 'text-danger' : '' }}">
                                {{ $errors->has('subArea3') ? $errors->first('subArea3') : '' }}
                            </span>
                            <div class="col-3">
                                <div class="form-label">Disponibilidade</div>
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
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/back/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="/back/dist/js/demo.min.js?1684106062" defer></script>
</html>

