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
     <!-- Libs JS -->
     <!-- Tabler Core -->
     <script src="/back/dist/js/tabler.min.js?1684106062" defer></script>
     <script src="/back/dist/js/demo.min.js?1684106062" defer></script>
 </html>

