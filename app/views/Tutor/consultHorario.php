<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Horarios - Tutor</title>

    <link rel="stylesheet" href="public/css/gestionar_horarios.css">
</head>
<body class="consultar-horario">

<div class="container">
    <h1>Horarios Disponibles</h1>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Asignatura</th>
                <th>Tutor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            if (isset($horarios) && $horarios instanceof mysqli_result) { 
                while($row = $horarios->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['hora_inicio']; ?></td>
                <td><?php echo $row['hora_fin']; ?></td>
                <td><?php echo $row['asignatura']; ?></td>
                <td><?php echo $row['nombre_tutor']; ?></td>
                <td>
                    <a href="index.php?action=actualizarHorario&id=<?php echo $row['id_horario']; ?>">
                        <button>Editar</button>
                    </a>
                    
                    <a href="index.php?action=eliminarHorario&id=<?php echo $row['id_horario']; ?>" 
                       onclick="return confirm('¿Seguro que deseas eliminar este horario?');">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php
                }
            } else {
                echo '<tr><td colspan="7" class="no-data">No hay horarios registrados o hubo un error al cargar.</td></tr>';
            }
        ?>
        </tbody>
    </table>

    <a href="index.php?action=registrarHorario">
        <button class="main-action-button">Registrar nuevo horario</button>
    </a>
</div>

<div class="volver-container">
    <a href="index.php?action=panelTutor">
        <button class="back-button">Volver</button>
    </a>
</div>

</body>
</html>
