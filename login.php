<?php
/**
 * CAPA CLIENTE / PRESENTACIÓN
 * Formulario de acceso para usuarios registrados.
 */
session_start();

//  Si ya hay una sesión activa, redirigimos al catálogo directamente 
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

// Gestión de mensajes de error o éxito que vienen por la URL (GET)
$error_msg = "";
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'credenciales') $error_msg = "Contraseña incorrecta";
    if ($_GET['error'] == 'no_existe') $error_msg = "El usuario no existe";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Access | Login</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=131.0">
</head>
<body>

    <?php include 'includes/nav.php'; ?>

    <main class="login-full-screen">
        <div class="elite-card login-compacto">
            <h1 class="elite-title">ELITE ACCESS</h1>
            <p class="elite-subtitle">Ingresa tus credenciales para continuar</p>
            
            <?php if (isset($_GET['registro']) && $_GET['registro'] == 'exito'): ?>
                <div class="elite-alert-success">
                    ¡Registro completado! Ya puedes iniciar sesión con tu cuenta oficial.
                </div>
            <?php endif; ?>

            <?php if($error_msg): ?>
                <div class="error-msg-elite" style="color: var(--rojo); font-weight: 800; margin-bottom: 20px; font-size: 0.8rem;">
                    ⚠️ <?= $error_msg ?>
                </div>
            <?php endif; ?>

            <form action="funciones/procesar_login.php" method="POST" class="elite-form">
                <div class="elite-input-group">
                    <label>CORREO ELECTRÓNICO</label>
                    <input type="email" name="email" required placeholder="tu@email.com">
                </div>

                <div class="elite-input-group">
                    <label>CONTRASEÑA</label>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>

                <button type="submit" class="elite-btn-main" style="background: #000;">INICIAR SESIÓN</button>
            </form>
            
            <div class="elite-footer-link" style="margin-top: 25px; font-size: 0.8rem; font-weight: 700; color: #888;">
                ¿Nuevo en la comunidad? <a href="registro.php" style="color: var(--rojo); text-decoration: none;">Crea una cuenta</a>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>