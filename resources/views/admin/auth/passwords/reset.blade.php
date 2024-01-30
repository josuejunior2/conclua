@extends('layouts.guest')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="/back/static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" method="POST" action="{{ route('admin.password.update') }}"  autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <input type="hidden" name="token" value="{{ $token }}">
                <h2 class="card-title text-center mb-4">{{ __('Reset Password') }}</h2>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
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
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group input-group-flat">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
