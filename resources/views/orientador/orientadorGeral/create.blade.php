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
  <body >
    <script src="/back/dist/js/demo-theme.min.js?1684106062"></script>
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

                        <form method="POST" action="{{ route('orientadorgeral.index') }}" autocomplete="off" novalidate>
                            @csrf
                            <div class="row g-3 mb-4">
                            <div class="col-md">
                                <div class="form-label required">MASP</div>
                                <input id="masp" name="masp"  type="text" class="form-control" value="{{ old('masp', '') }}">
                                <span class="{{ $errors->has('masp') ? 'text-danger' : '' }}">
                                    {{ $errors->has('masp') ? $errors->first('masp') : '' }}
                                </span>
                            </div>

                            <input id="password" name="password" type="hidden" class="form-control" value="{{ $user->password }}">

                            <div class="col-md">
                                <div class="form-label required">Nome</div>
                                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}">
                                <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">
                                    {{ $errors->has('name') ? $errors->first('name') : '' }}
                                </span>
                            </div>
                            <div class="col-md">
                                <div class="form-label required">Email</div>
                                <input id="email" name="email" type="text" class="form-control" value="{{ old('email', $user->email) }}">
                                <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                                    {{ $errors->has('email') ? $errors->first('email') : '' }}
                                </span>
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
                                {{-- {{ $errors->has('formacao_id') ? $errors->first('formacao_id') : '' }} --}}
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
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/back/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="/back/dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
