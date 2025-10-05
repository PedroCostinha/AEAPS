{{--
    View: resources/views/admin/parcerias/create.blade.php
    Formulário administrativo para criar uma nova parceria.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Nova Parceria</h1>
        <a href="{{ route('admin.parcerias.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

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

    <form action="{{ route('admin.parcerias.store') }}" method="POST" class="card shadow-sm">
        @csrf
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Organização</label>
                    <select name="organizacao_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($organizacoes as $org)
                            <option value="{{ $org->id }}" @selected(old('organizacao_id') == $org->id)>{{ $org->nome_oficial }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Número do Termo</label>
                    <input type="text" name="numero_termo" class="form-control" value="{{ old('numero_termo') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Objeto da Parceria</label>
                    <textarea name="objeto_parceria" class="form-control" rows="4" required>{{ old('objeto_parceria') }}</textarea>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Valor Total (R$)</label>
                    <input type="number" step="0.01" name="valor_total" class="form-control" value="{{ old('valor_total') }}" required>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Início da Vigência</label>
                    <input type="date" name="data_inicio_vigencia" class="form-control" value="{{ old('data_inicio_vigencia') }}" required>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Fim da Vigência</label>
                    <input type="date" name="data_fim_vigencia" class="form-control" value="{{ old('data_fim_vigencia') }}" required>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-end gap-2">
            <button class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
@endsection
