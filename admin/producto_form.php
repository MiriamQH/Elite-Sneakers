<?php
session_start();
require_once '../config/conexion.php';

// SEGURIDAD UNIFICADA: Usamos lo que funciona en gestion_productos.php
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$id = ""; $nombre = ""; $descripcion = ""; $precio = ""; $stock = ""; $imagen = "";
$es_edicion = false;

// 1. CARGAR DATOS (GET)
if (isset($_GET['id'])) {
    $es_edicion = true;
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $res = $conn->query("SELECT * FROM productos WHERE id = '$id'");
    $producto = $res->fetch_assoc();
    if ($producto) {
        $nombre = $producto['nombre'];
        $descripcion = $producto['descripcion'];
        $precio = $producto['precio'];
        $stock = $producto['stock'];
        $imagen = $producto['imagen'];
    }
}

// 2. GUARDAR DATOS (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $nombre_imagen = $_POST['imagen_actual']; 

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nombre_archivo = time() . "_" . basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/" . $nombre_archivo)) {
            $nombre_imagen = $nombre_archivo;
        }
    }

    if ($_POST['accion'] == 'crear') {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen) VALUES ('$nombre', '$descripcion', $precio, $stock, '$nombre_imagen')";
    } else {
        $id_edit = $_POST['id'];
        $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio=$precio, stock=$stock, imagen='$nombre_imagen' WHERE id=$id_edit";
    }

    if ($conn->query($sql)) {
        header("Location: gestion_productos.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $es_edicion ? 'Editar' : 'Nueva' ?> Zapatilla</title>
    <link rel="stylesheet" href="../assets/css/styles.css?v=110.0">
</head>
<body style="background: var(--fondo);">
    <main class="login-full-screen" style="padding: 40px 20px;">
        <div class="elite-card" style="max-width: 850px; text-align: left; padding: 40px;">
            <h1 class="elite-title" style="font-size: 2rem; margin-bottom: 30px;"><?= $es_edicion ? 'EDITAR MODELO' : 'NUEVO MODELO' ?></h1>
            
            <form action="producto_form.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="accion" value="<?= $es_edicion ? 'editar' : 'crear'; ?>">
                <input type="hidden" name="imagen_actual" value="<?= $imagen; ?>">

                <div class="elite-input-group">
                    <label>Nombre de la Zapatilla</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($nombre); ?>" required>
                </div>

                <div class="elite-input-group">
                    <label>Descripción Técnica</label>
                    <textarea name="descripcion" rows="3" style="width: 100%; padding: 15px; border: 3px solid #eee; border-radius: 18px; font-family: inherit;"><?= htmlspecialchars($descripcion); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="elite-input-group">
                        <label>Precio (€)</label>
                        <input type="number" step="0.01" name="precio" value="<?= $precio; ?>" required>
                    </div>
                    <div class="elite-input-group">
                        <label>Stock Disponible</label>
                        <input type="number" name="stock" value="<?= $stock; ?>" required>
                    </div>
                </div>

                <div class="elite-input-group">
                    <label>Imagen del Producto</label>
                    <?php if($es_edicion && $imagen): ?>
                        <img src="../assets/img/<?= $imagen; ?>" width="60" style="border-radius: 8px; margin-bottom: 10px; display: block;">
                    <?php endif; ?>
                    <input type="file" name="foto" accept="image/*" style="border: none; padding: 10px 0;">
                </div>

                <div style="display: flex; gap: 15px; margin-top: 20px;">
                    <button type="submit" class="elite-btn-main" style="flex: 1; padding: 18px; background: #000;">
                        <?= $es_edicion ? 'ACTUALIZAR ARTÍCULO' : 'GUARDAR ARTÍCULO' ?>
                    </button>
                    <a href="gestion_productos.php" class="btn-quitar" style="flex: 1; text-align: center; padding: 18px;">CANCELAR</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>