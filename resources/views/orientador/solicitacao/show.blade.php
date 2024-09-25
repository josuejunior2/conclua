@extends('layouts.orientador')

@section('content')
<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Solicitação de vinculação de {{ $solicitacao->Academico->User->nome }}</h3>
        @if($solicitacao->status == null)
        <div class="d-flex justify-content-between">
            <div class="me-2">
                <form method="POST" action="{{ route('orientador.solicitacao.rejeitar', ['solicitacao' => $solicitacao]) }}" >
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        Rejeitar
                    </button>
                </form>
            </div>
            <div>
                <form method="POST" action="{{ route('orientador.solicitacao.aceitar', ['solicitacao' => $solicitacao]) }}">
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
            <div class="datagrid-title">Email</div>
            <div class="datagrid-content">{{ $solicitacao->Academico->User->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Data de envio da solicitação</div>
            <div class="datagrid-content">{{ $solicitacao->created_at->format('d/m/Y') }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Mensagem do Acadêmico</div>
            <div class="datagrid-content">{{ $solicitacao->mensagem }}</div>
        </div>
        @if (isset($tcc))
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">TCC</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $tcc->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $tcc->problema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $tcc->objetivo_especifico }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $tcc->objetivo_geral }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $tcc->justificativa }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Resumo</div>
            <div class="datagrid-content">{{ $tcc->metodologia }}</div>
        </div>

        @elseif (isset($estagio))
        <div class="datagrid-item">
            <div class="datagrid-title">Modalidade</div>
            <div class="datagrid-content">Estágio</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Tema</div>
            <div class="datagrid-content">{{ $estagio->tema }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Setor de atuação</div>
            <div class="datagrid-content">{{ $estagio->setor_atuacao }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Nome da Empresa</div>
            <div class="datagrid-content">{{ $estagio->Empresa->nome }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">CNPJ da Empresa</div>
            <div class="datagrid-content">{{ $estagio->Empresa->cnpj }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email da empresa</div>
            <div class="datagrid-content">{{ $estagio->Empresa->email }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Supervisor</div>
            <div class="datagrid-content">{{ $estagio->supervisor }}</div>
        </div>
        <div class="datagrid-item">
            <div class="datagrid-title">Email do supervisor</div>
            <div class="datagrid-content">{{ $estagio->email_supervisor }}</div>
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
