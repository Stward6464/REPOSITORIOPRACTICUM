<h2>Programar Cita</h2>
<form action="index.php?action=addCita" method="POST">
    <label for="paciente_id">Paciente:</label>
    <select id="paciente_id" name="paciente_id" required>
    <?php foreach ($pacientes as $paciente) { ?>
        <option value="<?php echo htmlspecialchars($paciente['id']); ?>">
            <?php echo htmlspecialchars($paciente['nombre']); ?>
        </option>
    <?php } ?>
</select>

<select id="medico_id" name="medico_id" required>
    <?php foreach ($medicos as $medico) { ?>
        <option value="<?php echo htmlspecialchars($medico['id']); ?>">
            <?php echo htmlspecialchars($medico['nombre'] . ' - ' . $medico['especialidad']); ?>
        </option>
    <?php } ?>
</select>

    <br><br>

    <label for="fecha">Fecha y Hora:</label>
    <input type="datetime-local" id="fecha" name="fecha" required>
    <br><br>

    <button type="submit">Crear Cita</button>
</form>
