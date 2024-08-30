@extends('layouts.guest')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="/back/static/logo.svg" height="36" alt=""></a>
    </div>
    <div class="card card-md">
        <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="h2 text-center mb-4">Entre na sua conta - Admin</h2>
        <form method="POST" action="{{ route('admin.login') }}">            {{-- é... depois o login tem que ser por masp/matricula--}}
            @csrf

            <div class="mb-3">
                <label class="form-label">Endereço Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">
                Senha
                @if (Route::has('password.request'))
                    <div class="form-label-description">
                        <a href="{{ route('password.request') }}">
                            Esqueceu a senha?
                        </a>
                    </div>
                @endif
                </label>
                <div class="input-group input-group-flat">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-login"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M21 12h-13l3 -3" /><path d="M11 15l-3 -3" /></svg>
                    Entrar
                </button>
            </div>
        </form>
    </div>
    <div class="text-center text-muted mt-3 mb-4">
        Ainda não tem uma conta?
        <a href="{{ route('welcome') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Siga as instruções.</a>
    </div>
    </div>
</div>
@endsection
