{{--
    View: resources/views/admin/organizacoes/index.blade.php
    Listagem administrativa de organizações com busca, paginação e ações CRUD.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Admin • Organizações</h1>
        <a href="{{ route('admin.organizacoes.create') }}" class="btn btn-primary">Nova Organização</a>
    </div>

    {{-- Busca --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-12 col-md-8">
            <input type="text" name="q" class="form-control" placeholder="Buscar por nome ou CNPJ" value="{{ $q }}">
        </div>
        <div class="col-12 col-md-4 d-grid d-md-block">
            <button class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>

    {{-- Tabela --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome Oficial</th>
                        <th>CNPJ</th>
                        <th>E-mail</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organizacoes as $org)
                        <tr>
                            <td>{{ $org->nome_oficial }}</td>
                            <td>{{ $org->cnpj }}</td>
                            <td>{{ $org->email_contato ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.organizacoes.edit', $org) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form action="{{ route('admin.organizacoes.destroy', $org) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma excluir esta organização?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
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
        @if($organizacoes->hasPages())
            <div class="card-footer bg-white">{{ $organizacoes->links() }}</div>
        @endif
    </div>
</div>
@endsection
