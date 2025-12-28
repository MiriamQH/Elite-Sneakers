<?php
// Capa de Acceso a Datos: Consulta MySQL mediante objeto $conn 
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$resultado = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Zapatillas | Elite Sneakers</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=25.0">
</head>
<body>
    <div class="container" style="padding: 50px 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h1 class="elite-title" style="font-size: 2.5rem; margin: 0;">GESTIÓN DE PRODUCTOS</h1>
            <a href="index.php" class="boton-carrito" style="background: var(--negro);">VOLVER AL PANEL</a>
        </div>

        <div class="elite-card" style="max-width: 1200px; margin: 0 auto; padding: 40px;">
            <a href="producto_form.php" class="boton-carrito" style="display: inline-block; margin-bottom: 30px;">+ NUEVA ZAPATILLA</a>
            
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="border-bottom: 3px solid var(--rojo); text-transform: uppercase; font-weight: 900;">
                    <tr>
                        <th style="padding: 15px;">Imagen</th>
                        <th style="padding: 15px;">Modelo</th>
                        <th style="padding: 15px;">Precio</th>
                        <th style="padding: 15px;">Stock</th>
                        <th style="padding: 15px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = $resultado->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">
                            <img src="../assets/img/<?= $fila['imagen'] ?>" style="width: 80px; border-radius: 10px;">
                        </td>
                        <td style="padding: 15px; font-weight: 800;"><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td style="padding: 15px; font-weight: 800;"><?= number_format($fila['precio'], 2) ?> €</td>
                        <td style="padding: 15px; font-weight: 900; color: <?= ($fila['stock'] < 5) ? 'var(--rojo)' : 'inherit' ?>;">
                            <?= $fila['stock'] ?>
                        </td>
                        <td style="padding: 15px;">
                            <a href="producto_form.php?id=<?= $fila['id'] ?>" style="color: var(--negro); font-weight: 800; margin-right: 15px;">EDITAR</a>
                            <a href="producto_eliminar.php?id=<?= $fila['id'] ?>" style="color: var(--rojo); font-weight: 800;" onclick="return confirm('¿Borrar producto?')">BORRAR</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>