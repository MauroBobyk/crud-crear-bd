<?php
// Este archivo corresponde a la operación READ del CRUD.
// Se usa para consultar todos los productos guardados en la base de datos y mostrarlos al usuario.

// Se incluye la conexión para poder consultar la base de datos.
include 'conexion.php';

// Se ejecuta la consulta para leer todos los productos ordenados por id de mayor a menor.
$consulta = $conexionbd->query("SELECT * FROM productos ORDER BY id DESC");

// El resultado se guarda en un array para poder recorrerlo con un foreach y mostrarlo en la tabla.
$productos = $consulta->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <!-- Bootstrap para darle estilo a la tabla, botones y mensajes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Estilos del proyecto -->
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="page">
    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <!-- Encabezado de la vista principal de lectura -->
                <h1 class="mb-4">Lista de Productos</h1>

                <!-- Botones de navegación para ir a crear registros o volver al inicio -->
                <div class="mb-3">
                    <a href="crear.php" class="btn btn-primary">Crear producto</a>
                    <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
                </div>

                <?php if (empty($productos)): ?>
                    <!-- Si la tabla está vacía, se informa al usuario que todavía no hay registros -->
                    <div class="alert alert-info">Todavía no hay productos cargados.</div>
                <?php else: ?>
                    <!-- Cuando hay datos, se arma una tabla HTML para visualizarlos -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Artículo</th>
                                    <th>Descripción</th>
                                    <th>Unidades</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <!-- Cada columna representa un dato del producto -->
                                        <td><?= htmlspecialchars($producto['id']) ?></td>
                                        <td><?= htmlspecialchars($producto['articulo']) ?></td>
                                        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                                        <td><?= htmlspecialchars($producto['unidades_disponibles']) ?></td>
                                        <td>
                                            <!-- Formulario para eliminar un producto según su id -->
                                            <form method="POST" action="eliminar.php" class="d-inline">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este producto?');">Eliminar</button>
                                            </form>
                                            <!-- Enlace para abrir la página de edición de ese producto -->
                                            <a href="modificar.php?id=<?= urlencode($producto['id']) ?>" class="btn btn-warning btn-sm">Modificar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
