/*
  Copyright (C) 2026, Mauro Bobyk.

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <https://gnu.org>.
*/
<?php
// Este archivo corresponde a la operación UPDATE del CRUD.
// Se usa para buscar un producto, mostrar sus datos y luego reemplazarlos por información nueva.

// Se incluye la conexión para consultar y actualizar la base de datos.
include 'conexion.php';

// Se recibe el id del producto a editar, ya sea por POST o por GET.
$id = $_POST['id'] ?? $_GET['id'] ?? null;
$producto = null;
$mensaje = '';

// Si no llega un id válido, la ejecución se corta para evitar errores.
if ($id === null || !is_numeric($id)) {
    echo 'ID inválido.';
    exit;
}

// Se consulta el producto actual para cargar sus datos en el formulario.
$consulta = $conexionbd->prepare("SELECT * FROM productos WHERE id = ?");
$consulta->execute([$id]);
$producto = $consulta->fetch();

// Si no existe ese registro, se informa al usuario.
if (!$producto) {
    echo 'Producto no encontrado.';
    exit;
}

// Si el formulario fue enviado para guardar cambios, se validan y actualizan los datos.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $articulo = trim($_POST['articulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $unidades = trim($_POST['unidades_disponibles'] ?? '');

    // Se valida que el nombre, descripción y stock sean correctos.
    if ($articulo === '') {
        $mensaje = 'Debes completar el nombre del artículo.';
    } elseif ($descripcion === '') {
        $mensaje = 'Debes completar la descripción.';
    } elseif ($unidades === '' || !is_numeric($unidades) || (int)$unidades < 0) {
        $mensaje = 'La cantidad de unidades debe ser un número mayor o igual a 0.';
    } else {
        // Se ejecuta la actualización del producto en la base de datos.
        $consulta = $conexionbd->prepare(
            "UPDATE productos SET articulo = ?, descripcion = ?, unidades_disponibles = ? WHERE id = ?"
        );
        $consulta->execute([$articulo, $descripcion, (int)$unidades, $id]);

        // Una vez actualizado, se vuelve a la vista de listado.
        header('Location: ver.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <!-- Bootstrap para mantener un estilo consistente -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Estilos específicos del proyecto -->
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="page">
    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <!-- Título de la vista de edición -->
                <h1 class="mb-4">Modificar Producto</h1>

                <!-- Si hubo un error de validación, se muestra aquí -->
                <?php if ($mensaje !== ''): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($mensaje) ?></div>
                <?php endif; ?>

                <!-- El formulario se carga con los datos actuales para poder editarlos -->
                <form method="POST" class="form-style">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">

                    <label for="articulo">Artículo</label>
                    <input type="text" id="articulo" name="articulo" value="<?= htmlspecialchars($producto['articulo']) ?>" required>

                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>

                    <label for="unidades_disponibles">Unidades disponibles</label>
                    <input type="number" id="unidades_disponibles" name="unidades_disponibles" min="0" value="<?= htmlspecialchars($producto['unidades_disponibles']) ?>" required>

                    <button type="submit" name="actualizar" class="btn btn-warning">Actualizar producto</button>
                </form>

                <!-- Enlaces para volver a la lista o al inicio -->
                <div class="mt-3">
                    <a href="ver.php" class="btn btn-outline-primary">Volver a la lista</a>
                    <a href="index.php" class="btn btn-outline-secondary">Inicio</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
