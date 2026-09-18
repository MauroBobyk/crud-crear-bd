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
