<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Profesor') {
    header("Location: index.php?action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte por asignatura</title>
    <link rel="stylesheet" href="public/css/reporte_asignatura.css">
</head>
<body class="reporte-asignatura">

    <div class="container">
        <h1>Reporte: Porcentaje por asignatura</h1>
        <hr>

        <table>
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Total Solicitudes</th>
                    <th>Porcentaje del Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (isset($data) && $data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['asignatura']) ?></td>
                    <td><?= $row['total_solicitudes'] ?></td>
                    <td><?= number_format($row['porcentaje'], 2) ?>%</td>
                </tr>
                <?php 
                    } 
                } else {
                ?>
                <tr>
                    <td colspan="3" style="text-align:center;">No hay datos para mostrar</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="menu">
        <a href="index.php?controller=report&action=pdf_report">
            <button>GENERAR PDF</button>
        </a>

        <a href="index.php?controller=report&action=pdf_graph_asignaturas">
            <button>GENERAR GRAFICA</button>
        </a>

        <a href="index.php?controller=report&action=pdf_pie_asignaturas">
            <button>GENERAR PASTEL</button>
        </a>
    </div>

    <a href="index.php?action=gestion_reportes" class="back-button">Volver</a>

</body>
</html>
