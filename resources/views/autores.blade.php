@extends('adminlte::page')

@section('title', 'MENU')

@section('content_header')
    <h1>UPEA TELEVISION</h1>
    <div class="container mt-5">
        <h1 class="text-center">AUTORIDADES</h1>

        {{-- Formulario para generar resumen --}}
        <form id="resumenForm" action="{{ route('generarResumen') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="texto" class="form-label">Introduce tu texto:</label>
                <textarea class="form-control" id="texto" name="texto" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Generar Resumen</button>
        </form>

        {{-- Mostrar resumen generado --}}
        <div id="resultado" class="mt-4">
            @if (session('resumenes'))
                <div class="alert alert-success">
                    <h5>AUTORIDADES </h5>
                    <ol>
                        @foreach (session('resumenes') as $resumen)
                            <li>{{ $resumen }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>

        {{-- Tabla de cuadros --}}
        <div class="mt-5">
            <h2 class="text-center">Lista de Autoridades</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($autoridades as $index => $autoridad)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $autoridad->nombre }}</td>
                            <td>{{ $autoridad->cargo }}</td>
                            <td>
                                <a href="{{ route('editarAutoridad', $autoridad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('eliminarAutoridad', $autoridad->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Nuevos botones --}}
        <div class="mt-4">
            <a href="{{ route('pantalla1') }}" class="btn btn-secondary w-100 mb-2">Ir a Pantalla 1</a>
            <a href="{{ route('pantalla2') }}" class="btn btn-secondary w-100">Ir a Pant
