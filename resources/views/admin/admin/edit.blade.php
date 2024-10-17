@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
        <h3 class="card-title">Alterar Admin</h3>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('admin.admin.update', ['admin' => $admin]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-4">
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Nome</div>
                    <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ old('nome', $admin->nome) }}"/></div>
                    <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </span>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Endereço email</div>
                    <div><input id="email" name="email"  type="text" class="form-control" value="{{ old('email', $admin->email) }}"/></div>
                    <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Senha</div>
                    <input id="password" name="password"  type="password" class="form-control" />
                    <small class="form-hint">
                        A senha deve ter no mínimo 8 caracteres, incluir letras maiúsculas e minúsculas, conter pelo menos um número, um símbolo (como !, @, #, $) e não deve ter sido comprometida em violações de dados conhecidas.
                    </small>
                    <span class="{{ $errors->has('password') ? 'text-danger' : '' }}">
                        {{ $errors->has('password') ? $errors->first('password') : '' }}
                    </span>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Perfil</div>
                    <select class="form-select" name="perfil" id="perfil">
                        <option value=""> -- Selecione o perfil -- </option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('perfil') || $admin->getRoleNames()->first() == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="{{ $errors->has('perfil') ? 'text-danger' : '' }}">
                        {{ $errors->has('perfil') ? $errors->first('perfil') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Enviar
                </button>
            </div>
        </div>
    </form>
  </div>
</div>
</div>
@endsection
