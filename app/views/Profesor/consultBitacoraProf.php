<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol_usuario'])) {
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
    <title>Bitácoras de Tutores</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

<div class="gestion-consult-bitacora-prof">

    <h2>Bitácora de asesorías de Tutores</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Fecha realizada</th>
                    <th>Tutor</th>
                    <th>Asesorado</th>
                    <th>Asignatura</th>
                    <th>Periodo</th>
                    <th>Calificación</th>
                    <th>Retroalimentación</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($b = $bitacoras->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $b['fecha_realizada'] ?></td>
                        <td><?= $b['nombre_tutor'] ?></td>
                        <td><?= $b['nombre_asesorado'] ?></td>
                        <td><?= $b['nombre'] ?></td>
                        <td><?= $b['periodo_cuatrimestral'] ?></td>
                        <td><?= str_repeat('★', $b['calificacion_estrellas']?? 0) ?></td>
                        <td><?= $b['retroalimentacion'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="index.php?action=panelProfesor">
        <button class="volver-btn">Volver</button>
    </a>

</div>

</body>
</html>
