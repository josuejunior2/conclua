@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitação de vinculação de {{ $solicitacao->Academico->nome }}</h3>
        @if($solicitacao->status == null)
        <div class="d-flex justify-content-between">
            <div class="me-2">
                <form method="POST" action="{{ route('solicitacao.orientador.rejeitar', ['solicitacao' => $solicitacao]) }}" >
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        Rejeitar
                    </button>
                </form>
            </div>
            <div>
                <form method="POST" action="{{ route('solicitacao.orientador.aceitar', ['solicitacao' => $solicitacao]) }}">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">
                        Aceitar
                    </button>
                </form>
            </div>
        </div>
        @endif
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
        @if ($solicitacao->AcademicoTCC)
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">TCC</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->problema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->objetivo_especifico }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->objetivo_geral }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->justificativa }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoTCC->metodologia }}</div>
        </div>

        @elseif ($solicitacao->AcademicoEstagio)
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">Estágio</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Função</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->funcao }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Nome da Empresa</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">CNPJ da Empresa</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->cnpj }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Supervisor</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->supervisor }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email da Empresa/Supervisor</div>
            <div class="datagrid-content">{{ $solicitacao->AcademicoEstagio->Empresa->email }}</div>
        </div>
        @endif
        @if ($solicitacao->Orientacao)
        <div class="datagrid-item">
            <div class="datagrid-title">Status</div>
            <div class="datagrid-content">@if ($solicitacao->status == 1)
                Aceito
                @endif
            </div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data de envio da solicitação</div>
            <div class="datagrid-content">{{ $solicitacao->created_at->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data de vinculação</div>
            <div class="datagrid-content">{{ $solicitacao->Orientacao->created_at->format('d/m/Y') }}</div>
        </div>
        @endif
    </div>
</div>
@endsection