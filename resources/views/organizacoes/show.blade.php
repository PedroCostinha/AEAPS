{{--
    View: resources/views/organizacoes/show.blade.php
    Detalhe público da organização e listagem de suas parcerias.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0">{{ $organizacao->nome_oficial }}</h1>
        <a href="{{ route('organizacoes.index') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Dados da Organização</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">CNPJ</dt>
                        <dd class="col-sm-8">{{ $organizacao->cnpj }}</dd>
                        <dt class="col-sm-4">Endereço</dt>
                        <dd class="col-sm-8">{{ $organizacao->endereco ?? '—' }}</dd>
                        <dt class="col-sm-4">E-mail</dt>
                        <dd class="col-sm-8">{{ $organizacao->email_contato ?? '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Resumo</h5>
                    <p class="mb-1">Parcerias cadastradas: <strong>{{ $parcerias->total() }}</strong></p>
                    <p class="text-muted">Última atualização: {{ $organizacao->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Parcerias</h2>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nº do Termo</th>
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
                                <td>{{ Str::limit($p->objeto_parceria, 80) }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->data_inicio_vigencia)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($p->data_fim_vigencia)->format('d/m/Y') }}</td>
                                <td>R$ {{ number_format($p->valor_total, 2, ',', '.') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('parcerias.show', $p) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
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
        </div>
        @if($parcerias->hasPages())
            <div class="card-footer bg-white">
                {{ $parcerias->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
