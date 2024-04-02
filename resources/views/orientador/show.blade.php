@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Professor</h3>
        <div class="d-flex justify-content-between col-auto">
            {{-- <a href=" {{ route('orientador.edit', ['Orientador' => $Orientador->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a> --}} {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
            @can('CRUD usuarios')
            <form id="form_{{$Orientador->id}}" method="post" action="{{ route('orientador.destroy', ['Orientador' => $Orientador->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$Orientador->id}}').submit()" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    Excluir cadastro
                </a>
            </form>
            @endcan
            @if($academico->solicitacao)
            @can('solicitar orientacao')
            <form method="POST" action="{{ route('solicitacao.create', ['orientador' => $Orientador, 'academico' => $academico]) }}">
                @csrf
                <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
                <input id="Orientador_id" name="Orientador_id" type="hidden" class="form-control" value="{{ $Orientador->id }}">
                <button type="submit" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circles-relation" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.183 6.117a6 6 0 1 0 4.511 3.986" /><path d="M14.813 17.883a6 6 0 1 0 -4.496 -3.954" /></svg>
                    Solicitar vinculação
                </button>
            </form>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $Orientador->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $Orientador->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $Orientador->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        @if ($Orientador)
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content">{{$Orientador->enderecoLattes}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content">{{$Orientador->enderecoOrcid}}</div>
        </div>
        @if ($orientador->subArea1)
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 1</div>
            <div class="datagrid-content">{{ $orientador->subArea1 }}</div>
        </div>
        @endif
        @if ($orientador->subArea2)
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 2</div>
            <div class="datagrid-content">{{ $orientador->subArea2 }}</div>
        </div>
        @endif
        @if ($orientador->subArea3)
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 3</div>
            <div class="datagrid-content">{{ $orientador->subArea3 }}</div>
        </div>
        @endif
        @if ($orientador->areaPesquisa1)
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 1</div>
            <div class="datagrid-content">{{ $orientador->areaPesquisa1 }}</div>
        </div>
        @endif
        @if ($orientador->areaPesquisa2)
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 2</div>
            <div class="datagrid-content">{{ $orientador->areaPesquisa2 }}</div>
        </div>
        @endif
        @if ($orientador->areaPesquisa3)
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 3</div>
            <div class="datagrid-content">{{ $orientador->areaPesquisa3 }}</div>
        </div>
        @endif
        @if ($orientador->areaPesquisa4)
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 4</div>
            <div class="datagrid-content">{{ $orientador->areaPesquisa4 }}</div>
        </div>
        @endif
        @if ($orientador->areaPesquisa5)
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 5</div>
            <div class="datagrid-content">{{ $orientador->areaPesquisa5 }}</div>
        </div>
        @endif
        @else
        <div class="datagrid-item">
            <div class="datagrid-title"></div>
            <div class="datagrid-content">Dados específicos indisponíveis.</div>
        </div>
        @endif
    </div>
    </div>
</div>
@foreach ($orientador->orientacoes as $orientacao)

aluno orientado <br>
{{ $orientacao->Academico->nome }}
@endif

@endforeach
@endsection
