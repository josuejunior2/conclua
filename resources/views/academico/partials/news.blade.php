@if(!empty($news))
    <div class="col-md-12">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card m-3" style="height: 21rem">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            @foreach ($news as $new)
                                <div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="avatar">
                                                @if(!empty($new['avatar']))
                                                    {{ $new['avatar'] }}
                                                @else 
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg> 
                                                @endif</span>
                                        </div>
                                        <div class="col">
                                            <div class="text-truncate">
                                                <b>{{ $new['nome_orientador'] }}</b>{{ $new['msg'] }} <b>{{ $new['titulo'] }}</b>
                                            </div>
                                            <div class="text-muted">{{ \Carbon\Carbon::parse($new['created_at'])->format('d/m/Y H:i') }}</div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            @php
                                                if(!empty($new['dado_rota'])){
                                                    $rota = route($new['rota'], [$new['key_dado_rota'] => $new['dado_rota']]);
                                                } else {
                                                    $rota = route($new['rota']);
                                                }
                                            @endphp
                                            <a href="{{ $rota }}"
                                                class="btn btn-outline-primary btn-pill w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-eye me-0" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif