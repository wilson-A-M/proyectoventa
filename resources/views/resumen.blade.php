<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Resúmenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
