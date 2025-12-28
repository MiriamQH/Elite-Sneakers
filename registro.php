<?php
session_start();
require_once 'config/conexion.php';

// Si ya está logueado, redirigir al catálogo
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Únete a la Élite | Registro</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=17.0">
</head>
<body>

    <?php include 'includes/nav.php'; ?>

    <main class="login-full-screen">
        <div class="elite-card login-compacto">
            <h1 class="elite-title">ÚNETE A LA ÉLITE</h1>
            <p class="elite-subtitle">Crea tu cuenta oficial y accede a lanzamientos exclusivos</p>

            <form action="funciones/procesar_registro.php" method="POST" class="elite-form">
                <div class="elite-input-group">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre" required placeholder="Tu nombre y apellidos">
                </div>

                <div class="elite-input-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" required placeholder="tu@email.com">
                </div>

                <div class="elite-input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>

                <button type="submit" class="elite-btn-main">CREAR CUENTA</button>
           </form>
            <p class="form-footer">
                 ¿Ya eres miembro? <a href="login.php">Inicia sesión aquí</a>
            </p>
        </div> </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>