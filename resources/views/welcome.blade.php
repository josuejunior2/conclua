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
            <h3 class="card-title">Instruções</h3>
            <div class="markdown">
                <p></p>
                @auth
                    <a href="{{ route('home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
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
