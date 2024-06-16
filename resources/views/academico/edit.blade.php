@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    Atualize seu cadastro
                    </h2>
                </div>
                </div>
            </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
            <div class="container-xl">
                <div class="card">
                <div class="row g-0">
                    <div class="col d-flex flex-column">
                    <div class="card-body">
                        <form method="POST" action="{{ route('academico.update', ['academico' => $academico]) }}" autocomplete="off" novalidate>
                            @csrf
                            @method('PUT    ')
                            <div class="row g-3 mb-4">
                               <div class="mb-3">
                                   <label class="form-label required">Atualize sua senha</label>
                                   <div>
                                     <input name="password" type="password" class="form-control" placeholder="Password" value="{{ old('password', '') }}">
                                     <small class="form-hint">
                                       A senha deve ter no mínimo 8 caracteres, deve conter pelo menos uma letra maiúscula e minúscula, número e símbolo. (colocar regra no Request depois)
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
            </div>
            </div>
        </div>
    </div>
@endsection

