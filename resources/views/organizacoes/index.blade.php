{{--
    View: resources/views/organizacoes/index.blade.php
    Lista pública de organizações com campo de busca e paginação.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0">Organizações Parceiras</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>

    {{-- Formulário de busca simples por nome ou CNPJ --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-12 col-md-8">
            <input type="text" name="q" class="form-control" placeholder="Buscar por nome ou CNPJ" value="{{ $q }}">
        </div>
        <div class="col-12 col-md-4 d-grid d-md-block">
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nome Oficial</th>
                            <th>CNPJ</th>
                            <th>E-mail</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($organizacoes as $org)
                            <tr>
                                <td>{{ $org->nome_oficial }}</td>
                                <td>{{ $org->cnpj }}</td>
                                <td>{{ $org->email_contato ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('organizacoes.show', $org) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Nenhuma organização encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($organizacoes->hasPages())
            <div class="card-footer bg-white">
                {{ $organizacoes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
