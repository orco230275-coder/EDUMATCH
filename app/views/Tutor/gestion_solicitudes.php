<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de Asesoría</title>
    <link rel="stylesheet" href="public/css/gestion_solicitudes.css">

</head>
<body class="gestion-solicitudes">

    <h2>Solicitudes de Asesoría Recibidas</h2>

    <table>
        <tr>
            <th>Alumno</th>
            <th>Asignatura</th>
            <th>Fecha</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php while ($row = $solicitudes->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['nombre'] . ' ' . $row['apellidos'] ?></td>
            <td><?= $row['asignatura'] ?></td>
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['hora_inicio'] ?></td>
            <td><?= $row['hora_fin'] ?></td>
            <td class="estado-<?= $row['estado'] ?>">
                <?= ucfirst($row['estado']) ?> 
            
<td>
    <?php if (strtolower($row['estado']) === 'pendiente') { ?>
        <form action="index.php?action=actualizarEstadoSolicitud" method="POST" style="display:inline;">
            <input type="hidden" name="id_solicitud" value="<?= $row['id_solicitud'] ?>">
            <input type="hidden" name="estado" value="aceptada">
            <button type="submit" class="btn btn-aceptar">Aceptar</button>
        </form>
        <br><br>
        <form action="index.php?action=actualizarEstadoSolicitud" method="POST" style="display:inline;">
            <input type="hidden" name="id_solicitud" value="<?= $row['id_solicitud'] ?>">
            <input type="hidden" name="estado" value="rechazada">
            <button type="submit" class="btn btn-rechazar">Rechazar</button>
        </form>
    <?php } else { ?>
        <em>No disponible</em>
    <?php } ?>
</td>


        </tr>
        <?php } ?>
    </table>

    <a href="index.php?action=panelTutor" class="btn-regresar">Volver</a>
</body>
</html>
