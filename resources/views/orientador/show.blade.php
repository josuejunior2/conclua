@extends('layouts.orientador')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Meu cadastro</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href=" {{ route('orientador.edit', ['orientador' => $orientador ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $Orientador->Admin->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $orientador->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $Orientador->Admin->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Disponibilidade</div>
            <div class="datagrid-content">{{ $orientador->disponibilidade }}</div>
        </div>
        @if ($orientador)
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content">{{$orientador->enderecoLattes}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content">{{$orientador->enderecoOrcid}}</div>
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

@endsection
