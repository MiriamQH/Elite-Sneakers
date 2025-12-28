<?php
session_start();
require_once '../config/conexion.php';

// Seguridad: Solo admin procesa estos datos
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') exit();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rol = $_POST['rol'];
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $password = $_POST['password'];

    if ($_POST['accion'] == 'crear') {
        // CREAR USUARIO 
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, telefono) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombre, $apellidos, $email, $pass_hash, $rol, $telefono);
    } else {
        // MODIFICAR USUARIO 
        if (!empty($password)) {
            // Si el admin escribió una contraseña nueva, la actualizamos
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre=?, apellidos=?, email=?, rol=?, telefono=?, password=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $nombre, $apellidos, $email, $rol, $telefono, $pass_hash, $id);
        } else {
            // Si no escribió contraseña, mantenemos la anterior
            $sql = "UPDATE usuarios SET nombre=?, apellidos=?, email=?, rol=?, telefono=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $nombre, $apellidos, $email, $rol, $telefono, $id);
        }
    }

    if ($stmt->execute()) {
        header("Location: gestion_usuarios.php?success=1");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>