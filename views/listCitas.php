<h1>Lista de Citas</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Paciente</th>
        <th>Médico</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php foreach ($citas as $cita): ?>
    <tr>
        <td><?php echo $cita['id']; ?></td>
        <td><?php echo $cita['paciente']; ?></td>
        <td><?php echo $cita['medico']; ?></td>
        <td><?php echo $cita['fecha']; ?></td>
        <td><?php echo $cita['estado']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
