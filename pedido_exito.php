<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Pedido Realizado! | Elite Sneakers</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=140.0">
</head>
<body>

    <?php include 'includes/nav.php'; ?>

    <main class="login-full-screen">
        <div class="elite-card success-compacto">
            
            <div style="background: #2ecc71; width: 70px; height: 70px; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <span style="color: white; font-size: 2.5rem;">✓</span>
            </div>
            
            <h1 class="elite-title">¡PEDIDO CONFIRMADO!</h1>
            
            <p class="elite-subtitle">
                Gracias por tu confianza, <strong><?= $_SESSION['nombre']; ?></strong>.<br>
                Estamos preparando tus zapatillas para que te lleguen lo antes posible.
            </p>

            <div class="tracking-box" style="background: #f8f9fa; border-radius: 15px; border: 2px dashed #eee; padding: 20px;">
                <span style="display: block; color: #888; text-transform: uppercase; font-size: 0.7rem; font-weight: 900; letter-spacing: 1px; margin-bottom: 5px;">
                    Número de seguimiento:
                </span>
                <span style="font-size: 1.4rem; font-weight: 900; color: var(--rojo-oscuro);">
                    #ELITE-<?= rand(10000, 99999); ?>
                </span>
            </div>

            <a href="index.php" class="elite-btn-main" style="display: inline-block; background: #000; width: auto; padding: 15px 40px; margin-top: 20px; font-size: 0.8rem;">
                VOLVER A LA TIENDA
            </a>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>