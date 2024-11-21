@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ $carrera->nombre }}</h1>
    <h6 class="text-muted">Misión</h6>
    <p>{{ $carrera->mision }}</p>
    <h6 class="text-muted">Visión</h6>
    <p>{{ $carrera->vision }}</p>

    <h2 class="mt-4">Autoridades</h2>
    <ul class="list-group">
        @foreach($carrera->autoridades as $autoridad)
            <li class="list-group-item">
                <strong>{{ $autoridad->nombre }} {{ $autoridad->apellidos }}</strong><br>
                Cargo: {{ $autoridad->cargo }}<br>
                Teléfono: {{ $autoridad->telefono }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
