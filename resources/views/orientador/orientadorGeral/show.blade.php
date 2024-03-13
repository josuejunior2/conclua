@extends($layouts)

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Professor</h3>
        <div class="d-flex justify-content-between col-auto">
            {{-- <a href=" {{ route('orientadorgeral.edit', ['orientadorgeral' => $orientadorgeral->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a> --}} {{-- Desisti de colocar Editar pq acho improvável que o admin queira fazê-lo --}}
            @can('CRUD usuarios')
            <form id="form_{{$orientadorgeral->id}}" method="post" action="{{ route('orientadorgeral.destroy', ['orientadorgeral' => $orientadorgeral->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$orientadorgeral->id}}').submit()" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    Excluir cadastro
                </a>
            </form>
            @endcan
            {{-- limitar-se a uma orientacao só depois--}}
            @if($academico->solicitacao)
            @can('solicitar orientacao')
            <form method="POST" action="{{ route('solicitacao.create', ['orientador' => $orientadorgeral, 'academico' => $academico]) }}">
                @csrf
                <input id="academico_id" name="academico_id" type="hidden" class="form-control" value="{{ $academico->id }}">
                <input id="orientadorGeral_id" name="orientadorGeral_id" type="hidden" class="form-control" value="{{ $orientadorgeral->id }}">
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
            <div class="datagrid-content">{{ $orientadorgeral->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $orientadorgeral->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $orientadorgeral->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Telefone</div>
            <div class="datagrid-content">colocar depois</div>
        </div>
        @if ($orientadorgeral->Especifico)
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->enderecoLattes}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->enderecoOrcid}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 1</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->subArea1}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 2</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->subArea2}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 3</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->subArea3}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 1</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->areaPesquisa1}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 2</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->areaPesquisa2}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 3</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->areaPesquisa3}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 4</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->areaPesquisa4}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 5</div>
            <div class="datagrid-content">{{$orientadorgeral->Especifico->areaPesquisa5}}</div>
        </div>
        @else
        <div class="datagrid-item">
            <div class="datagrid-title"></div>
            <div class="datagrid-content">Dados específicos indisponíveis.</div>
        </div>
        @endif
    </div>
    </div>
</div>
@foreach ($orientadorgeral->solicitacoes as $ogs)
@if ($ogs->academico_id == $academico->id)

<div class="card m-3">
<div class="card-body">
    <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Data de envio da solicitação</div>
            <div class="datagrid-content">{{ $solicitacao->created_at->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Mensagem enviada</div>
            <div class="datagrid-content">{{ $solicitacao->mensagem }}</div>
        </div>
    </div>
</div>

@endif

@endforeach
@endsection
