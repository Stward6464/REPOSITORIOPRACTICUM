<h1>Lista de Médicos</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Especialidad</th>
    </tr>
    <?php foreach ($medicos as $medico): ?>
    <tr>
        <td><?php echo $medico['id']; ?></td>
        <td><?php echo $medico['nombre']; ?></td>
        <td><?php echo $medico['especialidad']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
