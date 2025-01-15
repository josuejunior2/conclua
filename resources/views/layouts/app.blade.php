
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
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('academico.show', ['user' => auth()->guard('web')->user()]) }}" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" /><path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" /></svg>
                      </span>
                      <span class="nav-link-title">
                          Meus dados
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
