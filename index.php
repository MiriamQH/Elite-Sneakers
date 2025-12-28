<?php
session_start();
require_once 'config/conexion.php';
$resultado = mysqli_query($conn, "SELECT * FROM productos WHERE stock > 0 ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Elite Sneakers | Catálogo Premium</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=80.0">
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alerta-exito"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>

    <header style="background: var(--negro); padding: 40px 20px; text-align: center; border-bottom: 5px solid var(--rojo);">
        <h1 class="elite-title" style="color: white; font-size: 2.2rem; margin: 0; letter-spacing: 1px;">
        PRODUCTOS DESTACADOS
        </h1>
        <div style="width: 60px; height: 3px; background: var(--rojo); margin: 15px auto 0;"></div>
    </header>

    <main class="contenedor-productos">
        <div class="productos-grid">
            <?php while($prod = mysqli_fetch_assoc($resultado)): ?>
                <div class="producto-card">
                    <div class="producto-imagen-wrapper">
                        <img src="assets/img/<?= $prod['imagen'] ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                        <?php if($prod['stock'] <= 5): ?>
                            <span class="badge-stock">¡ÚLTIMAS UNIDADES!</span>
                        <?php endif; ?>
                    </div>
                    <div class="producto-info">
                        <h3><?= htmlspecialchars($prod['nombre']) ?></h3>
                        <p class="producto-precio">Precio: <?= number_format($prod['precio'], 2) ?>€</p>
                        <a href="producto.php?id=<?= $prod['id'] ?>" class="btn-ver-mas" style="display: block;">Ver más</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>