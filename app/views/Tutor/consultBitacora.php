<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Asesorías - Tutor</title>
    <link rel="stylesheet" href="public/css/bitacora_tutor.css">
</head>
<body class="bitacora-tutor">

    <div class="main-container">

        <h2>Bitácora de Asesorías Registradas</h2>

        <h3 class="tutor-name">
            Tutor: <?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellidos_usuario']; ?>
        </h3>

        <table class="tabla-bitacora">
            <thead>
                <tr>
                    <th>Fecha realizada</th>
                    <th>Asesorado</th>
                    <th>Asignatura</th>
                    <th>Periodo</th>
                    <th>Calificación</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($b = $bitacoras->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $b['fecha'] ?></td>
                        <td><?= $b['nombre_asesorado'] ?></td>
                        <td><?= $b['nombre_asignatura'] ?></td>
                        <td><?= $b['periodo_cuatrimestral'] ?></td>
                        <td class="stars"><?= str_repeat('★', $b['calificacion'] ?? 0) ?></td>
                        <td><?= $b['retroalimentacion'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="index.php?action=panelTutor" class="volver-btn">Volver</a>

    </div>

</body>
</html>
