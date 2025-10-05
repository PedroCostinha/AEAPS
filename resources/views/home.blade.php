{{--
    View: resources/views/home.blade.php
    Página inicial do Portal da Transparência da AEAPS.
    - Exibe estatísticas rápidas: total de organizações, total de parcerias, valor total.
    - Lista as parcerias mais recentes com link para o detalhe.
    Observações:
    - Estamos usando o layout padrão 'layouts.app' gerado pelo Breeze.
    - Incluímos classes do Bootstrap para responsividade e grid.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Cabeçalho da página --}}
    <div class="mb-4">
        <h1 class="h3">Portal da Transparência - AEAPS</h1>
        <p class="text-muted">Acompanhe as parcerias firmadas entre o poder público e as OSCs associadas.</p>
    </div>

    {{-- Cards de estatísticas rápidas --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Organizações</h5>
                    <p class="display-6 fw-bold mb-0">{{ $totalOrganizacoes }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Parcerias</h5>
                    <p class="display-6 fw-bold mb-0">{{ $totalParcerias }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Valor Total (R$)</h5>
                    <p class="display-6 fw-bold mb-0">{{ number_format($valorTotalParcerias, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de parcerias recentes --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Parcerias recentes</h2>
        </div>
        <div class="card-body">
            @if($parceriasRecentes->isEmpty())
                <p class="text-muted mb-0">Nenhuma parceria cadastrada até o momento.</p>
            @else
                <div class="list-group list-group-flush">
                    @foreach($parceriasRecentes as $p)
                        <a href="{{ route('parcerias.show', $p) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $p->numero_termo }}</strong>
                                <span class="text-muted">— {{ \Illuminate\Support\Str::limit($p->objeto_parceria, 80) }}</span>
                                <div class="small text-muted">Organização: {{ $p->organizacao->nome_oficial }}</div>
                            </div>
                            <span class="badge text-bg-primary">R$ {{ number_format($p->valor_total, 2, ',', '.') }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
