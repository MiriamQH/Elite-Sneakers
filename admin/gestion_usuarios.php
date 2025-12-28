<?php
// Capa de Lógica de Negocio: Control de sesiones 
session_start();
require_once '../config/conexion.php';

// Verificación de rango administrativo 
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Capa de Acceso a Datos: Recuperación de la información de la BD 
$resultado = $conn->query("SELECT id, nombre, apellidos, email, rol FROM usuarios ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes | Elite Sneakers</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=26.0">
</head>
<body>
    <div class="container" style="padding: 50px 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h1 class="elite-title" style="font-size: 2.5rem; margin: 0;">GESTIÓN DE USUARIOS</h1>
            <a href="index.php" class="boton-carrito" style="background: var(--negro);">VOLVER AL PANEL</a>
        </div>

        <div class="elite-card" style="max-width: 1200px; margin: 0 auto; padding: 40px;">
            <a href="usuario_form.php" class="boton-carrito" style="display: inline-block; margin-bottom: 30px;">+ NUEVO USUARIO / ADMIN</a>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="border-bottom: 3px solid var(--rojo); text-transform: uppercase; font-weight: 900; font-size: 0.85rem;">
                    <tr>
                        <th style="padding: 15px;">ID</th>
                        <th style="padding: 15px;">Nombre Completo</th>
                        <th style="padding: 15px;">Email</th>
                        <th style="padding: 15px;">Rol</th>
                        <th style="padding: 15px; text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = $resultado->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px; font-weight: 700;">#<?= $user['id'] ?></td>
                        <td style="padding: 15px; font-weight: 800;"><?= htmlspecialchars($user['nombre'] . " " . $user['apellidos']) ?></td>
                        <td style="padding: 15px;"><?= htmlspecialchars($user['email']) ?></td>
                        <td style="padding: 15px;">
                            <span style="color: <?= $user['rol'] == 'admin' ? 'var(--rojo)' : '#555' ?>; font-weight: 900; text-transform: uppercase; font-size: 0.75rem;">
                                <?= $user['rol'] ?>
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="usuario_form.php?id=<?= $user['id'] ?>" style="color: var(--negro); font-weight: 800; margin-right: 15px; text-decoration: underline;">EDITAR</a>
                            <a href="usuario_eliminar.php?id=<?= $user['id'] ?>" style="color: var(--rojo); font-weight: 800; text-decoration: underline;" onclick="return confirm('¿Seguro que quieres eliminar a este usuario?')">ELIMINAR</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>