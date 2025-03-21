@extends('layouts.app')

@section('content')
    <div class="card m-3">
        <div class="row g-0">
            <div class="col d-flex flex-column">
                <div class="card-header">
                    <h3 class="card-title">Atualize seu cadastro</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('academico.update', ['academico' => $academico]) }}"
                        autocomplete="off" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row g-3 mb-4">
                            <div class="col-md">
                                <div class="mb-3">
                                    <div class="form-label required">Nome do acadêmico</div>
                                    <div><input id="nome" name="nome" type="text" class="form-control"
                                            value="{{ old('nome', $academico->User->nome) }}" disabled /></div>
                                    <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md">
                                <div class="mb-3">
                                    <div class="form-label required">Endereço email</div>
                                    <div><input id="email" name="email" type="text" class="form-control"
                                            value="{{ old('email', $academico->User->email) }}" /></div>
                                    <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <div class="form-label required">Matrícula</div>
                                    <input id="matricula" name="matricula" type="text" class="form-control"
                                        value="{{ old('matricula', $academico->matricula) }}" disabled />
                                    <span class="{{ $errors->has('matricula') ? 'text-danger' : '' }}">
                                        {{ $errors->has('matricula') ? $errors->first('matricula') : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="mb-3">
                                <label class="form-label required">Atualize sua senha</label>
                                <div>
                                    <input name="password" type="password" class="form-control" placeholder="Senha"
                                        value="{{ old('password', '') }}">
                                    <small class="form-hint">
                                        A senha deve ter no mínimo 8 caracteres, incluir letras maiúsculas e minúsculas,
                                        conter pelo menos um número, um símbolo (como !, @, #, $) e não deve ter sido
                                        comprometida em violações de dados conhecidas.
                                    </small>
                                </div>
                                <span class="{{ $errors->has('password') ? 'text-danger' : '' }}">
                                    {{ $errors->has('password') ? $errors->first('password') : '' }}
                                </span>
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
    </div>
@endsection
