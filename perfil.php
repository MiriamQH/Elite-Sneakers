<?php
session_start();
require_once 'config/conexion.php';

// Seguridad: Si no hay sesión, al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Consultamos los datos actuales por si han cambiado
$query = mysqli_query($conn, "SELECT nombre, email, rol FROM usuarios WHERE id = '$id_usuario'");
$usuario = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil | Elite Sneakers</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=350.0">
</head>
<body style="background: var(--fondo);">

    <?php include 'includes/nav.php'; ?>

    <main class="contenedor-productos" style="margin-top: 40px; display: flex; flex-direction: column; align-items: center; gap: 30px;">
        
        <div style="width: 100%; max-width: 800px;">
            <h1 class="elite-title" style="font-size: 1.5rem; margin: 0;">MI PERFIL</h1>
            <p style="color: #888; font-size: 0.8rem; font-weight: 700; margin-top: 5px;">Gestiona tu cuenta y revisa tu actividad</p>
        </div>

        <div class="elite-card" style="width: 100%; max-width: 800px; padding: 40px; display: flex; align-items: center; gap: 40px;">
            <div style="background: #000; color: #fff; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 900;">
                <?= substr($usuario['nombre'], 0, 1) ?>
            </div>

            <div style="flex-grow: 1;">
                <h2 style="font-size: 1.2rem; font-weight: 900; margin-bottom: 5px; text-transform: uppercase;">
                    <?= htmlspecialchars($usuario['nombre']) ?>
                </h2>
                <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;"><?= htmlspecialchars($usuario['email']) ?></p>
                
                <span style="background: #eee; padding: 5px 12px; border-radius: 50px; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;">
                    Miembro Elite desde 2025
                </span>
            </div>
        </div>

        <div style="width: 100%; max-width: 800px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <a href="mis_pedidos.php" class="btn-volver-panel" style="text-align: center; padding: 25px; font-size: 0.9rem;">
                VER MIS COMPRAS
            </a>
            <a href="logout.php" class="btn-volver-panel" style="text-align: center; padding: 25px; font-size: 0.9rem; background: var(--rojo) !important;">
                CERRAR SESIÓN
            </a>
        </div>

    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>