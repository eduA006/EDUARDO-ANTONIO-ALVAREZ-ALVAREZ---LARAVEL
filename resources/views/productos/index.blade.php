<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            height: 220px;
            object-fit: cover;
        }

        .btn-custom {
            border-radius: 30px;
        }

        .header-title {
            font-weight: 700;
            color: #0d6efd;
        }

        .filtros {
            background: #fff;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .categoria-label {
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 2px 10px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <!-- ENCABEZADO -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="header-title">📦 Inventario de Productos</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('productos.create') }}" class="btn btn-success btn-custom">+ Nuevo</a>
                <a href="{{ route('productos.dashboard') }}" class="btn btn-outline-primary btn-custom">📊 Dashboard</a>
                <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary btn-custom">🗂 Categorías</a>
            </div>
        </div>

        <!-- FILTROS -->
        <form method="GET" action="{{ route('productos.index') }}" class="filtros row g-3 mb-4">
            <div class="col-md-5">
                <input type="text" name="buscar" value="{{ $buscar }}" class="form-control"
                    placeholder="🔍 Buscar producto...">
            </div>
            <div class="col-md-4">
                <select name="categoria_id" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-50 btn-custom">Filtrar</button>
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary w-50 btn-custom">Limpiar</a>
            </div>
        </form>

        <!-- MENSAJE DE ÉXITO -->
        @if (session('success'))
            <div class="alert alert-success text-center shadow-sm">{{ session('success') }}</div>
        @endif

        <!-- LISTADO DE PRODUCTOS -->
        @if ($productos->isEmpty())
            <div class="text-center text-muted mt-5">
                <p>No hay productos registrados.</p>
                <a href="{{ route('productos.create') }}" class="btn btn-primary">Agregar Producto</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($productos as $producto)
                    <div class="col-md-4 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm">

                            <!-- Imagen -->
                            @if ($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                     class="card-img-top" 
                                     alt="Imagen del producto">
                            @else
                                <div class="bg-light text-muted text-center py-5">Sin imagen</div>
                            @endif

                            <!-- Detalles -->
                            <div class="card-body text-center">
                                <h5 class="card-title text-primary fw-bold">{{ strtoupper($producto->nombre) }}</h5>
                                <p class="text-muted small">{{ $producto->descripcion }}</p>

                                <p class="mb-1"><strong>💰 Precio:</strong> S/ {{ number_format($producto->precio, 2) }}</p>
                                <p class="mb-1"><strong>📦 Stock:</strong> {{ $producto->stock }}</p>

                                <p class="text-muted small mb-3">
                                    <span class="categoria-label">
                                        {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                    </span>
                                </p>

                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Seguro que deseas eliminar este producto?')">🗑️ Eliminar</button>
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
