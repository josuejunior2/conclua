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
                            <li class="step-item">Informações gerais</li>
                            <li class="step-item">Dados da empresa</li>
                            <li class="step-item">Dados do estágio</li>
                            <li class="step-item active">Confirmação</li>
                         </ul>
                         <h2 class="mb-4">Parabéns! Você acaba de completar seu cadastro no CONCLUA!</h2>
                         <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                             <a href="{{ route('academico.index') }}" class="btn btn-teal w-100" >
                                 Ir para a página inicial
                             </a>
                         </div>

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
