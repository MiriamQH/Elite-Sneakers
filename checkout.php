<?php
session_start();
require_once 'config/conexion.php';

// 1. Seguridad: Comprobar que el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Comprobar que el carrito no esté vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: index.php");
    exit();
}

// 3. Cálculo del total de la compra
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra | Elite Sneakers</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=300.0">
</head>
<body style="background: var(--fondo);">

    <?php include 'includes/nav.php'; ?>

    <main class="contenedor-productos" style="margin-top: 40px; display: flex; flex-direction: column; align-items: center;">
        
        <div style="width: 100%; max-width: 950px; margin-bottom: 30px;">
            <h1 class="elite-title" style="font-size: 1.5rem; margin: 0;">FINALIZAR COMPRA</h1>
            <p style="color: #888; font-size: 0.8rem; font-weight: 700; margin-top: 5px;">Estás comprando como: <?= $_SESSION['nombre'] ?></p>
        </div>

        <form action="funciones/hacer_pedido.php" method="POST" style="width: 100%; max-width: 950px; display: grid; grid-template-columns: 1.6fr 1fr; gap: 30px;">
            
            <div class="elite-card" style="padding: 35px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="elite-input-group" style="grid-column: span 2;">
                        <label>DIRECCIÓN DE ENTREGA</label>
                        <input type="text" name="direccion" required placeholder="Avenida, calle, número, piso...">
                    </div>
                    
                    <div class="elite-input-group">
                        <label>PROVINCIA / CIUDAD</label>
                        <input type="text" name="provincia" required placeholder="Ej: Sevilla">
                    </div>
                    
                    <div class="elite-input-group">
                        <label>CÓDIGO POSTAL</label>
                        <input type="text" name="cp" required placeholder="41001">
                    </div>

                    <div class="elite-input-group" style="grid-column: span 2;">
                        <label>TELÉFONO DE CONTACTO</label>
                        <input type="tel" name="telefono" required placeholder="600 000 000">
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                
                <div class="elite-card" style="padding: 25px; background: #000; color: #fff; border-radius: 20px;">
                    <h3 style="font-size: 0.8rem; letter-spacing: 1.5px; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 15px; text-transform: uppercase; text-align: center;">Resumen</h3>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 800; font-size: 0.85rem; color: #888;">TOTAL A PAGAR</span>
                        <span style="font-size: 1.6rem; font-weight: 900; color: #fff;"><?= number_format($total, 2) ?> €</span>
                    </div>

                    <input type="hidden" name="coste" value="<?= $total ?>">
                </div>

                <button type="submit" class="elite-btn-main" style="background: var(--rojo) !important; color: #fff !important; width: 100%; padding: 25px; border-radius: 20px; font-size: 1.1rem; border: none; box-shadow: 0 10px 25px rgba(224, 30, 55, 0.3); cursor: pointer; transition: 0.3s ease; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;">
                    CONFIRMAR PEDIDO
                </button>

                <a href="carrito.php" style="text-align: center; color: #888; font-size: 0.75rem; text-decoration: none; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                    ← Volver al carrito
                </a>
            </div>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>