<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Incluir archivo principal (probablemente con configuraciones o cabecera)
include 'index.php';

// Consulta SQL para obtener todos los productos de la tabla
$consulta = $conexionbd->query("SELECT * FROM productos");

// Obtener todos los resultados de la consulta como array asociativo
$productos = $consulta->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Enlazar hoja de estilos CSS para el diseño -->
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Título principal de la página -->
    <h1>Lista de Productos</h1>
    
    <!-- Tabla para mostrar los productos -->
    <table border="1">
        <!-- Fila de encabezados de la tabla -->
        <tr>
            <th>ID</th>                    <!-- Encabezado columna ID -->
            <th>Artículo</th>              <!-- Encabezado columna nombre del artículo -->
            <th>Descripción</th>           <!-- Encabezado columna descripción -->
            <th>Unidades Disponibles</th>  <!-- Encabezado columna stock disponible -->
            <th>Acciones</th>              <!-- Encabezado columna para botones de acciones -->
        </tr>
        
        <?php 
        // Iniciar bucle para recorrer cada producto en el array
        foreach ($productos as $producto): 
        ?>
        <!-- Fila de tabla para cada producto -->
        <tr>
            <!-- Celda con el ID del producto -->
            <td><?= $producto['id'] ?></td>
            
            <!-- Celda con el nombre del artículo -->
            <td><?= $producto['articulo'] ?></td>
            
            <!-- Celda con la descripción del producto -->
            <td><?= $producto['descripcion'] ?></td>
            
            <!-- Celda con las unidades disponibles en stock -->
            <td><?= $producto['unidades_disponibles'] ?></td>
            
            <!-- Celda que contiene los botones de acciones -->
            <td>
                <!-- Formulario para eliminar producto (estilo en línea) -->
                <form method="POST" action="eliminar.php" style="display:inline;">
                    <!-- Campo oculto que envía el ID del producto a eliminar -->
                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                    <!-- Botón para enviar formulario de eliminación -->
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                
                <!-- Formulario para modificar producto (estilo en línea) -->
                <form method="POST" action="modificar.php" style="display:inline;">
                    <!-- Campo oculto que envía el ID del producto a modificar -->
                    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                    <!-- Botón para enviar formulario de modificación -->
                    <button type="submit" class="btn btn-warning">Modificar</button>
                </form>
            </td>
        </tr>
        <?php 
        // Finalizar el bucle foreach
        endforeach; 
        ?>
    </table>
    <!-- Cierre de la tabla -->
</body>
</html>
