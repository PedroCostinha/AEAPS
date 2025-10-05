{{--
    View: resources/views/busca/index.blade.php
    Busca avançada pública de parcerias por organização, número do termo, objeto e ano.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Busca Avançada de Parcerias</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>

    {{-- Formulário de filtros --}}
    <form method="GET" class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-lg-3">
                    <label class="form-label">Organização</label>
                    <input type="text" name="organizacao" class="form-control" value="{{ $filtros['org'] }}" placeholder="Nome da organização">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Número do Termo</label>
                    <input type="text" name="numero_termo" class="form-control" value="{{ $filtros['termo'] }}" placeholder="Ex.: TC 098/20">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Objeto</label>
                    <input type="text" name="objeto" class="form-control" value="{{ $filtros['obj'] }}" placeholder="Palavra-chave do objeto">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Ano</label>
                    <input type="number" name="ano" class="form-control" value="{{ $filtros['ano'] }}" placeholder="Ex.: 2024">
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-end gap-2">
            <a href="{{ route('busca.index') }}" class="btn btn-outline-secondary">Limpar</a>
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

    {{-- Resultados --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nº do Termo</th>
                            <th>Organização</th>
                            <th>Objeto</th>
                            <th>Vigência</th>
                            <th>Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($parcerias as $p)
                            <tr>
                                <td>{{ $p->numero_termo }}</td>
                                <td>{{ $p->organizacao->nome_oficial }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($p->objeto_parceria, 80) }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->data_inicio_vigencia)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($p->data_fim_vigencia)->format('d/m/Y') }}</td>
                                <td>R$ {{ number_format($p->valor_total, 2, ',', '.') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('parcerias.show', $p) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Nenhuma parceria encontrada com os filtros informados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($parcerias->hasPages())
            <div class="card-footer bg-white">{{ $parcerias->links() }}</div>
        @endif
    </div>
</div>
@endsection
