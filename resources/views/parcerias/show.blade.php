{{--
    View: resources/views/parcerias/show.blade.php
    Detalhe público de uma parceria, exibindo seus dados e todos os documentos anexados.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 mb-0">Parceria: {{ $parceria->numero_termo }}</h1>
        <a href="{{ route('organizacoes.show', $parceria->organizacao) }}" class="btn btn-outline-secondary btn-sm">Voltar para a Organização</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Informações da Parceria</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Organização</dt>
                        <dd class="col-sm-8">
                            <a href="{{ route('organizacoes.show', $parceria->organizacao) }}">{{ $parceria->organizacao->nome_oficial }}</a>
                        </dd>
                        <dt class="col-sm-4">Objeto</dt>
                        <dd class="col-sm-8">{{ $parceria->objeto_parceria }}</dd>
                        <dt class="col-sm-4">Vigência</dt>
                        <dd class="col-sm-8">{{ \Carbon\Carbon::parse($parceria->data_inicio_vigencia)->format('d/m/Y') }} — {{ \Carbon\Carbon::parse($parceria->data_fim_vigencia)->format('d/m/Y') }}</dd>
                        <dt class="col-sm-4">Valor Total</dt>
                        <dd class="col-sm-8">R$ {{ number_format($parceria->valor_total, 2, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Acesso Rápido</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#docs" class="link-primary">Ir para Documentos</a></li>
                        <li><a href="{{ route('organizacoes.show', $parceria->organizacao) }}" class="link-primary">Ver Organização</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="docs" class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Documentos</h2>
        </div>
        <div class="card-body">
            @if($parceria->documentos->isEmpty())
                <p class="text-muted mb-0">Nenhum documento publicado para esta parceria ainda.</p>
            @else
                <div class="list-group list-group-flush">
                    @foreach($parceria->documentos as $doc)
                        <a href="{{ Storage::url($doc->caminho_arquivo) }}" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ strtoupper($doc->nome_documento) }}</strong>
                                <span class="text-muted">({{ $doc->tipo_documento }})</span>
                                @if($doc->data_publicacao)
                                    <div class="small text-muted">Publicado em {{ \Carbon\Carbon::parse($doc->data_publicacao)->format('d/m/Y') }}</div>
                                @endif
                            </div>
                            <span class="badge text-bg-secondary">PDF</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
