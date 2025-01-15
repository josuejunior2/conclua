
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
    <title>CONCLUA</title>
    <!-- CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <!-- DataTable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />

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
  <body  class=" layout-fluid">
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Sidebar -->
      <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                @if (isset($semestres))
                <div class="mb-3">
                    <form id="form_mudar_semestre" method="post" action="{{ route('semestre.mudar-semestre') }}">
                        @csrf
                        <!-- <button type="submit">Excluir</button>  -->
                        <select class="form-select" name="semestre_id" id="semestre_id">
                            @foreach ($semestres as $semestre)
                                <option value="{{ $semestre->id }}" {{ $semestre->id == session('semestre_id') ? 'selected' : '' }}>
                                    0{{ $semestre->periodo }}/{{ $semestre->ano }}
                                </option>
                            @endforeach
                        </select>
                    </form>
					<div class="row">
						<div class="col d-flex justify-content-center inicio"></div>
						<div class="col d-flex justify-content-center fim"></div>
					</div>
                </div>
                @endif
                <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                    Home
                    </span>
                </a>
                </li>
                @can('configurar semestre')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.semestre.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-month"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Semestres
                        </span>
                    </a>
                </li>
                @endcan
                @can('configurar perfil')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.role.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-scan"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /><path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Perfis
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.permission.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-license"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" /><path d="M9 7l4 0" /><path d="M9 11l4 0" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Permissões
                        </span>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orientador.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Orientadores
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.area.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-input-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11v-2a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v5a2 2 0 0 0 2 2h5" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Áreas
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.formacao.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-certificate"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5" /><path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Formações
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.academico.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Acadêmicos
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orientacao.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-safari"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 16l2 -6l6 -2l-2 6l-6 2" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Orientações
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.atividade.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Atividades
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.empresa.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-factory-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21h18" /><path d="M5 21v-12l5 4v-4l5 4h4" /><path d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582" /><path d="M9 17h1" /><path d="M14 17h1" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Empresas
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admin.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-pentagon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13.163 2.168l8.021 5.828c.694 .504 .984 1.397 .719 2.212l-3.064 9.43a1.978 1.978 0 0 1 -1.881 1.367h-9.916a1.978 1.978 0 0 1 -1.881 -1.367l-3.064 -9.43a1.978 1.978 0 0 1 .719 -2.212l8.021 -5.828a1.978 1.978 0 0 1 2.326 0z" /><path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" /><path d="M6 20.703v-.703a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.707" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Admins
                        </span>
                    </a>
                </li>
              <div class="position-absolute bottom-0 right-0">
                <li class="nav-item">
                @if(auth()->guard('admin')->check())
                    <form method="POST" action="{{ route('admin.logout') }}">
                @else
                    <form method="POST" action="{{ route('logout') }}">
                @endif
                    @csrf
                    <button class="nav-link" type="submit" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" /><path d="M15 12h-12l3 -3" /><path d="M6 15l-3 -3" /></svg>
                    </span>
                    <span class="nav-link-title">
                        Logout
                    </span>
                    </button>
                </form>
                </li>
                </div>
            </ul>
          </div>
        </div>
      </aside>
      <div class="page-wrapper">
		{{-- @include('layouts.modal.error') --}}
        @yield('content')
      </div>
    <!-- Data Table core -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script> --}}


    <!-- Libs JS EU COMENTEI PQ EU PRECISEI colocar o CDN do jquery ali em cima -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@2.0.5/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@2.0.5/dist/maps/world.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@2.0.5/dist/maps/world-merc.js?1684106062" defer></script> --}}

    <!-- Tabler Core -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core/dist/js/demo.min.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js" defer></script>

    @yield('js')

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,                   
                position: 'top-end',           
                icon: 'success',                
                title: '{{ session('success') }}',
                showConfirmButton: false,     
                timer: 7000,                 
                timerProgressBar: true,      
            });
        </script>    
    @endif
	@if (session('errors'))
		<script>
			Swal.fire({
				toast: true,
				position: 'top-end',
				icon: 'error',
				title: `{!! implode('<br>', $errors->all()) !!}`,
				showConfirmButton: false,
				timer: 7000,
				timerProgressBar: true,
			});
		</script>
	@endif

    <script>
		$(document).ready( function () {
			let semestres = {!! $semestres !!};

			$('#semestre_id').change(function() {
				$('#form_mudar_semestre').submit();
			});
	
			semestres.forEach(function( index ) {
				if(index.id == $('#semestre_id').val()){
					let data_inicio = new Date(index.data_inicio);
					let data_fim = new Date(index.data_fim);
					$('.inicio').html(`Início: ${data_inicio.getDate().toString().padStart(2, '0')}/${(data_inicio.getMonth() + 1).toString().padStart(2, '0')}`);
					$('.fim').html(`Fim: ${data_fim.getDate().toString().padStart(2, '0')}/${(data_fim.getMonth() + 1).toString().padStart(2, '0')}`);
				}
			});
		});
    </script>
  </body>
</html>
