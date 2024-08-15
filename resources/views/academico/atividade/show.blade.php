@extends('layouts.app')

@include('academico.atividade.modal.entrega')

@section('content')
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Atividade {{ $atividade->titulo }}</h3>
            <div class="d-flex justify-content-between col-auto">
                @if(empty($atividade->SubmissaoAtividade) && session('semestreIsAtivo'))
                    <div>
                        <a href="#" class="btn btn-primary w-100 mb-1" data-bs-toggle="modal" data-bs-target="#modal-entrega-atividade">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
                            Submeter atividade
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @include('atividade.partials.info')
    </div>
    @if(!empty($atividade->SubmissaoAtividade))
        @include('arquivo.add_arquivo_submissao')
        @include('academico.atividade.modal.destroy_submissao')
        <div class="card m-3">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Submissão {{ \Carbon\Carbon::parse($atividade->SubmissaoAtividade->created_at)->format('d/m/Y H:i') }}</h3>
                <div class="d-flex justify-content-between col-auto">
                    @if(session('semestreIsAtivo'))
                        @can('adicionar arquivo submissao')
                        <div>
                            <a href="#" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modal-add-arquivo-submissao">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                                Adicionar arquivo na submissão
                            </a>
                        </div>
                        @endcan
                    @endif
                    @if(session('semestreIsAtivo'))
                        @can('deletar submissao')
                        <div>
                            <form id="form_destroy_submissao{{$atividade->SubmissaoAtividade->id}}" method="post" action="{{ route('academico.atividade.destroy.submissao', ['submissao' => $atividade->SubmissaoAtividade]) }}">
                                @method('DELETE')
                                @csrf
                                <!-- <button type="submit">Excluir</button>  -->
                                <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modal-destroy-submissao">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    Excluir submissão
                                </a>
                            </form>
                        </div>
                        @endcan
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="col-12 markdown">

                    @include('arquivo.download_submissao')
                    
                    <h3>Descrição</h3>
                    <p>{{ $atividade->SubmissaoAtividade->descricao }}</p>
                </div>
            </div>
        </div>
    @endif

    @include('atividade.partials.comentario')

@endsection