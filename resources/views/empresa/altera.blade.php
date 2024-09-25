@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Alterar empresa</h3>
        </div>
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <div class="table-responsive m-4 mt-3">
                    <table class="display w-100" id="tabela-empresas"> {{-- table card-table table-vcenter text-nowrap datatable --}}
                      <thead>
                        <tr>
                          <th></th>
                          <th>Empresa</th>
                          <th>CNPJ</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($empresas as $e)
                            <tr>
                                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Selecione a empresa" id="empresa_{{$e->id}}" data-cnpj="{{$e->cnpj}}" data-empresa="{{$e}}" @if($empresa->id == $e->id) checked @endif onclick="preencheEmpresa($(this))"></td>
                                <td>{{ $e->nome }}</td>
                                <td>{{ $e->cnpj }}</td>
                                <td>{{ $e->email }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <form method="POST" action="{{ route('empresa.alteraEmpresa.post', ['empresa' => $empresa, 'estagio' => $estagio]) }}" autocomplete="off" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Nome da empresa</div>
                                <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ old('nome', $empresa->nome) }}" @if(!$errors->has('nome')) readonly @endif /></div>
                                <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                                </span>
                            </div>                    
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Cadastro Nacional de Pessoa Jurídica (CNPJ)</div>
                                <input id="cnpj" name="cnpj" type="text" class="form-control" value="{{ old('cnpj', $empresa->cnpj) }}" data-mask="00.000.000/0000-00" data-mask-visible="true" placeholder="00.000.000/0000-00" data-mask-selectonfocus="true" autocomplete="off" @if(!$errors->has('cnpj')) readonly @endif />
                                <span class="{{ $errors->has('cnpj') ? 'text-danger' : '' }}">
                                    {{ $errors->has('cnpj') ? $errors->first('cnpj') : '' }}
                                </span>
                                <span class="text-danger" id="erro-cnpj" style="display: none;">
                                    Já existe uma empresa com esse cpnj.
                                </span>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Email da empresa</div>
                                <input id="email" name="email"  type="text" class="form-control" value="{{ old('email', $empresa->email) }}" @if(!$errors->has('email')) readonly @endif />
                                <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                                    {{ $errors->has('email') ? $errors->first('email') : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <button type="submit" id="btn" class="btn btn-primary">
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {
        $('#cnpj').mask('00.000.000/0000-00');

        $('#tabela-empresas').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '//cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
            },
        });
        let empresas = {!! json_encode($empresas) !!};

        $('#cnpj').on('input', function() {
            let novoCnpj = $(this).val();
            let cnpjExiste = false; 

            empresas.forEach(function(empresa) {
                if (empresa.cnpj === novoCnpj) {
                    cnpjExiste = true;
                }
            });

            if (cnpjExiste) {
                $("#erro-cnpj").show();
                $("#btn").attr('disabled', true);
            } else {
                $("#erro-cnpj").hide();
                $("#btn").attr('disabled', false);
            }
        });
    });

    function preencheEmpresa(e){
        if (e.is(':checked')) {
            $('input[type="checkbox"]').not(e).prop('checked', false);
            empresa = e.data('empresa');

            $("#nome").val(empresa.nome);
            $("#cnpj").val(empresa.cnpj);
            $("#email").val(empresa.email);
        }else{
            $("#nome").val('').attr('readonly', false);
            $("#cnpj").val('').attr('readonly', false);
            $("#email").val('').attr('readonly', false);
        }
    }
</script>
@endsection