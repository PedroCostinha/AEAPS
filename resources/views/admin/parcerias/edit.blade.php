{{--
    View: resources/views/admin/parcerias/edit.blade.php
    Edição administrativa de uma parceria, com formulário de dados principais e
    seção para upload/listagem/remoção de documentos PDF.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Editar Parceria: {{ $parceria->numero_termo }}</h1>
        <a href="{{ route('admin.parcerias.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold">Ocorreram erros de validação:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário principal da parceria --}}
    <form action="{{ route('admin.parcerias.update', $parceria) }}" method="POST" class="card shadow-sm mb-4">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Organização</label>
                    <select name="organizacao_id" class="form-select" required>
                        @foreach($organizacoes as $org)
                            <option value="{{ $org->id }}" @selected(old('organizacao_id', $parceria->organizacao_id) == $org->id)>{{ $org->nome_oficial }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Número do Termo</label>
                    <input type="text" name="numero_termo" class="form-control" value="{{ old('numero_termo', $parceria->numero_termo) }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Objeto da Parceria</label>
                    <textarea name="objeto_parceria" class="form-control" rows="4" required>{{ old('objeto_parceria', $parceria->objeto_parceria) }}</textarea>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Valor Total (R$)</label>
                    <input type="number" step="0.01" name="valor_total" class="form-control" value="{{ old('valor_total', $parceria->valor_total) }}" required>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Início da Vigência</label>
                    <input type="date" name="data_inicio_vigencia" class="form-control" value="{{ old('data_inicio_vigencia', $parceria->data_inicio_vigencia) }}" required>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Fim da Vigência</label>
                    <input type="date" name="data_fim_vigencia" class="form-control" value="{{ old('data_fim_vigencia', $parceria->data_fim_vigencia) }}" required>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-end gap-2">
            <button class="btn btn-primary">Salvar alterações</button>
            <form action="{{ route('admin.parcerias.destroy', $parceria) }}" method="POST" onsubmit="return confirm('Confirma excluir esta parceria?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">Excluir</button>
            </form>
        </div>
    </form>

    {{-- Seção de documentos --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Documentos</h2>
        </div>
        <div class="card-body">
            {{-- Formulário de upload de PDF --}}
            <form action="{{ route('admin.parcerias.documentos.upload', $parceria) }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-end mb-4">
                @csrf
                <div class="col-12 col-lg-3">
                    <label class="form-label">Nome do Documento</label>
                    <input type="text" name="nome_documento" class="form-control" required>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo_documento" class="form-select" required>
                        <option value="plano_de_trabalho">Plano de Trabalho</option>
                        <option value="termo_colaboracao">Termo de Colaboração</option>
                        <option value="relatorio_atividades">Relatório de Atividades</option>
                        <option value="prestacao_contas">Prestação de Contas</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Data de Publicação</label>
                    <input type="date" name="data_publicacao" class="form-control">
                </div>
                <div class="col-12 col-lg-3">
                    <label class="form-label">Arquivo (PDF)</label>
                    <input type="file" name="arquivo" class="form-control" accept="application/pdf" required>
                </div>
                <div class="col-12">
                    <button class="btn btn-success">Enviar Documento</button>
                </div>
            </form>

            {{-- Lista de documentos anexados --}}
            @if($parceria->documentos->isEmpty())
                <p class="text-muted mb-0">Nenhum documento anexado até o momento.</p>
            @else
                <div class="list-group list-group-flush">
                    @foreach($parceria->documentos as $doc)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="fw-semibold">{{ strtoupper($doc->nome_documento) }} <span class="text-muted">({{ $doc->tipo_documento }})</span></div>
                                @if($doc->data_publicacao)
                                    <div class="small text-muted">Publicado em {{ \Carbon\Carbon::parse($doc->data_publicacao)->format('d/m/Y') }}</div>
                                @endif
                                <a href="{{ Storage::url($doc->caminho_arquivo) }}" target="_blank" class="small">Abrir PDF</a>
                            </div>
                            <form action="{{ route('admin.parcerias.documentos.destroy', [$parceria, $doc]) }}" method="POST" onsubmit="return confirm('Confirma remover este documento?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
