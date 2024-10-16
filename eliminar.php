<?php
include 'conexion.php';
include 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $consulta = $conexionbd->prepare("DELETE FROM productos WHERE id = ?");
    $consulta->execute([$id]);/**ejecutamos la consulta mediante el ID del producto para no borrar toda la tabla*/

    echo "Producto eliminado con éxito.";
}

header("Location: ver.php");
exit;
?>