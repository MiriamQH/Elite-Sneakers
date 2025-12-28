<?php
session_start();
session_unset();
session_destroy();

// Redirigimos al catálogo principal después de cerrar sesión
header("Location: index.php");
exit();
?>