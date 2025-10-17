<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <!-- CABECERA -->
        <div class="row mb-3">
            <div class="col-lg-6">
                <h2 class="text-primary fw-bold">✏️ Editar Producto</h2>
            </div>
            <div class="col-lg-6 text-end">
                <a class="btn btn-secondary" href="{{ route('productos.index') }}">← Volver al listado</a>
            </div>
        </div>

        <!-- VALIDACIÓN DE ERRORES -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hay algunos problemas con tu entrada.<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORMULARIO -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label"><strong>Nombre:</strong></label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Descripción:</strong></label>
                        <textarea class="form-control" name="descripcion" placeholder="Descripción del producto">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Precio:</strong></label>
                        <input type="number" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Stock:</strong></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Código de Barras:</strong></label>
                        <input type="text" name="codigo_barras" class="form-control" value="{{ old('codigo_barras', $producto->codigo_barras) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Categoría:</strong></label>
                        <select name="categoria_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Imagen actual -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Imagen actual:</strong></label><br>
                        @if ($producto->imagen && file_exists(storage_path('app/public/' . $producto->imagen)))
                            <img src="{{ asset('storage/' . $producto->imagen) }}" width="150" class="rounded shadow-sm mb-2" alt="Imagen del producto">
                        @else
                            <p class="text-muted">No hay imagen disponible</p>
                        @endif
                    </div>

                    <!-- Subir nueva imagen -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Cambiar imagen:</strong></label>
                        <input type="file" name="imagen" class="form-control" accept="image/*">
                        <small class="text-muted">Formatos permitidos: JPG, PNG, GIF (máx. 2MB)</small>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">💾 Actualizar Producto</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
