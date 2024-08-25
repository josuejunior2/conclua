<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Relatório de orientações</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .content-wrap {
            width: 100%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
        }

        .cabecalho h6 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
            color: #2c3e50;
        }

        .cabecalho small {
            font-size: 12px;
            color: #7f8c8d;
        }

        .cabecalho h5 {
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
            color: #34495e;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }

        .table-bordered th {
            background-color: #34495e;
            color: #fff;
            font-weight: bold;
        }

        .table-bordered tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="content-wrap">
        <div>
            <div class="cabecalho">
                <center>
                    <h6> COORDENAÇÃO DO CURSO DE BACHARELADO EM ADMINISTRAÇÃO DA UNIMONTES </h6>
                    <small class="">Emitido em: {{ date('d/m/Y H:i:s') }}</small>
                </center>
                <h5 class="">
                    <center>Relatório das orientações</center>
                    </h3>
            </div>
            <div class="">
                <div>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>Orientador</th>
                                <th>Acadêmico</th>
                                <th>Modalidade</th>
                                <th>Tema</th>
                                <th>Nota</th>
                                <th>Conceito</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orientacoes as $key => $orientacao)
                                <tr>
                                    <td>{{ $orientacao['orientador']['admin']['nome'] }}</td>
                                    <td>{{ $orientacao['academico']['user']['nome'] }}</td>
                                    <td>{{ $orientacao['modalidade'] }}</td>
                                    <td>{{ $orientacao['tema'] }}</td>
                                    <td>{{ $orientacao['nota'] }}</td>
                                    <td>{{ $orientacao['avaliacao_final'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
