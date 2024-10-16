<?php
include 'conexion.php';
include 'index.php';

// Obtener todos los productos
$consulta = $conexionbd->query("SELECT * FROM productos");/*esta es la consulta SQL */
$productos = $consulta->fetchAll();/*  devuelve un array con todas las filas resultantes de la consulta*/
?>
<head> <link href="styles.css" rel="stylesheet" type="text/css"> </head>
<h1>Lista de Productos</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Artículo</th>
        <th>Descripción</th>
        <th>Unidades Disponibles</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($productos as $producto): 
        /* foreach es una estructura de control en PHP que se utiliza para 
iterar sobre arrays y objetos. 
Es especialmente útil cuando quieres recorrer todos los elementos de un array sin tener que preocuparte por los índices*/
        ?>
    <tr>
        <td><?= $producto['id'] ?></td>
        <td><?= $producto['articulo'] ?></td>
        <td><?= $producto['descripcion'] ?></td>
        <td><?= $producto['unidades_disponibles'] ?></td>
        <td>
            <form method="POST" action="eliminar.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <form method="POST" action="modificar.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                <button type="submit" class="btn btn-warning">Modificar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>