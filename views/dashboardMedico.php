<h2>Panel del Médico</h2>
<p>Bienvenido, <?php echo $_SESSION['username']; ?></p>
<ul>
    <li><a href="index.php?action=listCitas">Ver Citas Asignadas</a></li>
    <a href="index.php?action=mostrarFormularioHistorial">Registrar Síntomas y Diagnóstico</a>

</ul>
<a href="index.php?action=logout">Cerrar Sesión</a>
