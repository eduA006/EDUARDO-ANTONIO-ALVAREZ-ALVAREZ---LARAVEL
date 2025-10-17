<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <!-- CABECERA -->
        <div class="row mb-3">
            <div class="col-lg-6">
                <h2 class="text-success fw-bold">➕ Nuevo Producto</h2>
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
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label"><strong>Nombre:</strong></label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Descripción:</strong></label>
                        <textarea class="form-control" name="descripcion" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Precio:</strong></label>
                        <input type="number" name="precio" class="form-control" value="{{ old('precio') }}" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Stock:</strong></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Código de Barras:</strong></label>
                        <input type="text" name="codigo_barras" class="form-control" value="{{ old('codigo_barras') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Categoría:</strong></label>
                        <select name="categoria_id" class="form-control" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subir imagen -->
                    <div class="mb-3">
                        <label class="form-label"><strong>Imagen del producto:</strong></label>
                        <input type="file" name="imagen" class="form-control" accept="image/*">
                        <small class="text-muted">Formatos permitidos: JPG, PNG, GIF (máx. 2MB)</small>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success px-4">💾 Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
