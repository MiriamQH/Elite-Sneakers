<?php
session_start();
require_once '../config/conexion.php';

// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') exit();

$id_pedido = mysqli_real_escape_string($conn, $_GET['id']);

// Consulta SQL optimizada
$sql = "SELECT lp.*, p.nombre as zapatilla, p.imagen 
        FROM lineas_pedido lp
        JOIN productos p ON lp.producto_id = p.id
        WHERE lp.pedido_id = $id_pedido";
$detalle = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido #<?= $id_pedido ?> | Detalle Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=170.0">
</head>
<body style="background: var(--fondo);">

    <?php include '../includes/nav.php'; ?>

    <main class="contenedor-productos" style="margin-top: 40px; display: flex; flex-direction: column; align-items: center; gap: 30px;">
        
        <div style="width: 100%; max-width: 850px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 class="elite-title" style="margin: 0; font-size: 1.5rem;">DETALLE PEDIDO #<?= $id_pedido ?></h1>
                <p style="color: #888; font-size: 0.8rem; font-weight: 700; margin-top: 5px;">Artículos adquiridos por el cliente</p>
            </div>
            
            <a href="admin_pedidos.php" class="btn-volver-panel">
                VOLVER AL LISTADO
            </a>
        </div> 

        <div class="elite-card" style="width: 100%; max-width: 850px; padding: 35px;">
            <div style="margin-top: 10px;">
                <?php while($item = mysqli_fetch_assoc($detalle)): ?>
                <div style="display: flex; align-items: center; border-bottom: 1px solid #f5f5f5; padding: 20px 0;">
                    <div style="background: #fdfdfd; padding: 10px; border-radius: 12px; margin-right: 25px;">
                        <img src="../assets/img/<?= $item['imagen'] ?>" width="70" style="object-fit: contain;">
                    </div>
                    
                    <div style="flex-grow: 1;">
                        <h4 style="font-weight: 900; font-size: 1rem; text-transform: uppercase;"><?= $item['zapatilla'] ?></h4>
                        <p style="color: #888; font-size: 0.8rem; font-weight: 700;">Cantidad: <?= $item['unidades'] ?></p>
                    </div>
                    
                    <div style="font-weight: 900; font-size: 1.1rem; color: var(--negro);">
                        <?= number_format($item['precio_unitario'], 2) ?> €
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #000; text-align: right;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #888; margin-right: 15px;">SUBTOTAL PEDIDO</span>
                <span style="font-size: 1.4rem; font-weight: 900; color: var(--rojo-oscuro);">
                    <?php 
                        // Re-calculamos total si es necesario o lo pasamos por GET
                        mysqli_data_seek($detalle, 0); 
                        $total_pedido = 0;
                        while($row = mysqli_fetch_assoc($detalle)) { $total_pedido += $row['unidades'] * $row['precio_unitario']; }
                        echo number_format($total_pedido, 2);
                    ?> €
                </span>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>