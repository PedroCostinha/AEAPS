{{--
    View: resources/views/admin/parcerias/index.blade.php
    Listagem administrativa de parcerias com busca, paginação e ações CRUD.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Admin • Parcerias</h1>
        <a href="{{ route('admin.parcerias.create') }}" class="btn btn-primary">Nova Parceria</a>
    </div>

    {{-- Busca --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-12 col-md-8">
            <input type="text" name="q" class="form-control" placeholder="Buscar por número do termo ou objeto" value="{{ $q }}">
        </div>
        <div class="col-12 col-md-4 d-grid d-md-block">
            <button class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nº do Termo</th>
                        <th>Organização</th>
                        <th>Vigência</th>
                        <th>Valor</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($parcerias as $p)
                        <tr>
                            <td>{{ $p->numero_termo }}</td>
                            <td>{{ $p->organizacao->nome_oficial }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->data_inicio_vigencia)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($p->data_fim_vigencia)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($p->valor_total, 2, ',', '.') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.parcerias.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <form action="{{ route('admin.parcerias.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma excluir esta parceria?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Nenhuma parceria encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($parcerias->hasPages())
            <div class="card-footer bg-white">{{ $parcerias->links() }}</div>
        @endif
    </div>
</div>
@endsection
