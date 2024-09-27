@extends('layouts.guest')

@section('content')
<div class="page-body">
    <div class="container-xl">
    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
            <div class="card-body">
                <ul class="steps steps-green steps-counter my-4">
                    <li class="step-item">Informações gerais</li>
                    <li class="step-item active">Dados da empresa</li>
                    <li class="step-item">Dados do estágio</li>
                    <li class="step-item">Confirmação</li>
                </ul>
                <h3 class="card-title">Selecione ou cadastre uma empresa</h3>
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
                        @foreach ($empresas as $empresa)
                            <tr>
                                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Selecione a empresa" id="empresa_{{$empresa->id}}" data-cnpj="{{$empresa->cnpj}}" data-empresa="{{$empresa}}" onclick="preencheEmpresa($(this))"></td>
                                <td>{{ $empresa->nome }}</td>
                                <td>{{ $empresa->cnpj }}</td>
                                <td>{{ $empresa->email }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <form method="POST" action="{{ route('empresa.store') }}" autocomplete="off" novalidate>
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Nome da empresa</div>
                                <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ old('nome', '') }}" /></div>
                                <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                                </span>
                            </div>                    
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Cadastro Nacional de Pessoa Jurídica (CNPJ)</div>
                                <input id="cnpj" name="cnpj" type="text" class="form-control" value="{{ old('cnpj', '') }}" data-mask="00.000.000/0000-00" data-mask-visible="true" placeholder="00.000.000/0000-00" data-mask-selectonfocus="true" autocomplete="off" />
                                <span class="{{ $errors->has('cnpj') ? 'text-danger' : '' }}">
                                    {{ $errors->has('cnpj') ? $errors->first('cnpj') : '' }}
                                </span>
                                <div id="cnpjStatus">
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <div class="form-label required">Email da empresa</div>
                                <input id="email" name="email"  type="text" class="form-control" value="{{ old('email', '') }}" />
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
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
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
        
        $('#cnpj').on('input', function() {
            let novoCnpj = $(this).val();
            
            if(novoCnpj.length == 18){
                $.ajax({
                    url: '/verifica-cnpj',
                    type: 'POST', 
                    data: {
                        cnpj: cnpj,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#cnpjStatus').html('<span class="text-danger">CNPJ já cadastrado!</span>');
                            $("#btn").attr("disabled", true);
                        } else {
                            $('#cnpjStatus').html('<span class="text-success">CNPJ disponível!</span>');
                            $("#btn").attr("disabled", false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição: ', error);
                    }
                });
            }
        });
    });

    function preencheEmpresa(e){
        if (e.is(':checked')) {
            $('input[type="checkbox"]').not(e).prop('checked', false);
            $('input[type="checkbox"]').not(e).prop('checked', false);
            empresa = e.data('empresa');

            $("#nome").val(empresa.nome);
            $("#nome").attr('readonly', true);
            $("#cnpj").val(empresa.cnpj);
            $("#cnpj").attr('readonly', true);
            $("#email").val(empresa.email);
            $("#email").attr('readonly', true);
        }else{
            $("#nome").val('').attr('readonly', false);
            $("#cnpj").val('').attr('readonly', false);
            $("#email").val('').attr('readonly', false);
        }
    }
</script>
@endsection