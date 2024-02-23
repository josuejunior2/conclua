@extends('layouts.admin')

@section('content')


<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de acadêmicos</h3>
            <div>
                <a href="#" class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#modal-cadastro-academico">
                    Adicionar novos acadêmicos
                </a>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-academicos"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              <th>Nome</th>
              <th>Email</th>
              <th>Modalidade</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($academicos as $a)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $a->id }}</span></td>
                <td>{{ $a->name }}</td>
                <td>{{ $a->email }}</td>
                <td>
                    @if ($tcc->where('academico_id', $a->id)->isNotEmpty())
                        TCC
                    @elseif ($estagio->where('academico_id', $a->id)->isNotEmpty())
                        Estágio
                    @else
                        N/A
                    @endif
                </td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('academico.show', ['academico' => $a]) }}">
                            Visualizar
                        </a>
                        <form id="form_{{$a->id}}" method="post" action="{{ route('academico.destroy', ['academico' => $a->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_{{$a->id}}').submit()" class="dropdown-item">
                                Excluir cadastro
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
        $('#tabela-academicos').DataTable({
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

@include('admin.modal.cadastro-academico')
