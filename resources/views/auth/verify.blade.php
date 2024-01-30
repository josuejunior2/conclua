@extends('layouts.guest')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="/back/static/logo.svg" height="36" alt=""></a>
        </div>
        <div class="text-center">
        <div class="my-5">
            <h2 class="h1">Falta pouco agora! Só precisamos que você confirme seu email</h2>
            <p class="fs-h3 text-muted">
            Antes de utilizar os recursos da aplicação, por favor valide seu e-mail pelo link de verificação que mandamos no seu email.
            </p>
        </div>
        <div class="text-center text-muted mt-3">
            Caso você não tenha recebido o email de verificação, clique no link a seguir para receber um novo email.
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui</button>.
            </form>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    Reenviamos para você um email com o link de validação.
                </div>
            @endif
        </div>
        </div>
    </div>
</div>
@endsection
