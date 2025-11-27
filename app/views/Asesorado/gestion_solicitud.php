<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Solicitudes</title>
    <link rel="stylesheet" href="public/css/gestion_solicitud.css">
</head>
<body>

<div class="gestion-solicitud">
    <h2>Mis Solicitudes de Asesoría</h2>

    <a href="index.php?action=solicitarAsesoria" class="action-button">
        <button>Solicitar Nueva Asesoría</button>
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Asignatura</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        
        <?php while ($row = $solicitudes->fetch_assoc()) { 
            $estado_clase = '';
            if (strcasecmp($row['estado'], 'Pendiente') == 0) {
                $estado_clase = 'status-pendiente';
            } elseif (strcasecmp($row['estado'], 'Aceptada') == 0) {
                $estado_clase = 'status-aceptada';
            } elseif (strcasecmp($row['estado'], 'Rechazada') == 0) {
                $estado_clase = 'status-rechazada';
            }
        ?>
            <tr>
                <td><?= $row['id_solicitud'] ?></td>
                <td><?= $row['asignatura'] ?></td>
                <td><?= $row['fecha'] ?></td>
                <td><?= $row['hora_inicio'] ?></td>
                <td><?= $row['hora_fin'] ?></td>
                <td>
                    <span class="status-badge <?= $estado_clase ?>">
                        <?= $row['estado'] ?>
                    </span>
                </td>
            </tr>
        <?php 
        } 
        ?>
        </tbody>
    </table>
</div>


<div class="volver-container">
    <a href="index.php?action=panelAsesorado">
        <button>Volver</button>
    </a>
</div>

</body>
</html>