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
                    <form method="POST" action="{{ route('academicoTCC.store') }}" autocomplete="off" novalidate>
                        @csrf

                        <div class="row g-3 mb-4">
                            <div class="col-md">
                                <div class="mb-3">
                                    <div class="form-label required">Tema do Trabalho de Conclusão de Curso</div>
                                    <div><input id="tema" name="tema"  type="text" class="form-control" value="{{ old('tema', '') }}" /></div>
                                    <span class="{{ $errors->has('tema') ? 'text-danger' : '' }}">
                                        {{ $errors->has('tema') ? $errors->first('tema') : '' }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Resumo do Trabalho de Conclusão de Curso</label>
                                    <textarea id="resumo" class="form-control" name="resumo" rows="6" placeholder="Este trabalho..." value="{{ old('resumo', '') }}"></textarea>
                                    <span class="{{ $errors->has('resumo') ? 'text-danger' : '' }}">
                                        {{ $errors->has('resumo') ? $errors->first('resumo') : '' }}
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
     <!-- Libs JS -->
     <!-- Tabler Core -->
     <script src="/back/dist/js/tabler.min.js?1684106062" defer></script>
     <script src="/back/dist/js/demo.min.js?1684106062" defer></script>
 </html>

