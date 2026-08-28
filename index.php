<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <!-- Bootstrap se usa para reutilizar estilos visuales estándar en la interfaz. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Este archivo contiene los estilos propios del proyecto para personalizar la apariencia. -->
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="page">
    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <!-- Título principal de la aplicación. -->
                <h1 class="text-center mb-3">Gestión de Productos</h1>

                <!-- Menú principal con acceso a las operaciones básicas del sistema. -->
                <div class="menu">
                    <!-- Botón para preparar la base de datos antes de usar la app. -->
                    <a href="setup.php" class="btn btn-warning btn-lg">Crear base de datos</a>
                    <!-- Botón para abrir el formulario de creación de un nuevo producto. -->
                    <a href="crear.php" class="btn btn-primary btn-lg">Crear producto</a>
                    <!-- Botón para visualizar todos los productos que existen en la tabla. -->
                    <a href="ver.php" class="btn btn-success btn-lg">Ver productos</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>