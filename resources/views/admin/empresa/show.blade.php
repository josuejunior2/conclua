@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Cadastro do Perfil</h3>
        <div class="d-flex justify-content-between col-auto">
            @can('editar empresa')
                <a href=" {{ route('admin.empresa.edit', ['empresa' => $empresa ]) }}" class="btn me-2 btn-secondary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                    Editar
                </a>
            @endcan
            @if($empresa->academicosEstagio->count() == 0)
                @can('excluir empresa')
                    <form id="form_{{$empresa->id}}" method="post" action="{{ route('admin.empresa.destroy', ['empresa' => $empresa]) }}">
                        @method('DELETE')
                        @csrf
                        <!-- <button type="submit">Excluir</button>  -->
                        <a href="#" onclick="document.getElementById('form_{{$empresa->id}}').submit()" class="btn btn-danger w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            Excluir
                        </a>
                    </form>
                @endcan
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="datagrid">
            <div class="datagrid-item">
                <div class="datagrid-title">Nome da Empresa</div>
                <div class="datagrid-content">{{ $empresa->nome }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">CNPJ da Empresa</div>
                <div class="datagrid-content">{{ $empresa->cnpj }}</div>
            </div>
            <div class="datagrid-item">
                <div class="datagrid-title">Email da empresa</div>
                <div class="datagrid-content">{{ $empresa->email }}</div>
            </div>
        </div>
    </div>
</div>
<div class="card m-3">    
    <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-empresas"> {{-- table card-table table-vcenter text-nowrap datatable --}}
            <thead>
                <tr>
                    <th>Acadêmico</th>
                    <th>Orientador</th>
                    <th>Setor</th>
                    <th>Supervisor</th>
                    <th>Email do supervisor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($empresa->academicosEstagio as $estagio)
            <tr>
                <td>{{ $estagio->Academico->User->nome }}</td>
                <td>{{ $estagio->Orientacao ? $estagio->Orientacao->Orientador->Admin->nome : 'N/A' }}</td>
                <td>{{ $estagio->setor_atuacao }}</td>
                <td>{{ $estagio->supervisor }}</td>
                <td>{{ $estagio->email_supervisor }}</td>
                <td class="text-end">
                    <a class="btn justify-content-center" href="{{ route('admin.academico.show', ['academico' => $estagio->Academico]) }}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        Visualizar
                    </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {
        $('#tabela-empresas').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '//cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
            },
        });
    });
</script>
@endsection
