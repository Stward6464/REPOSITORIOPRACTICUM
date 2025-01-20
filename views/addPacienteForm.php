<h2 class="text-success mt-5">Añadir Paciente</h2>
<form action="index.php?action=addPaciente" method="POST" class="bg-light p-4 rounded shadow">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección:</label>
        <textarea id="direccion" name="direccion" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="historial" class="form-label">Historial Clínico:</label>
        <textarea id="historial" name="historial" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Añadir Paciente</button>
</form>
