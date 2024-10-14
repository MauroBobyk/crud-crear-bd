<?php
include 'conexion.php';
include 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch();

    if (!$producto) {
        echo "Producto no encontrado.";
        exit;
    }

    if (isset($_POST['actualizar'])) {
        $articulo = $_POST['articulo'];
        $descripcion = $_POST['descripcion'];
        $unidades = $_POST['unidades_disponibles'];

        $stmt = $pdo->prepare("UPDATE productos SET articulo = ?, descripcion = ?, unidades_disponibles = ? WHERE id = ?");
        $stmt->execute([$articulo, $descripcion, $unidades, $id]);

        echo "Producto actualizado con éxito.";
        header("Location: ver.php");
        exit;
    }
} else {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch();
}
?>

<h1>Modificar Producto</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
    <label>Artículo:</label>
    <input type="text" name="articulo" value="<?= $producto['articulo'] ?>" required>
    <label>Descripción:</label>
    <textarea name="descripcion" required><?= $producto['descripcion'] ?></textarea>
    <label>Unidades Disponibles:</label>
    <input type="number" name="unidades_disponibles" value="<?= $producto['unidades_disponibles'] ?>" required>
    <button type="submit" name="actualizar">Actualizar</button>
</form>