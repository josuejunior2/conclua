@extends('layouts.admin')


@section('content')
<div class="page-body">

    <div class="container-xl">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        Home - Admin
         {{-- @dd($semestreAtual) --}}
    </div>
</div>
@endsection
