<?php
session_start();
require_once '../config/conexion.php';

// Seguridad: Solo el administrador puede procesar estos datos 
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$id = ""; $nombre = ""; $apellidos = ""; $email = ""; $rol = "cliente"; $telefono = ""; $direccion = "";
$es_edicion = false;

// Si existe ID, cargamos los datos del usuario para Modificar 
if (isset($_GET['id'])) {
    $es_edicion = true;
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();
    
    if ($usuario) {
        extract($usuario); // Rellena las variables automáticamente
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $es_edicion ? 'Editar' : 'Nuevo' ?> Usuario | Elite Sneakers</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=26.0">
</head>
<body style="background: var(--fondo);">

    <main class="login-full-screen" style="padding: 60px 20px;">
        <div class="elite-card" style="max-width: 650px;">
            <h1 class="elite-title" style="font-size: 2.8rem;"><?= $es_edicion ? 'EDITAR' : 'CREAR' ?> USUARIO</h1>
            <p class="elite-subtitle">Gestiona los permisos y datos de contacto de la comunidad</p>

            <form action="procesar_usuario.php" method="POST" class="elite-form">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="accion" value="<?= $es_edicion ? 'editar' : 'crear' ?>">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="elite-input-group">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
                    </div>
                    <div class="elite-input-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" value="<?= htmlspecialchars($apellidos) ?>">
                    </div>
                </div>

                <div class="elite-input-group">
                    <label>Correo Electrónico *</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="elite-input-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" value="<?= htmlspecialchars($telefono) ?>">
                    </div>
                    <div class="elite-input-group">
                        <label>Rol de Usuario</label>
                        <select name="rol" style="width: 100%; padding: 18px; border-radius: 15px; border: 3px solid #eee; font-family: inherit; font-weight: 700;">
                            <option value="cliente" <?= $rol == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                            <option value="admin" <?= $rol == 'admin' ? 'selected' : '' ?>>Administrador</option>
                        </select>
                    </div>
                </div>

                <div class="elite-input-group">
                    <label>Contraseña <?= $es_edicion ? '(Opcional)' : '*' ?></label>
                    <input type="password" name="password" placeholder="<?= $es_edicion ? 'Dejar en blanco para no cambiar' : 'Mínimo 8 caracteres' ?>" <?= $es_edicion ? '' : 'required' ?>>
                </div>

                <button type="submit" class="elite-btn-main"><?= $es_edicion ? 'ACTUALIZAR DATOS' : 'REGISTRAR USUARIO' ?></button>
                <a href="gestion_usuarios.php" style="display: block; margin-top: 20px; text-decoration: none; color: #888; font-weight: 700;">CANCELAR Y VOLVER</a>
            </form>
        </div>
    </main>

</body>
</html>