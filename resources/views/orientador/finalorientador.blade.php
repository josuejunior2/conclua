@extends('layouts.app')

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
                        <li class="step-item">Informações gerais</li>
                        <li class="step-item">Especificações</li>
                        <li class="step-item active">Confirmação</li>
                    </ul>
                    <h2 class="mb-4">Parabéns! Você acaba de completar seu cadastro no CONCLUA!</h2>
                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
                        <a href="{{ route('orientadorgeral.index') }}" class="btn btn-teal w-100" >
                            Ir para a página inicial
                        </a>
                    </div>

                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
