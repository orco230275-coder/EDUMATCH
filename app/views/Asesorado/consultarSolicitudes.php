<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Solicitudes</title>
    <link rel="stylesheet" href="public/css/consulta_solicitudes.css">
</head>

<body class="consulta-solicitudes">

<div class="container">
    <h2>Mis Solicitudes de Asesoría</h2>

    <table>
        <thead>
            <tr>
                <th class="col-id">ID</th>
                <th>Asignatura</th>
                <th>Tutor</th>
                <th>Fecha</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = $solicitudes->fetch_assoc()) { 

                $estado_clase = '';
                if (strcasecmp($row['estado'], 'Pendiente') == 0) 
                    $estado_clase = 'status-pendiente';
                elseif (strcasecmp($row['estado'], 'Aceptada') == 0) 
                    $estado_clase = 'status-aceptada';
                elseif (strcasecmp($row['estado'], 'Rechazada') == 0) 
                    $estado_clase = 'status-rechazada';
                elseif (strcasecmp($row['estado'], 'Cancelada') == 0) 
                    $estado_clase = 'status-cancelada';

            ?>

            <tr>
                <td class="col-id"><?= $row['id_solicitud'] ?></td>
                <td><?= $row['asignatura'] ?></td>
                <td><?= $row['tutor'] ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['hora_inicio'] ?></td>
                <td><?= $row['hora_fin'] ?></td>

                <td>
                    <span class="status-badge <?= $estado_clase ?>">
                        <?= $row['estado'] ?>
                    </span>
                </td>

                <td>
                    <?php if (strcasecmp($row['estado'], 'Pendiente') == 0) { ?>

                        <a class="btn-accion cancelar"
                           href="index.php?action=cancelarSolicitud&id=<?= $row['id_solicitud'] ?>"
                           onclick="return confirm('¿Seguro que deseas cancelar esta solicitud?');">
                            <button>Cancelar</button>
                        </a>

                        <br><br>

                        <a class="btn-accion eliminar"
                           href="index.php?action=eliminarSolicitud&id=<?= $row['id_solicitud'] ?>"
                           onclick="return confirm('¿Seguro que deseas eliminar esta solicitud?');">
                           <button>Eliminar</button>
                        </a>

                    <?php } else { ?>
                        —
                    <?php } ?>
                </td>
            </tr>

            <?php } ?>
        </tbody>
    </table>
</div>

<div class="volver-container">
    <a class="volver-btn" href="index.php?action=panelAsesorado">Volver</a>
</div>

</body>
</html>
