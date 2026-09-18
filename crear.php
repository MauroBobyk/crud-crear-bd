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
// Este archivo corresponde a la operación CREATE del CRUD.
// Se encarga de recibir datos desde un formulario y guardarlos en la tabla productos.

// Se incluye la conexión a la base de datos para poder ejecutar la consulta de inserción.
include 'conexion.php';

// Este mensaje se usa para informar al usuario si los datos son válidos o si hubo un error.
$mensaje = '';

// Si el formulario fue enviado, se procesan los datos del POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se obtienen los valores enviados desde el formulario y se limpia el texto extra.
    $articulo = trim($_POST['articulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $unidades = trim($_POST['unidades_disponibles'] ?? '');

    // Validaciones básicas para evitar campos vacíos o valores incorrectos.
    if ($articulo === '') {
        $mensaje = 'Debes completar el nombre del artículo.';
    } elseif ($descripcion === '') {
        $mensaje = 'Debes completar la descripción del producto.';
    } elseif ($unidades === '' || !is_numeric($unidades) || (int)$unidades < 0) {
        $mensaje = 'La cantidad de unidades debe ser un número mayor o igual a 0.';
    } else {
        // Se prepara una sentencia SQL para insertar el registro.
        // Los signos ? evitan inyección SQL y permiten pasar datos de forma segura.
        $consulta = $conexionbd->prepare(
            "INSERT INTO productos (articulo, descripcion, unidades_disponibles) VALUES (?, ?, ?)"
        );

        // Se ejecuta la inserción con los valores reales recibidos del formulario.
        $consulta->execute([$articulo, $descripcion, (int)$unidades]);

        // Se confirma al usuario que el producto fue guardado correctamente.
        $mensaje = 'Producto creado con éxito.';

        // Se limpian las variables para que el formulario quede listo para otra carga.
        $articulo = '';
        $descripcion = '';
        $unidades = '';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <!-- Bootstrap aporta estilos visuales comunes para botones y formularios -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Estilos personalizados del proyecto -->
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="page">
    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <!-- Título visual de la página -->
                <h1 class="mb-4">Crear Producto</h1>

                <!-- Si hay un mensaje, lo muestra arriba del formulario -->
                <?php if ($mensaje !== ''): ?>
                    <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
                <?php endif; ?>

                <!-- Formulario con los campos necesarios para crear un producto -->
                <form method="POST" class="form-style">
                    <label for="articulo">Artículo</label>
                    <input type="text" id="articulo" name="articulo" value="<?= htmlspecialchars($articulo ?? '') ?>" required>

                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($descripcion ?? '') ?></textarea>

                    <label for="unidades_disponibles">Unidades disponibles</label>
                    <input type="number" id="unidades_disponibles" name="unidades_disponibles" min="0" value="<?= htmlspecialchars($unidades ?? '') ?>" required>

                    <button type="submit" class="btn btn-success">Guardar producto</button>
                </form>

                <!-- Enlaces para volver a la lista o al inicio -->
                <div class="mt-3">
                    <a href="ver.php" class="btn btn-outline-primary">Ver productos</a>
                    <a href="index.php" class="btn btn-outline-secondary">Volver al inicio</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
