<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Horario</title>
    <link rel="stylesheet" href="public/css/estilos.css">

    
</head>
<body class="gestion-horarios">

<div class="form-container">
    <h2>Registrar Horario</h2>

    <form action="index.php?action=registrarHorario" method="POST" onsubmit="return validarHoras();">
        <div>
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>
        </div>

        <div>
            <label for="hora_inicio">Hora de inicio:</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required>
        </div>

        <div>
            <label for="hora_fin">Hora de fin:</label>
            <input type="time" name="hora_fin" id="hora_fin" required>
        </div>

        <div>
            <label for="id_asignatura">Asignatura:</label>
            <select name="id_asignatura" id="id_asignatura" required>
                <option value="">---Seleccione una asignatura---</option>
                <?php while ($row = $asignaturas->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_asignatura']; ?>">
                        <?php echo $row['nombre']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="submit-btn">Registrar</button>
    </form>
</div>

<a href="index.php?action=consultHorario">
    <button class="secondary-btn">Ver mis horarios</button> 
</a>

<script>
    function validarHoras() {
        const horaInicio = document.getElementById('hora_inicio').value;
        const horaFin = document.getElementById('hora_fin').value;

        if (horaInicio >= horaFin) {
            alert("La hora de fin debe ser posterior a la hora de inicio.");
            return false;
        }
        return true;
    }
</script>



</body>
</html>