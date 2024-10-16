<?php
$host = 'localhost';
$db = 'tienda';
$user = 'root';
$pass = '';

try {
    $conexionbd = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conexionbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
/*PDO (PHP Data Objects) es una extensión de PHP que proporciona una interfaz uniforme 
 para conectarse y trabajar con diferentes sistemas de gestión de bases de datos (DBMS)*/
?>