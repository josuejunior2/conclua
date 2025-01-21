@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de orientações</h3>
            <div>
                <form id="form" method="post" action="{{ route('admin.orientacao.exportPdf') }}">
                    @csrf
                    <!-- <button type="submit">Excluir</button>  -->
                    <button type="submit" class="btn btn-primary w-100" >
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg>
                        Relatório de Orientações
                    </a>
                </form>
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-orientacoes"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              <th>Orientador</th>
              <th>Acadêmico</th>
              <th>Modalidade</th>
              <th>Tema</th>
              <th>Nota total</th>
              <th>Conceito</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orientacoes as $orientacao)
            <tr>
                <td>{{ $orientacao->OrientadorTrashed->AdminTrashed->nome }}</td>
                <td>{{ $orientacao->AcademicoTrashed->UserTrashed->nome }}</td>
                <td>{{ $orientacao->modalidade() }}</td>
                <td>{{ $orientacao->tema() }}</td>
                <td>{{ $orientacao->notaTotal() }}</td>
                <td>{{ $orientacao->avaliacao_final }}</td>
                <td class="text-end">
                    <a class="btn justify-content-center" href="{{ route('admin.academico.show', ['academico' => $orientacao->Academico]) }}">
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
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {
        $('#tabela-orientacoes').DataTable({
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

