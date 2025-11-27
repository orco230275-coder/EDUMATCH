<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Horario</title>

    <link rel="stylesheet" href="public/css/editar_horario.css">
</head>
<body class="editar-horario">

    <div class="container">
        <h2>Editar Horario #<?php echo $horario['id_horario']; ?></h2>

        <form action="index.php?action=actualizarHorario&id=<?php echo $horario['id_horario']; ?>" method="POST">
            <input type="hidden" name="id_horario" value="<?php echo $horario['id_horario']; ?>">

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $horario['fecha']; ?>">

            <label for="hora_inicio">Hora de inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo $horario['hora_inicio']; ?>">

            <label for="hora_fin">Hora de fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" value="<?php echo $horario['hora_fin']; ?>">

            <label for="id_asignatura">Asignatura:</label>
            <select name="id_asignatura" id="id_asignatura" required>
                <option value="">--- Selecciona una asignatura ---</option>
                <?php while ($asig = $asignaturas->fetch_assoc()) { ?>
                    <option value="<?php echo $asig['id_asignatura']; ?>" 
                        <?php if ($asig['id_asignatura'] == $horario['id_asignatura']) echo 'selected'; ?>>
                        <?php echo $asig['nombre']; ?>
                    </option>
                <?php } ?>
            </select>

            <input type="submit" name="editar" value="Actualizar Horario" class="btn-actualizar">
        </form>

        <div class="volver-container">
            <a href="index.php?action=consultHorario">
                <button class="btn-volver">Regresar</button>
            </a>
        </div>
    </div>

</body>
</html>
