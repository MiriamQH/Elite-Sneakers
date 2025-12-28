<?php
session_start();
require_once 'config/conexion.php';

// Seguridad: Si no está logueado, al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consultamos solo los pedidos del usuario actual
$sql = "SELECT * FROM pedidos WHERE usuario_id = '$usuario_id' ORDER BY fecha DESC, hora DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos | Elite Sneakers</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=200.0">
</head>
<body style="background: var(--fondo);">

    <?php include 'includes/nav.php'; ?>

    <main class="contenedor-productos" style="margin-top: 40px; display: flex; flex-direction: column; align-items: center; gap: 30px;">
        
        <div style="width: 100%; max-width: 1100px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 class="elite-title" style="margin: 0; font-size: 1.5rem;">MIS COMPRAS</h1>
                <p style="color: #888; font-size: 0.8rem; font-weight: 700; margin-top: 5px;">Bienvenido de nuevo, <?= $_SESSION['nombre'] ?></p>
            </div>
            <a href="index.php" class="btn-volver-panel">VOLVER A LA TIENDA</a>
        </div>

        <div class="elite-card" style="width: 100%; max-width: 1100px; padding: 30px;">
            <?php if ($resultado->num_rows > 0): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="border-bottom: 2px solid #000; text-transform: uppercase;">
                        <tr>
                            <th style="padding: 15px; font-size: 0.75rem; text-align: left;">Pedido</th>
                            <th style="padding: 15px; font-size: 0.75rem; text-align: left;">Fecha</th>
                            <th style="padding: 15px; font-size: 0.75rem; text-align: right;">Total</th>
                            <th style="padding: 15px; font-size: 0.75rem; text-align: center;">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($fila = $resultado->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid #f5f5f5;">
                            <td style="padding: 15px; font-weight: 900;">#<?= $fila['id'] ?></td>
                            <td style="padding: 15px; color: #666; font-size: 0.85rem;"><?= $fila['fecha'] ?></td>
                            <td style="padding: 15px; text-align: right; font-weight: 900; color: var(--rojo-oscuro);">
                                <?= number_format($fila['total'], 2) ?> €
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 15px; border-radius: 20px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase;">
                                    <?= $fila['estado'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div style="text-align: center; padding: 40px;">
                    <p style="color: #888; font-weight: 700;">Aún no has realizado ninguna compra.</p>
                    <a href="index.php" style="color: var(--rojo); font-weight: 900; text-decoration: none;">¡Empieza a comprar ahora!</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>