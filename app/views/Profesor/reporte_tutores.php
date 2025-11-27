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
    <title>Reporte por Tutor</title>
    <link rel="stylesheet" href="public/css/reporte_tutor.css">
</head>
<body class="reporte-tutor">

    <div class="container">
        <h1>Reporte: Asesorías atendidas por tutor</h1>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Asesorías Atendidas</th>
                    <th>Porcentaje del Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (isset($data) && $data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['tutor']) ?></td>
                    <td><?= $row['total_atendidas'] ?></td>
                    <td><?= number_format($row['porcentaje'], 2) ?>%</td>
                </tr>
                <?php 
                    } 
                } else { ?>
                <tr>
                    <td colspan="3" style="text-align:center;">No hay datos para mostrar</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="menu">
        <a href="index.php?action=pdfTutores">
            <button>GENERAR PDF</button>
        </a>
        <a href="index.php?controller=report&action=pdf_graph_tutores">
            <button>GENERAR GRAFICA</button>
        </a>
        <a href="index.php?controller=report&action=pdf_pie_tutores">
            <button>GENERAR PASTEL</button>
        </a>
    </div>

    <a href="index.php?action=gestion_reportes" class="back-button">Volver</a>

</body>
</html>
