@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Carreras</h1>
    <div class="row">
        @foreach($carreras as $carrera)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a href="{{ route('carreras.show', $carrera->id) }}" class="text-white">{{ $carrera->nombre }}</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Misión</h6>
                        <p class="card-text">{{ $carrera->mision }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">Visión</h6>
                        <p class="card-text">{{ $carrera->vision }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Publicado hace {{ \Carbon\Carbon::now()->diffInDays($carrera->created_at) }} días</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        width: 30%;
        margin: 10px;
        background-color: #f8f9fa;
        border: 1px solid #007bff;
    }
    .card-header {
        background-color: #007bff;
        color: white;
    }
    h1, h2 {
        color: #343a40;
    }
</style>
@endsection
