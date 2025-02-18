@extends('layouts.orientador')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de modelos de documento</h3>
        </div>
        <div class="card-body">
            @foreach ($modelos as $modelo)
            <div class="card card-link row mb-2 ms-0">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">{{$modelo->nome}} <span class="card-subtitle">{{$modelo->getNomeModalidade()}}</span></h3>
                </div>
                <div class="card-body">
                    <p>{{$modelo->descricao}}</p>
                    <div class="row">
                        @foreach ($modelo->arquivos as $arquivo)
                            <div class="col-auto mb-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $arquivo->nome }}</h3>
                                        <div class="mt-4">
                                            <div class="row">
                                                <div class="col">
                                                    <form id="form" method="post" class="flex-2"
                                                        action="{{ route('download.arquivo') }}">
                                                        @csrf
                                                        <input id="caminho" name="caminho" type="hidden" class="form-control"
                                                            value="{{ $arquivo->caminho . '/' . $arquivo->nome }}">
                                                        <button type="submit" class="btn btn-outline-secondary w-100">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                                <path d="M7 11l5 5l5 -5" />
                                                                <path d="M12 4l0 12" />
                                                            </svg>
                                                            Baixar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>            
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

