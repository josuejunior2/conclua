@extends('layouts.guest')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo.svg" height="36" alt=""></a>
    </div>
    <form class="card card-md" method="POST" action="{{ route('register') }}" autocomplete="off" novalidate>
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input id="name" type="text" class="form-control @error('nome') is-invalid @enderror" name="name" value="{{ old('nome') }}" autofocus>
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group input-group-flat">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Confirme a senha') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Create new account</button>
        </div>
        </div>
    </form>
    <div class="text-center text-muted mt-3">
        Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
    </div>
    </div>
</div>
@endsection
