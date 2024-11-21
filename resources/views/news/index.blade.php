@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-4">
            <h2>Noticias</h2>
        </div>

        @foreach($noticias as $noticia)
            <div class="col-md-6 mb-4">
                <div class="card hover-effect">
                    <div class="card-body">
                        <h5 class="card-title">{{ $noticia->titulo }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ $noticia->fuente }} -
                            {{ $noticia->fecha_publicacion->format('l, d F Y') }}
                        </h6>
                        <p class="card-text">
                            {{ Str::limit($noticia->contenido, 200) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">{{ $noticia->categoria }}</span>
                            <a href="{{ $noticia->url }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-external-link-alt"></i> Leer más
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            {{ $noticias->links() }}
        </div>
    </div>
</div>
@endsection
