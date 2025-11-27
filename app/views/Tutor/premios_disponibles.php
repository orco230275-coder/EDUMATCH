<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premios disponibles</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>

<body class="premios-disponibles-body">

    <div class="main-container">
        <h2>Premios Disponibles</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Premio</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = $premio->fetch_assoc()) { 
                    $estado = strtolower(trim($row['estado']));
                ?>
                <tr>
                    <td><?= $row['id_premio'] ?? '-' ?></td>
                    <td><?= $row['nombre_premio'] ?></td>
                    <td><?= $row['descripcion'] ?></td>
                    <td><strong><?= ucfirst($estado) ?></strong></td>

                    <td style="text-align: center;">

                        <?php if ($estado === 'pendiente'): ?>

                            <a href="index.php?action=aceptarPremioTutor&id=<?= $row['id_premio'] ?>" 
                               class="action-btn btn-accept">
                                Aceptar
                            </a>

                            <a href="index.php?action=rechazarPremioTutor&id=<?= $row['id_premio'] ?>" 
                               class="action-btn btn-reject">
                                Rechazar
                            </a>

                        <?php elseif ($estado === 'aceptado'): ?>

                            <span class="status-badge badge-success">Aceptado</span>

                        <?php elseif ($estado === 'rechazado'): ?>

                            <span class="status-badge badge-secondary">Rechazado</span>

                        <?php endif; ?>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="index.php?action=panelTutor" class="btn-back">Volver</a>
    </div>

</body>
</html>
