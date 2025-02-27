@extends(auth()->guard('admin')->user()->hasRole('Orientador') ? 'layouts.orientador' : 'layouts.admin')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de atividades</h3>
            
            @can('criar atividade')
                <div>
                    <a href="{{ route('orientador.atividade.create') }}" class="btn btn-success w-100 mb-1">
                        Adicionar nova atividade
                    </a>
                </div>
            @endcan
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-atividades"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th>Orientador</th>
              <th>Acadêmico</th>
              <th>Título</th>
              <th>Criada em</th>
              <th>Atualizado em</th>
              <th>Data-limite</th>
              <th>Entregue em</th>
              <th>Nota</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($atividades as $atividade)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td>{{ $atividade->Orientacao->OrientadorTrashed->AdminTrashed->nome }}</td>
                <td>{{ $atividade->Orientacao->AcademicoTrashed->UserTrashed->nome }} - {{ $atividade->Orientacao->modalidade() }}</td>
                <td>{{ $atividade->titulo }}</td>
                <td>{{ \Carbon\Carbon::parse($atividade->created_at)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($atividade->updated_at)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($atividade->data_limite)->format('d/m/Y H:i') }}</td>
                <td>{{ $atividade->data_entrega ? \Carbon\Carbon::parse($atividade->data_entrega)->format('d/m/Y G:h') : '' }}</td>
                <td>{{ $atividade->nota ?? '' }}</td>
                <td class="d-flex align-items-center justify-content-center text-end">
                    @can('visualizar atividade')
                        <a class="btn justify-content-center"
                            href="{{ route('orientador.atividade.show', ['atividade' => $atividade]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                            Visualizar
                        </a>
                    @endcan
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
        $('#tabela-atividades').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '/pt-br-datatables.json',
            },
        });
    });
</script>
@endsection

