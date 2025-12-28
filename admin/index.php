<?php
/**
 * Capa de Lógica de Negocio: Panel de Control Administrativo
 * Verifica el estado de la sesión y roles antes de mostrar el contenido
 */

// Incluimos la conexión que ya gestiona el session_start() de forma centralizada
require_once '../config/conexion.php';

// SEGURIDAD: Solo el rol 'admin' tiene acceso a esta zona
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin'){
    // Si no es admin, redirigimos a la raíz pública 
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control | Elite Sneakers</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=28.0">
</head>
<body style="background-color: var(--fondo);">

    <main class="login-full-screen" style="flex-direction: column; gap: 40px; padding: 40px 20px;">
        <div style="text-align: center;">
            <h1 class="elite-title">CENTRAL DE MANDO</h1>
            <p class="elite-subtitle">Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong>. Gestiona tu tienda desde aquí.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; max-width: 1100px; width: 100%;">
            
            <a href="gestion_productos.php" class="elite-card" style="padding: 40px; text-decoration: none; color: inherit; transition: 0.3s; display: flex; flex-direction: column; align-items: center;">
                <div style="font-size: 3.5rem; margin-bottom: 20px;">👟</div>
                <h3 style="font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">Productos</h3>
                <p style="font-size: 0.9rem; color: #666; text-align: center;">Añadir, editar o eliminar zapatillas del catálogo.</p>
            </a>

            <a href="admin_pedidos.php" class="elite-card" style="padding: 40px; text-decoration: none; color: inherit; transition: 0.3s; display: flex; flex-direction: column; align-items: center;">
                <div style="font-size: 3.5rem; margin-bottom: 20px;">📦</div>
                <h3 style="font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">Pedidos</h3>
                <p style="font-size: 0.9rem; color: #666; text-align: center;">Controlar las ventas y ver detalles de los pedidos.</p>
            </a>

            <a href="gestion_usuarios.php" class="elite-card" style="padding: 40px; text-decoration: none; color: inherit; transition: 0.3s; display: flex; flex-direction: column; align-items: center;">
                <div style="font-size: 3.5rem; margin-bottom: 20px;">👥</div>
                <h3 style="font-weight: 900; margin-bottom: 10px; text-transform: uppercase;">Usuarios</h3>
                <p style="font-size: 0.9rem; color: #666; text-align: center;">Administrar cuentas de clientes y personal.</p>
            </a>

        </div>

        <div style="display: flex; gap: 20px;">
            <a href="../index.php" class="boton-carrito" style="background: var(--negro);">VER TIENDA</a>
            <a href="../logout.php" class="boton-carrito" onclick="return confirm('¿Cerrar sesión administrativa?')">SALIR DEL PANEL</a>
        </div>
    </main>

</body>
</html>