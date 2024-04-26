@extends('layouts.admin')

@section('content')


<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de orientadores</h3>
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="#" class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#modal-cadastro-orientador">
                    Adicionar novos orientadores
                </a>
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-orientadores"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th>Nome</th>
              <th>Email</th>
              <th>Formação</th>
              <th>Área</th>
              <th>Disponibilidade</th>
              <th>Orientandos</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orientadores as $orientador)
            <tr>
                <!--<td></td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td>{{ $orientador->nome }}</td>
                <td>{{ $orientador->email }}</td>
                <td>{{ $orientador->Formacao ? $o->Formacao->nome : 'N/A' }}</td>
                <td>{{ $orientador->Area ? $orientador->Area->nome : 'N/A' }}</td>
                <td>{{-- @if($o->disponibilidade == 0)N/A @elseif(isset($semestreAtivo)) {{ $o->disponibilidade - $o->orientacoes->where('semestre_id', $semestreAtivo->id)->count() }} de {{ $o->disponibilidade }} @endif--}}</td>
                <td>
                    @if (isset($orientacoesSemestre) && $orientacoesSemestre->contains($orientador))
                        @foreach ($orientacoesSemestre->where('orientador_id', $orientador->id) as $orientacao)
                            {{ $orientacao->Academico->nome }} - @if ($orientacao->Academico->AcademicoTCC) TCC @elseif ($orientacao->Academico->AcademicoEstagio) Estagio @endif
                        @endforeach
                    @endif
                </td>
                <td class="text-end">
                    <a class="btn justify-content-center" href="{{ route('orientador.show.admin', ['orientador' => $orientador]) }}">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        Visualizar
                    </a>
                  {{-- <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('orientador.show.admin', ['orientador' => $orientador]) }}">
                            Visualizar
                        </a>
                        <form id="form_{{$orientador->id}}" method="post" action="{{ route('admin.orientador.destroy', ['orientador' => $orientador->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_{{$orientador->id}}').submit()" class="dropdown-item">
                                Excluir cadastro
                            </a>
                        </form>
                    </div>
                  </span> --}}
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
        $('#tabela-orientadores').DataTable({
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

@include('admin.modal.cadastro-orientador')
