{{--
    View: resources/views/admin/organizacoes/edit.blade.php
    Formulário administrativo para editar uma organização existente.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Editar Organização</h1>
        <a href="{{ route('admin.organizacoes.index') }}" class="btn btn-outline-secondary">Voltar</a>
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

    <form action="{{ route('admin.organizacoes.update', $organizacao) }}" method="POST" class="card shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nome Oficial</label>
                    <input type="text" name="nome_oficial" class="form-control" value="{{ old('nome_oficial', $organizacao->nome_oficial) }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">CNPJ</label>
                    <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj', $organizacao->cnpj) }}" required oninput="maskCNPJ(this)">
                </div>
                <div class="col-12">
                    <label class="form-label">Endereço</label>
                    <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $organizacao->endereco) }}">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">E-mail de Contato</label>
                    <input type="email" name="email_contato" class="form-control" value="{{ old('email_contato', $organizacao->email_contato) }}">
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex justify-content-end gap-2">
            <button class="btn btn-primary">Salvar alterações</button>
            <form action="{{ route('admin.organizacoes.destroy', $organizacao) }}" method="POST" onsubmit="return confirm('Confirma excluir esta organização?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">Excluir</button>
            </form>
        </div>
    </form>
    <script>
        function maskCNPJ(el){
            const digits = (el.value || '').replace(/\D+/g,'').slice(0,14);
            let out = digits;
            if(digits.length > 2) out = digits.slice(0,2)+'.'+digits.slice(2);
            if(digits.length > 5) out = out.slice(0,6)+'.'+digits.slice(5);
            if(digits.length > 8) out = out.slice(0,10)+'/'+digits.slice(8);
            if(digits.length > 12) out = out.slice(0,15)+'-'+digits.slice(12);
            el.value = out;
        }
    </script>
</div>
@endsection
