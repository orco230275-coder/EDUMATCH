<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Asesorado') {
    header("Location: index.php?action=login");
    exit;
}

$rol = $_SESSION['rol_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi bitácora de asesorías</title>
    <link rel="stylesheet" href="public/css/bitacora_asesorias.css">
</head>

<body class="bitacora-asesorias">

<h2>Mi bitácora de asesorías</h2>

<div class="table-container">
<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Tutor</th>
            <th>Asignatura</th>
            <th>Periodo</th>
            <th>Calificación</th>
            <th>Retroalimentación</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
    <?php while ($b = $bitacoras->fetch_assoc()) { ?>
        <form action="index.php?action=guardarRetroalimentacion" method="POST">
        <tr>

            <td><?= $b['fecha_realizada'] ?></td>
            <td><?= $b['nombre_tutor'] ?></td>
            <td><?= $b['asignatura'] ?></td>

            <td>
                <select name="periodo_cuatrimestral" required>
                    <option value="">-- Selecciona --</option>
                    <option value="Enero-Abril">Enero-Abril</option>
                    <option value="Mayo-Agosto">Mayo-Agosto</option>
                    <option value="Septiembre-Diciembre">Septiembre-Diciembre</option>
                </select>
            </td>

            <td>
                <select name="calificacion_estrellas" required>
                    <option value="">★</option>
                    <option value="1" <?= $b['calificacion_estrellas']==1?'selected':'' ?>>★</option>
                    <option value="2" <?= $b['calificacion_estrellas']==2?'selected':'' ?>>★★</option>
                    <option value="3" <?= $b['calificacion_estrellas']==3?'selected':'' ?>>★★★</option>
                    <option value="4" <?= $b['calificacion_estrellas']==4?'selected':'' ?>>★★★★</option>
                    <option value="5" <?= $b['calificacion_estrellas']==5?'selected':'' ?>>★★★★★</option>
                </select>
            </td>

            <td>
                <input type="text" name="retroalimentacion" value="<?= $b['retroalimentacion'] ?>">
            </td>

            <input type="hidden" name="id_solicitud" value="<?= $b['id_solicitud'] ?>">
            <input type="hidden" name="id_tutor" value="<?= $b['id_tutor'] ?>">

            <td class="acciones">
                <button type="submit">Guardar</button>
            </td>

        </tr>
        </form>

    <?php } ?>
    </tbody>
</table>
</div>

<div class="volver-container">
    <a href="index.php?action=panelAsesorado">
        <button class="volver-btn">Volver</button>
    </a>
</div>

</body>
</html>
