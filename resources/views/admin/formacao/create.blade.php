@extends('layouts.admin')

@section('content')
    <div class="card m-3">
        <div class="card-header">
            <h3 class="card-title">Cadastrar formação do Orientador</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.formacao.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="mb-3">
                            <label class="form-label required" for="nome">Nome da formação</label>
                            <input id="nome" name="nome" type="text" class="form-control" value="{{ old('nome', '') }}" />
                            <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                                {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
