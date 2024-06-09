@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Cadastro de permissão</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.permission.update', ['permission' => $permission]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-4">
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Nome da permissão</div>
                    <div><input id="name" name="name"  type="text" class="form-control" value="{{ old('name', $permission->name) }}" /></div>
                    <span class="{{ $errors->has('name') ? 'text-danger' : '' }}">
                        {{ $errors->has('name') ? $errors->first('name') : '' }}
                    </span>
                </div>
                <div class="mb-3">
                    <div class="form-label required">Descrição</div>
                    <input id="description" name="description"  type="text" class="form-control" value="{{ old('description', $permission->description) }}" />
                    <span class="{{ $errors->has('description') ? 'text-danger' : '' }}">
                        {{ $errors->has('description') ? $errors->first('description') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-label">Tipo de permissão</div>
            <div>
              <label class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="guard_name" id="guard_name" value="web" {{ old('guard_name') == "web" || $permission->guard_name == "web" ? 'checked' : ''}}>
                <span class="form-check-label">Usuário comum</span>
              </label>
              <label class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="guard_name" id="guard_name" value="admin" {{ old('guard_name') == "admin" || $permission->guard_name == "admin" ? 'checked' : ''}}>
                <span class="form-check-label">Administração</span>
              </label>
              <span class="{{ $errors->has('guard_name') ? 'text-danger' : '' }}">
                {{ $errors->has('guard_name') ? $errors->first('guard_name') : '' }}
              </span>
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
