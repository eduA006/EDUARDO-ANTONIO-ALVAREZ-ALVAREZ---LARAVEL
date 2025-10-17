<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary m-0">🗂️ Categorías</h2>
            <div>
                <a href="{{ route('categorias.create') }}" class="btn btn-success">+ Nueva</a>
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary ms-2">⬅ Volver</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if ($categorias->isEmpty())
            <div class="text-center text-muted mt-5">
                <p>No hay categorías registradas todavía.</p>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary">Agregar Categoría</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($categorias as $categoria)
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary mb-2">{{ $categoria->nombre }}</h5>
                                <p class="text-muted small mb-3">{{ $categoria->descripcion }}</p>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</body>
</html>
