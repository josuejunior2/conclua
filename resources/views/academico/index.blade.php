@extends('layouts.app');

@section('content')

<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de orientadores</h3>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-orientadores-web"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              <th>Nome</th>
              <th>Email</th>
              <th>Formação</th>
              <th>Área</th>
              <th>Disponibilidade</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orientadores as $o)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $o->id }}</span></td>
                <td>{{ $o->name }}</td>
                <td>{{ $o->email }}</td>
                <td>{{ $o->Formacao ? $o->Formacao->formacao : 'N/A' }}</td>
                <td>{{ $o->Area ? $o->Area->area : 'N/A' }}</td>
                <td>
                    @php
                        $especifico = $especificos->where('orientadorGeral_id', $o->id)->first();
                    @endphp

                    @if ($especifico)
                        {{ $especifico->disponibilidade }}
                    @else
                        N/A
                    @endif
                </td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('orientadorgeral.show.web', ['orientadorgeral' => $o]) }}">
                            Visualizar
                        </a>
                        </form>
                    </div>
                  </span>
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
        $('#tabela-orientadores-web').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
        });
    });
</script>
@endsection

