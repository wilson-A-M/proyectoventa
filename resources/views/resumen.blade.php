

@extends('adminlte::page')

@section('title', 'MENU')

@section('content_header')
    <h1>UPEA TELEVISION</h1>
        <div class="container mt-5">
        <h1 class="text-center">Generador de Resúmenes</h1>
        <form id="resumenForm" action="{{ route('generarResumen') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="texto" class="form-label">Introduce tu texto:</label>
                <textarea class="form-control" id="texto" name="texto" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Generar Resumen</button>
        </form>

        <div id="resultado" class="mt-4">
            @if (session('resumenes'))
                <div class="alert alert-success">
                    <h5>Resúmenes generados:</h5>
                    <ol>
                        @foreach (session('resumenes') as $resumen)
                            <li>{{ $resumen }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>

    </div>

@stop

@section('content')
    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
