<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios Disponibles</title>

    <link rel="stylesheet" href="public/css/horarios_disponibles.css">
</head>

<body class="horarios-disponibles">

    <div class="main-container">

        <h2>Horarios Disponibles</h2>

        <p class="usuario">
            Alumno en sesión: 
            <b><?= ($_SESSION['nombre_usuario'] ?? 'Desconocido'); ?></b>
        </p>

        <table>
            <thead>
                <tr>
                    <th class="oculto">ID</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Asignatura</th>
                    <th>Tutor</th>
                    <th class="center">Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $horarios->fetch_assoc()) { ?>
                <tr>
                    <td class="oculto"><?= $row['id_horario'] ?></td>
                    <td><?= $row['fecha'] ?></td>
                    <td><?= $row['hora_inicio'] ?></td>
                    <td><?= $row['hora_fin'] ?></td>
                    <td><?= $row['asignatura'] ?></td>
                    <td><?= $row['tutor'] ?></td>

                    <td class="center">
                        <form action="index.php?action=enviarSolicitud" method="POST">
                            <input type="hidden" name="id_horario" value="<?= $row['id_horario'] ?>">
                            <input type="hidden" name="id_asignatura" value="<?= $row['id_asignatura'] ?>">

                            <button type="submit" class="action-btn btn-send">
                                Enviar Solicitud
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="volver-container">
            <a href="index.php?action=panelAsesorado" class="btn-back">
                VOLVER
            </a>
        </div>

    </div>

</body>
</html>
