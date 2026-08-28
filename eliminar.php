<?php
// Este archivo corresponde a la operación DELETE del CRUD.
// Se encarga de borrar un producto según el id recibido desde la vista de listado.

// Se incluye la conexión para poder ejecutar la sentencia DELETE.
include 'conexion.php';

// Si alguien intenta acceder a esta página sin enviar un formulario POST, se redirige.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ver.php');
    exit;
}

// Se recibe el id del producto que se quiere borrar desde el formulario oculto.
$id = $_POST['id'] ?? null;

// Se valida que el id sea correcto antes de continuar.
if ($id !== null && is_numeric($id)) {
    // Se prepara la sentencia SQL para borrar el registro que coincida con ese id.
    $consulta = $conexionbd->prepare("DELETE FROM productos WHERE id = ?");

    // Se ejecuta la eliminación con el valor real del id.
    $consulta->execute([$id]);
}

// Una vez eliminado, se devuelve al usuario a la vista con la lista actualizada.
header('Location: ver.php');
exit;
?>