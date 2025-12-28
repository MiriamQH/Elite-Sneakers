<?php
/**
 * Capa de Lógica de Negocio: Gestión de eliminación de usuarios (RF01) 
 * Este archivo valida los permisos del administrador y procesa la baja en la BD.
 */

// Incluimos la conexión que ya inicia la sesión y conecta a MySQL 
require_once '../config/conexion.php'; 

// 1. CONTROL DE ESTADO Y SEGURIDAD 
// Verificamos que el usuario esté logueado y tenga rol de administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin'){
    // Si no es admin, redirigimos a la página principal por seguridad
    header("Location: ../index.php");
    exit();
}

// 2. CAPA DE ACCESO A DATOS: ELIMINACIÓN 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Utilizamos consultas preparadas para evitar inyecciones SQL 
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Redirección tras éxito: Volvemos al panel de gestión 
        header("Location: gestion_usuarios.php?msg=eliminado");
        exit();
    } else {
        // En caso de error en la base de datos
        echo "Error crítico al intentar eliminar el registro: " . $conn->error;
    }
    
    $stmt->close();
} else {
    // Si se accede al archivo sin un ID válido, redirigimos al panel
    header("Location: gestion_usuarios.php");
    exit();
}
?>