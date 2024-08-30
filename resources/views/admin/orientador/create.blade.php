@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Cadastro de orientador</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.orientador.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-4">
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Nome do orientador</div>
                    <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ old('nome', '') }}"/></div>
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
                    <div><input id="email" name="email"  type="text" class="form-control" value="{{ old('email', '') }}"/></div>
                    <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    </span>
                </div>
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">MASP</div>
                    <input id="masp" name="masp"  type="text" class="form-control" value="{{ old('masp', '') }}" />
                    <span class="{{ $errors->has('masp') ? 'text-danger' : '' }}">
                        {{ $errors->has('masp') ? $errors->first('masp') : '' }}
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
