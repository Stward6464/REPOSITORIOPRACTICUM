<h2>Registrar Síntomas y Diagnóstico</h2>
<form action="index.php?action=agregarHistorial" method="POST">
    <label for="paciente_id">Seleccionar Paciente:</label>
    <select id="paciente_id" name="paciente_id" required>
        <?php foreach ($pacientes as $paciente): ?>
            <option value="<?php echo htmlspecialchars($paciente['id']); ?>">
                <?php echo htmlspecialchars($paciente['nombre']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required>
    <br><br>

    <label for="sintomas">Síntomas:</label>
    <textarea id="sintomas" name="sintomas" rows="4" cols="50" required></textarea>
    <br><br>

    <label for="diagnostico">Diagnóstico:</label>
    <textarea id="diagnostico" name="diagnostico" rows="4" cols="50" required></textarea>
    <br><br>

    <button type="submit">Registrar</button>
</form>
