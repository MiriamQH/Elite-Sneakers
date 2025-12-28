<?php
session_start();
require_once 'config/conexion.php';
$total = 0;
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) { $total += $item['precio'] * $item['cantidad']; }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cesta | Elite Sneakers</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=250.0">
</head>
<body style="background: var(--fondo);">

<?php include 'includes/nav.php'; ?>

<main class="contenedor-productos" style="margin-top: 30px;">
    <h1 class="elite-title" style="font-size: 1.5rem; margin-bottom: 25px; text-align: left;">
    TU CARRITO
    </h1>

    <div class="cart-container">
        <section class="cart-list">
            <?php if(!empty($_SESSION['carrito'])): ?>
                <?php foreach($_SESSION['carrito'] as $indice => $item): ?>
                <div class="cart-item">
                    <img src="assets/img/<?= $item['imagen'] ?>" style="width: 70px; border-radius: 8px;">
                    
                    <div style="flex: 1; padding-left: 20px;">
                        <h3 style="font-size: 1rem; font-weight: 900;"><?= htmlspecialchars($item['nombre']) ?></h3>
                        <p style="color: #888; font-size: 0.8rem;">Cant: <?= $item['cantidad'] ?> x <?= number_format($item['precio'], 2) ?>€</p>
                    </div>
                    
                    <div style="text-align: right;">
                        <p style="font-weight: 900; font-size: 1rem; margin-bottom: 5px;">
                            <?= number_format($item['precio'] * $item['cantidad'], 2) ?> €
                        </p>
                        <a href="funciones/vaciar_carrito.php?indice=<?= $indice ?>" class="btn-quitar" style="padding: 5px 10px; font-size: 0.6rem;">ELIMINAR</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 50px 0;">
                    <p style="color: #888; font-weight: 700;">Tu cesta está vacía.</p>
                    <a href="index.php" style="color: var(--rojo); font-weight: 900; text-decoration: none; font-size: 0.8rem;">EXPLORAR CATÁLOGO</a>
                </div>
            <?php endif; ?>
        </section>

        <aside class="cart-summary">
            <h2 style="margin-bottom: 20px; border-bottom: 1px solid #222; padding-bottom: 10px; font-size: 0.9rem; letter-spacing: 1px;">RESUMEN</h2>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                <span style="font-weight: 800; font-size: 0.8rem; opacity: 0.7;">TOTAL COMPRA</span>
                <span class="total-price-text" style="font-size: 1.5rem;"><?= number_format($total, 2) ?> €</span>
            </div>
            
            <div style="margin-top: 35px;">
                <?php if($total > 0): ?>
                    <a href="checkout.php" class="elite-btn-main" style="display: block; text-align: center; text-decoration: none; background: #000; color: #fff; padding: 18px; border-radius: 50px; font-weight: 900; font-size: 0.85rem; letter-spacing: 1px; transition: 0.3s;">
                        CONTINUAR AL ENVÍO
                    </a>
                <?php endif; ?>
                
                <a href="index.php" style="display: block; text-align: center; margin-top: 20px; color: #888; font-size: 0.7rem; text-decoration: none; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                    ← Seguir comprando
                </a>
            </div>
        </aside>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>