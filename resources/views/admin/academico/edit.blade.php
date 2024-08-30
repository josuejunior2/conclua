@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Editar acadêmico</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.academico.update', ['academico' => $academico]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
        <div class="row g-3 mb-4">
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Nome do acadêmico</div>
                    <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ old('nome', $academico->User->nome) }}"/></div>
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
                    <div><input id="email" name="email"  type="text" class="form-control" value="{{ old('email', $academico->User->email) }}"/></div>
                    <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    </span>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Matrícula</div>
                    <input id="matricula" name="matricula"  type="text" class="form-control" value="{{ old('matricula', $academico->matricula) }}" />
                    <span class="{{ $errors->has('matricula') ? 'text-danger' : '' }}">
                        {{ $errors->has('matricula') ? $errors->first('matricula') : '' }}
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
