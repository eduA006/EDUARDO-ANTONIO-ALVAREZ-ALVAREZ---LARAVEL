<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">🏠 Dashboard del Inventario</h2>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Ver Productos</a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">📦 Total de Productos</h5>
                        <h3>{{ $totalProductos }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">🟢 Activos</h5>
                        <h3>{{ $activos }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-danger shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">🔴 Inactivos</h5>
                        <h3>{{ $inactivos }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-warning shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">⚠️ Productos con stock bajo (menos de 5)</h5>
                        <h3>{{ $stockBajo }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-info shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">💰 Valor total del inventario</h5>
                        <h3>S/ {{ number_format($valorTotal, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
