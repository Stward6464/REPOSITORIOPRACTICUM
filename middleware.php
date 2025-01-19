<?php
function verificarRol($rolesRequeridos) {
    // Verifica si la sesión ya está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], (array)$rolesRequeridos)) {
        echo "<p>No tienes permisos para acceder a esta página.</p>";
        echo '<a href="index.php?action=loginForm">Iniciar Sesión</a>';
        exit;
    }
}
?>
