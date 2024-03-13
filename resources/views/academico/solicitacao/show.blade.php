@extends($layouts)


@if (auth()->guard('admin')->check())
@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitação de vinculação de {{ $solicitacao->Academico->nome }}</h3>
        <div class="d-flex justify-content-between col-auto">
            <form method="POST" action="{{ route('solicitacao.rejeitar', ['solicitacao' => $solicitacao]) }}" >
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    Rejeitar
                </button>
            </form>

            <form method="POST" action="{{ route('solicitacao.aceitar', ['solicitacao' => $solicitacao]) }}">
                @csrf
                <button type="submit" class="btn btn-success w-100">
                    Aceitar
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data de envio da solicitação</div>
            <div class="datagrid-content">{{ $solicitacao->created_at->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Mensagem do Acadêmico</div>
            <div class="datagrid-content">{{ $solicitacao->mensagem }}</div>
        </div>
        @if ($solicitacao->Academico->AcademicoTCC)
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">TCC</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoTCC->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoTCC->resumo }}</div>
        </div>

        @elseif ($solicitacao->Academico->AcademicoEstagio)
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">Estágio</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoEstagio->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Função</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoEstagio->funcao }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Nome da Empresa</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoEstagio->Empresa->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">CNPJ da Empresa</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoEstagio->Empresa->cnpj }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Supervisor</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoEstagio->Empresa->supervisor }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email da Empresa/Supervisor</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->AcademicoEstagio->Empresa->email }}</div>
        </div>
        @endif
    </div>
</div>
@endsection

@elseif (auth()->guard('web')->check())
@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitação de vinculação ao(à) {{ $solicitacao->OrientadorGeral->nome }}</h3>
        <div class="d-flex justify-content-between col-auto">
        <a href=" {{ route('solicitacao.edit', ['solicitacao' => $solicitacao ]) }}" class="btn me-2 btn-secondary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
            Editar
        </a>
        <form id="form_{{$solicitacao->id}}" method="post" action="{{ route('solicitacao.destroy', ['solicitacao' => $solicitacao]) }}">
            @method('DELETE')
            @csrf
            <a href="#" onclick="document.getElementById('form_{{$solicitacao->id}}').submit()" class="btn btn-danger w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                Excluir solicitacao
            </a>
        </form>
    </div>
    </div>
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
    <div class="card-body">
        <div class="datagrid">
        <div class="datagrid-item">
            <div class="datagrid-title">Nome</div>
            <div class="datagrid-content">{{ $solicitacao->OrientadorGeral->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">MASP</div>
            <div class="datagrid-content">{{ $solicitacao->OrientadorGeral->masp }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $solicitacao->OrientadorGeral->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Formação</div>
            <div class="datagrid-content">{{ $solicitacao->OrientadorGeral->Formacao->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de atuação</div>
            <div class="datagrid-content">{{ $solicitacao->OrientadorGeral->Area->nome }}</div>
        </div>
        @if ($solicitacao->OrientadorGeral->Especifico)
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Lattes</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->enderecoLattes}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Currículo Orcid</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->enderecoOrcid}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 1</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->subArea1}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 2</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->subArea2}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Sub-área 3</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->subArea3}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 1</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->areaPesquisa1}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 2</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->areaPesquisa2}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 3</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->areaPesquisa3}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 4</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->areaPesquisa4}}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Área de Pesquisa 5</div>
            <div class="datagrid-content">{{$solicitacao->OrientadorGeral->Especifico->areaPesquisa5}}</div>
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
@endsection

@endif
