@extends('layouts.admin')

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de acadêmicos</h3>
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
            <div>
                <a href="#" class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#modal-cadastro-academico">
                    Adicionar novos acadêmicos
                </a>
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-academicos"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th>Nome</th>
              <th>Email</th>
              <th>Modalidade</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($academicos as $a)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td>{{ $a->nome }}</td>
                <td>{{ $a->email }}</td>
                <td>
                    @if ($a->AcademicoTCC)
                    TCC
                    @elseif ($a->AcademicoEstagio)
                    Estágio
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    @if (!is_null($academicosAtivos) && $academicosAtivos->contains($a))
                        Cadastro ativo
                    @else
                        Cadastro inativo
                    @endif
                </td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('academico.show', ['academico' => $a]) }}">
                            Visualizar
                        </a>
                        @if($a->status == 0)
                            <form id="form_ativar_{{ $a->id }}" method="post" action="{{ route('admin.academico.ativar', ['academico' => $a]) }}">
                                @csrf
                                <!-- <button type="submit">Excluir</button>  -->
                                <a href="#" onclick="document.getElementById('form_ativar_{{ $a->id }}').submit()" class="dropdown-item">
                                    Ativar cadastro
                                </a>
                            </form>
                        @elseif ($a->status == 1)
                            <form id="form_desativar_{{ $a->id }}" method="post" action="{{ route('admin.academico.desativar', ['academico' => $a]) }}">
                                @csrf
                                <!-- <button type="submit">Excluir</button>  -->
                                <a href="#" onclick="document.getElementById('form_desativar_{{$a->id}}').submit()" class="dropdown-item">
                                    Desativar cadastro
                                </a>
                            </form>
                        @endif
                        <form id="form_destroy_{{$a->id}}" method="post" action="{{ route('admin.academico.destroy', ['academico' => $a->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_destroy_{{$a->id}}').submit()" class="dropdown-item">
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
