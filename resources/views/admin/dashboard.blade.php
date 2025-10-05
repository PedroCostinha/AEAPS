{{--
    View: resources/views/admin/dashboard.blade.php
    Painel administrativo simples (placeholder) protegido por autenticação.
--}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h4 mb-3">Dashboard Administrativo</h1>
    <p class="text-muted">Bem-vindo ao painel. Aqui você verá estatísticas e atalhos de gestão.</p>

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Atalhos</h5>
                    <ul class="mb-0">
                        <li><a href="#">Gerenciar Organizações</a></li>
                        <li><a href="#">Gerenciar Parcerias</a></li>
                        <li><a href="#">Uploads de Documentos</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Status</h5>
                    <p class="mb-0 text-muted">Funcionalidades administrativas serão implementadas nas próximas etapas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
