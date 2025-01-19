<h1>Lista de Pacientes</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
    </tr>
    <?php foreach ($pacientes as $paciente): ?>
    <tr>
        <td><?php echo $paciente['id']; ?></td>
        <td><?php echo $paciente['nombre']; ?></td>
        <td><?php echo $paciente['email']; ?></td>
        <td><?php echo $paciente['telefono']; ?></td>
        <td><?php echo $paciente['direccion']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
