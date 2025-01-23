@extends('layouts.admin')

@section('css')
<style>
    .pagination {
        margin: 0;
        padding: 0;
        justify-content: flex-end;
    }
    .pagination .page-item .page-link {
        color: #007bff;
        border: 1px solid #dee2e6;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Logs do Sistema</h3>
        </div>
        <div class="card-body table-responsive">
            @if ($paginatedLogs->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Dados</th>
                            <th>Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paginatedLogs as $log)
                            <tr>
                                <td>{{ $log['date'] }}</td>
                                <td>{{ $log['type'] }}</td>
                                <td>{{ $log['message'] }} <br>
                                    @if (is_array($log['data']) && !empty($log['data']))
                                        @foreach ($log['data'] as $model)
                                            @if (is_array($model))
                                                @foreach ($model as $key => $value)
                                                    @if (is_array($value))
                                                        <strong>{{ $key }}</strong> {
                                                        @foreach ($value as $key => $attr)
                                                            <strong>{{ $key }}:</strong> {{ is_array($attr) ? implode($attr) : $attr }}
                                                        @endforeach
                                                        }
                                                    @else
                                                        {{$value}}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{$model}}
                                            @endif
                                                
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $log['user'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <p class="mb-0">
                                Exibindo {{ $paginatedLogs->firstItem() }} a {{ $paginatedLogs->lastItem() }} de {{ $paginatedLogs->total() }} registros
                            </p>
                        </div>
                        <div>
                            {{ $paginatedLogs->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @else
                <p>Nenhum log encontrado.</p>
            @endif
        </div>
    </div>
</div>
@endsection
