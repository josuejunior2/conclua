@extends('layouts.admin')

@section('content')
    @include('admin.modal.cadastro_orientador_planilha')

    <div class="col-12">
        <div class="card m-3">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Lista de orientadores</h3>
                @can('CRUD usuarios')
                    <div class="d-flex justify-content-between col-auto">
                        <div class=" me-2">
                            <a href="#" class="btn btn-success w-100 mb-1" data-bs-toggle="modal"
                                data-bs-target="#modal-cadastro-orientador-planilha">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-table-import">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 21h-7a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8" />
                                    <path d="M3 10h18" />
                                    <path d="M10 3v18" />
                                    <path d="M19 22v-6" />
                                    <path d="M22 19l-3 -3l-3 3" />
                                </svg>
                                Adicionar orientadores via planilha
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('admin.orientador.create') }}" class="btn btn-primary w-100 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                </svg>
                                Adicionar orientador
                            </a>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="table-responsive m-4">
                <table class="display w-100" id="tabela-orientadores">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Disponibilidade</th>
                            <th>Orientandos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orientadores as $orientador)
                        @include('admin.orientador.modal.destroy')
                            <tr>
                                <td>{{ $orientador->AdminTrashed->nome }}</td>
                                <td>{{ $orientador->AdminTrashed->email }}</td>
                                <td>{{-- @if ($o->disponibilidade == 0)N/A @elseif(isset(session('semestre_id'))) {{ $o->disponibilidade - $o->orientacoes->where('semestre_id', session('semestre_id')->id)->count() }} de {{ $o->disponibilidade }} @endif --}}</td>
                                <td>
                                    @if (isset($orientacoesSemestre) && $orientacoesSemestre->where('orientador_id', $orientador->id)->exists())
                                        @foreach ($orientacoesSemestre->where('orientador_id', $orientador->id) as $orientacao)
                                            {{ $orientacao->AcademicoTrashed->UserTrashed->nome }} - @if ($orientacao->AcademicoTrashed->academicosTCC->where('semestre_id', session('semestre_id'))->first())
                                                TCC
                                            @elseif ($orientacao->AcademicoTrashed->academicosEstagio->where('semestre_id', session('semestre_id'))->first())
                                                Estagio
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if(!$orientador->trashed())
                                        @can('visualizar orientador')
                                            <a class="btn justify-content-center"
                                                href="{{ route('admin.orientador.show', ['orientador' => $orientador]) }}">
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
                                    @else
                                    <div>
                                        <form id="form_destroy_{{$orientador->id}}" method="post" action="{{ route('admin.orientador.destroy', ['orientador' => $orientador]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <!-- <button type="submit">Excluir</button>  -->
                                            <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#modal-destroy-orientador-{{$orientador->id}}" class="btn btn-outline-danger" @can('excluir orientador') @else disabled @endcan>
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
                                                Desbloquear
                                            </a>
                                        </form>
                                    </div>
                                    @endif
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
        $(document).ready(function() {
            $('#tabela-orientadores').DataTable({
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
