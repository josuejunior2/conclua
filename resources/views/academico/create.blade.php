@extends('layouts.guest')

@section('content')
    <div class="page">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    Complete seu cadastro
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
                        <ul class="steps steps-green steps-counter my-4">
                            <li class="step-item active">Informações gerais</li>
                            <li class="step-item">Especificações</li>
                            <li class="step-item">Confirmação</li>
                        </ul>

                        <form method="POST" action="{{ route('academico.store') }}" autocomplete="off" novalidate>
                            @csrf
                            <div class="row g-3 mb-4">
                               <div class="mb-3">
                                   <label class="form-label required">Atualize sua senha</label>
                                   <div>
                                     <input name="password" type="password" class="form-control" placeholder="Senha">
                                     <small class="form-hint">
                                        A senha deve ter no mínimo 8 caracteres, incluir letras maiúsculas e minúsculas, conter pelo menos um número, um símbolo (como !, @, #, $) e não deve ter sido comprometida em violações de dados conhecidas.
                                     </small>
                                   </div>
                                   <span class="{{ $errors->has('password') ? 'text-danger' : '' }}">
                                     {{ $errors->has('password') ? $errors->first('password') : '' }}
                                   </span>
                               </div>

                            <div class="mb-3">
                               <div class="form-label required">Qual será sua modalidade de orientação?</div>
                               <div>
                                 <label class="form-check form-check-inline">
                                   <input class="form-check-input" type="radio" name="modalidade" value="0" {{ old('modalidade') == "0" ? 'checked' : ''}}>
                                   <span class="form-check-label">Estágio</span>
                                 </label>
                                 <label class="form-check form-check-inline">
                                   <input class="form-check-input" type="radio" name="modalidade" value="1" {{ old('modalidade') == "1" ? 'checked' : ''}} disabled>
                                   <span class="form-check-label">Trabalho de Conclusão de Curso (em breve)</span>
                                 </label>
                               </div>
                               <span class="{{ $errors->has('modalidade') ? 'text-danger' : '' }}">
                                   {{ $errors->has('modalidade') ? $errors->first('modalidade') : '' }}
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

