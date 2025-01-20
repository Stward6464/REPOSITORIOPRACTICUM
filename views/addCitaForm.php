<h2 class="text-primary">Programar Cita</h2>
<form action="index.php?action=addCita" method="POST" class="bg-light p-4 rounded shadow">
    <div class="mb-3">
        <label for="paciente_id" class="form-label">Paciente:</label>
        <select id="paciente_id" name="paciente_id" class="form-select" required>
            <?php foreach ($pacientes as $paciente) { ?>
                <option value="<?php echo htmlspecialchars($paciente['id']); ?>">
                    <?php echo htmlspecialchars($paciente['nombre']); ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="medico_id" class="form-label">Médico:</label>
        <select id="medico_id" name="medico_id" class="form-select" required>
            <?php foreach ($medicos as $medico) { ?>
                <option value="<?php echo htmlspecialchars($medico['id']); ?>">
                    <?php echo htmlspecialchars($medico['nombre'] . ' - ' . $medico['especialidad']); ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha" name="fecha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Crear Cita</button>
</form>
