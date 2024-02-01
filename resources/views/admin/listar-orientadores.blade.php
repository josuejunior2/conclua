@extends('layouts.admin')

@section('content')


<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de orientadores</h3>
            <div>
                <a href="#" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modal-cadastro">
                    Adicionar novos orientadores
                </a>
            </div>
        </div>
      {{-- <div class="card-body border-bottom py-3">
        <div class="d-flex">
          <div class="text-muted">
            Show
            <div class="mx-2 d-inline-block">
              <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
            </div>
            entries
          </div>
          <div class="ms-auto text-muted">
            Search:
            <div class="ms-2 d-inline-block">
              <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
            </div>
          </div>
        </div>
      </div> --}}
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-orientadores"> {{-- table card-table table-vcenter text-nowrap datatable --}}
          <thead>
            <tr>
              <th class="w-1"></th> {{-- <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              <th>Nome</th>
              <th>Email</th>
              <th>Formação</th>
              <th>Área</th>
              <th>Orientandos</th>
              <th>*</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orientadores as $o)
            <tr>
                <td></td> <!-- <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $o->id }}</span></td>
                <td>{{ $o->name }}</td>
                <td>{{ $o->email }}</td>
                <td>{{ $o->Formacao ? $o->Formacao->formacao : 'N/A' }}</td>
                <td>{{ $o->Area ? $o->Area->area : 'N/A' }}</td>
                <td>
                  *
                </td>
                <td>*</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('orientadorgeral.show', ['orientadorgeral' => $o]) }}">
                            Visualizar
                        </a>
                        <form id="form_{{$o->id}}" method="post" action="{{ route('orientadorgeral.destroy', ['orientadorgeral' => $o->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_{{$o->id}}').submit()" class="dropdown-item">
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

@include('admin.modal.cadastro-orientador')
