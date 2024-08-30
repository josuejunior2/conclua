@extends('layouts.guest')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
        <form class="card card-md" action="{{ route('admin.password.email') }}" method="post" autocomplete="off" novalidate>
            @csrf
            @method("POST")
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <h2 class="card-title text-center mb-4">Esqueci a senha</h2>
                <p class="text-muted mb-4">Insira seu email e um link de recuperação de senha será enviado.</p>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Endereço email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-footer">
                    <a href="#" class="btn btn-primary w-100">
                    <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                    Enviar
                    </a>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            <a href="{{ route('admin.login') }}">Voltar para a tela de login</a>
        </div>
        </div>
    </div>    
@endsection
