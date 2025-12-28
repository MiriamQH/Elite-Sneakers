<?php
session_start();
require_once 'config/conexion.php';
$id = mysqli_real_escape_string($conn, $_GET['id'] ?? '');
$res = mysqli_query($conn, "SELECT * FROM productos WHERE id = '$id'");
$prod = mysqli_fetch_assoc($res);
if (!$prod) { header("Location: index.php"); exit(); }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($prod['nombre']) ?> | Elite Sneakers</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=90.0">
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <main class="contenedor-productos" style="margin-top: 40px; margin-bottom: 60px;">
        <div class="elite-card" style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; padding: 40px; max-width: 850px; margin: 0 auto; text-align: left; border-radius: 30px;">
            
            <div style="background: #fdfdfd; border-radius: 20px; display: flex; align-items: center; justify-content: center; padding: 20px;">
                <img src="assets/img/<?= $prod['imagen'] ?>" style="max-width: 100%; height: auto; object-fit: contain;">
            </div>

            <div style="display: flex; flex-direction: column; justify-content: center;">
                <h1 style="font-weight: 900; font-size: 2rem; text-transform: uppercase; line-height: 1.1; margin-bottom: 15px;">
                    <?= htmlspecialchars($prod['nombre']) ?>
                </h1>
                
                <p style="color: var(--rojo); font-weight: 900; font-size: 1.5rem; margin-bottom: 20px;">
                    <?= number_format($prod['precio'], 2) ?> €
                </p>
                
                <p style="color: #666; font-size: 0.9rem; line-height: 1.5; margin-bottom: 25px;">
                    <?= htmlspecialchars($prod['descripcion']) ?>
                </p>

                <form action="funciones/agregar_carrito.php" method="POST" style="display: flex; gap: 15px; align-items: center;">
                    <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                    <input type="number" name="cantidad" value="1" min="1" max="<?= $prod['stock'] ?>" style="width: 70px;">
                    
                    <button type="submit" class="elite-btn-main" style="flex: 1; padding: 18px; margin: 0; background: #000; border-radius: 12px; font-size: 0.9rem;">
                        AÑADIR AL CARRITO
                    </button>
                </form>

                <a href="index.php" style="margin-top: 25px; display: inline-block; color: #aaa; font-size: 0.8rem; font-weight: 700;">
                    ← Volver al catálogo
                </a>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>