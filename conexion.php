<?php
// Este archivo centraliza la conexión a la base de datos.
// Todas las páginas del proyecto reutilizan esta conexión para consultar o modificar datos.

// Datos del servidor local de MariaDB/MySQL instalado con XAMPP.
$host = 'localhost';
$db = 'tienda';
$user = 'root';
$pass = '';

try {
    // PDO permite conectarse a MySQL/MariaDB de forma segura y uniforme.
    // Con setAttribute se configuran las reglas de manejo de errores y el formato de lectura.
    $conexionbd = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            // Si ocurre un error en la conexión o en una consulta, se lanza una excepción.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Cada fila se leerá como un array asociativo, por ejemplo: ['id' => 1, 'articulo' => 'Aceite']
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    // Si falla la conexión, se detiene la ejecución y se muestra el detalle del error.
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}
?>