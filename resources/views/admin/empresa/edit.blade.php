@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Editar empresa</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('admin.empresa.update', ['empresa' => $empresa]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-4">
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Nome da empresa</div>
                    <div><input id="nome" name="nome"  type="text" class="form-control" value="{{ old('nome', $empresa->nome) }}" /></div>
                    <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </span>
                </div>                    
            </div>
            <div class="col-md">
                <div class="mb-3">
                    <div class="form-label required">Cadastro Nacional de Pessoa Jurídica (CNPJ)</div>
                    <input id="cnpj" name="cnpj" type="text" class="form-control" value="{{ old('cnpj', $empresa->cnpj) }}" data-mask="00.000.000/0000-00" data-mask-visible="true" placeholder="00.000.000/0000-00" data-mask-selectonfocus="true" autocomplete="off" />
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
                    <input id="email" name="email"  type="text" class="form-control" value="{{ old('email', $empresa->email) }}" />
                    <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    </span>
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
                url: '/pt-br-datatables.json',
            },
        });

        $('#cnpj').on('input', function(e) {
            let cnpjAtual = "{{ $empresa->cnpj }}"
            let novoCnpj = $(this).val();
            
            if(novoCnpj.length == 18){
                $.ajax({
                    url: '/verifica-cnpj',
                    type: 'POST', 
                    data: {
                        cnpj: novoCnpj,
                        cnpjAtual: cnpjAtual,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.exists && novoCnpj != cnpjAtual) {
                            $('#cnpjStatus').html('<span class="text-danger">CNPJ já cadastrado!</span>');
                            $("#btn").attr("disabled", true);
                        } else if(!response.exists) {
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

</script>
@endsection
