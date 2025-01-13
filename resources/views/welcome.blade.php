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
    <title>Bem-vindo ao CONCLUA</title>
    <!-- CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
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
  <body  class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page page-center">
        <div class="container container-narrow py-4">
          <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="/logo.png" width="110" height="32" alt="Tabler" class="navbar-brand-image"></a>
          </div>
          <div class="card card-md">
            <div class="card-body">
              @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
              <h3 class="card-title">Instruções</h3>
              <div class="markdown">
                  <h3>Olá, bem-vindo ao CONCLUA - Sistema para controle dos processos de Estágio e TCC do curso de Administração - UNIMONTES! </h3>
                  <p>Para ter uma conta, entre em contato com o coordenador do curso ou responsável pelo sistema, para que possa cadastrá-lo.</p>
                  <p>Assim que cadastrado, poderá completar seu cadastro com seu Estágio ou TCC. Após isso, poderá solicitar um professor para que possa orientá-lo. Uma vez vinculado a um Orientador, poderá receber atividades, submetê-las, trocar comentários e arquivos!</p>
                  <p>Atenção: atente-se às datas-limite do semestre.</p>
                  @auth
                      <div class="row">
                          <div class="col">
                              <a href="{{ route('home') }}" class="btn btn-outline-primary w-100">
                                Tela principal
                              </a>
                          </div>
                          <div class="col">
                            <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button class="btn btn-outline-danger w-100" type="submit" >
                                Sair
                              </button>
                            </form>
                          </div>
                      </div>
                  @elseif (auth()->guard('admin')->check())
                      <div class="row">
                          <div class="col">
                              <a href="{{ route('admin.home') }}" class="btn btn-outline-primary w-100">
                                Tela principal
                              </a>
                          </div>
                          <div class="col">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button class="btn btn-outline-danger w-100" type="submit" >
                                  Sair
                                </button>
                            </form>
                          </div>
                      </div>
                  @else
                      <div class="row text-center">
                        <div class="col-md mb-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                              Login - Acadêmico
                            </a>
                        </div>
                        <div class="col-md mb-2">
                            <a href="{{ route('admin.login.index', ['tipo' => 'Orientador']) }}" class="btn btn-outline-success w-100">
                              Login - Orientador
                            </a>
                        </div>
                        <div class="col-md mb-2">
                            <a href="{{ route('admin.login.index', ['tipo' => 'Administrador']) }}" class="btn btn-outline-secondary w-100">
                              Login - Administrador
                            </a>
                        </div>
                      </div>
                  @endauth
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>
