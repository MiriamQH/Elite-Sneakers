<?php
session_start();
require_once '../config/conexion.php';

// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Consulta de pedidos uniendo con el nombre del usuario
$sql = "SELECT p.*, u.nombre as usuario_nombre 
        FROM pedidos p 
        INNER JOIN usuarios u ON p.usuario_id = u.id 
        ORDER BY p.fecha DESC, p.hora DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Pedidos | Elite Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=150.0">
</head>
<body style="background: var(--fondo);">

    <?php include '../includes/nav.php'; ?>

    <main class="contenedor-productos" style="margin-top: 40px; display: flex; flex-direction: column; align-items: center; gap: 30px;">
        
        <div style="width: 100%; max-width: 1200px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                 <h1 class="elite-title" style="margin: 0; font-size: 1.5rem;">PANEL DE PEDIDOS</h1>
                 <p style="color: #888; font-size: 0.8rem; font-weight: 700; margin-top: 5px;">Control total de las ventas de la tienda</p>
            </div>
            
            <a href="index.php" class="btn-volver-panel">
                VOLVER AL PANEL
            </a>
        </div> 

        <div class="elite-card" style="width: 100%; max-width: 1200px; margin: 0; padding: 30px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="border-bottom: 3px solid var(--rojo); text-transform: uppercase;">
                    <tr>
                        <th style="padding: 15px; font-size: 0.8rem; text-align: left;">ID</th>
                        <th style="padding: 15px; font-size: 0.8rem; text-align: left;">Cliente</th>
                        <th style="padding: 15px; font-size: 0.8rem; text-align: left;">Fecha / Hora</th>
                        <th style="padding: 15px; font-size: 0.8rem; text-align: left;">Total</th>
                        <th style="padding: 15px; font-size: 0.8rem; text-align: left;">Estado</th>
                        <th style="padding: 15px; font-size: 0.8rem; text-align: left;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = $resultado->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px; font-weight: 900;">#<?= $fila['id'] ?></td>
                        <td style="padding: 15px; font-weight: 800;"><?= htmlspecialchars($fila['usuario_nombre']) ?></td>
                        <td style="padding: 15px; font-size: 0.85rem; color: #666;">
                            <?= $fila['fecha'] ?><br><small><?= $fila['hora'] ?></small>
                        </td>
                        <td style="padding: 15px; font-weight: 900; color: var(--rojo-oscuro);">
                            <?= number_format($fila['total'], 2) ?> €
                        </td>
                        <td style="padding: 15px;">
                            <span style="background: #e1f5fe; color: #039be5; padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 900; text-transform: uppercase;">
                                <?= $fila['estado'] ?>
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <a href="detalle_pedido.php?id=<?= $fila['id'] ?>" class="btn-quitar" style="background: #eee; color: #333; font-size: 0.65rem; padding: 8px 15px; text-decoration: none; border-radius: 8px;">
                                VER DETALLE
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>
</html>