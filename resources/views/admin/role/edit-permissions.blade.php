@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Editar permissões de {{ $role->name }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.role.update-permissions', ['role' => $role]) }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 col-xl-12">
                <div class="mb-3">
                    <div class="form-selectgroup">
                        @foreach ($permissions->where('guard_name', $role->guard_name) as $permission)
                            <label class="form-selectgroup-item">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->uuid }}" class="form-selectgroup-input" {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                <span class="form-selectgroup-label">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <span class="{{ $errors->has('permissions') ? 'text-danger' : '' }}">
                        {{ $errors->has('permissions') ? $errors->first('permissions') : '' }}
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
@endsection
