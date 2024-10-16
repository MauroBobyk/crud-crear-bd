<?php
include 'conexion.php';
include 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $articulo = $_POST['articulo'];
    $descripcion = $_POST['descripcion'];
    $unidades = $_POST['unidades_disponibles'];

    $consulta = $conexionbd->prepare("INSERT INTO productos (articulo, descripcion, unidades_disponibles) VALUES (?, ?, ?)");/*los ? es debido a evitar inyeccion SQL y ademas le pasamos parametros */
    $consulta->execute([$articulo, $descripcion, $unidades]);

    echo "Producto creado con éxito.";
}
?>
<link href="styles.css" rel="stylesheet" type="text/css"> 
<h1>Crear Producto</h1>
<form method="POST">
    <label>Artículo:</label>
    <input type="text" name="articulo" required>
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>
    <label>Unidades Disponibles:</label>
    <input type="number" name="unidades_disponibles" required>
    <button type="submit" class="btn btn-outline-success">Crear</button>
</form>