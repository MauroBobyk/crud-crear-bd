<?php
include 'conexion.php';
include 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$id]);

    echo "Producto eliminado con éxito.";
}

header("Location: ver.php");
exit;
?>