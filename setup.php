<?php
// Este archivo prepara la base de datos del proyecto.
// Tiene como objetivo crear la base tienda y la tabla productos si aún no existen.

// Datos del servidor local de MariaDB/MySQL.
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'tienda';

// Este mensaje se usa para mostrar si la operación tuvo éxito o si hubo un error.
$mensaje = '';

try {
    // Primero se conecta al servidor sin especificar una base en particular.
    // Esto permite crear la base de datos si aún no existe.
    $pdoServidor = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Se ejecuta la sentencia CREATE DATABASE IF NOT EXISTS.
    // Con esto se evita crear la base dos veces si ya existe.
    $pdoServidor->exec("CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

    // Luego se conecta directamente a la base creada.
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Se crea la tabla productos con sus columnas principales.
    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS productos (
            id INT NOT NULL AUTO_INCREMENT,
            articulo VARCHAR(50) NOT NULL,
            descripcion TEXT NOT NULL,
            unidades_disponibles INT NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci"
    );

    // Si la tabla está vacía, se inserta un producto inicial para probar la aplicación.
    $pdo->exec(
        "INSERT INTO productos (articulo, descripcion, unidades_disponibles)
         SELECT 'Aceite', 'Producto de girasol', 20
         WHERE NOT EXISTS (SELECT 1 FROM productos LIMIT 1)"
    );

    // Si todo salió bien, se muestra un mensaje de confirmación.
    $mensaje = 'La base de datos y la tabla productos se crearon correctamente.';
} catch (PDOException $e) {
    // Si hubo algún problema, se muestra el error exacto para depurar.
    $mensaje = 'Error al crear la base de datos: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup de la Base de Datos</title>
    <!-- Bootstrap para darle un estilo base a la interfaz -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Estilos específicos del proyecto -->
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body class="page">
    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <!-- Título de la página de preparación del entorno -->
                <h1 class="mb-3">Migración de la base de datos</h1>

                <!-- Aquí se muestra si la creación fue exitosa o si hubo un error -->
                <?php if ($mensaje !== ''): ?>
                    <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
                <?php endif; ?>

                <!-- Explicación breve de lo que hace esta pantalla -->
                <p class="text-muted">
                    Esta acción crea la base <strong>tienda</strong> y la tabla <strong>productos</strong> si no existen.
                </p>

                <!-- Botón que dispara la preparación de la base de datos -->
                <form method="POST">
                    <button type="submit" class="btn btn-primary">Crear base de datos</button>
                    <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
