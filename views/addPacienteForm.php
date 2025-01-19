<h2>Añadir Paciente</h2>
<form action="index.php?action=addPaciente" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required><br><br>

    <label for="direccion">Dirección:</label>
    <textarea id="direccion" name="direccion" required></textarea><br><br>

    <label for="historial">Historial Clínico:</label>
    <textarea id="historial" name="historial" required></textarea><br><br>

    <button type="submit">Añadir Paciente</button>
</form>
