<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Seguridad
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
    <title>Generar Reportes</title>
    <link rel="stylesheet" href="public/css/gestion_reportes.css">
</head>

<body class="reportes-panel">

    <h1>Panel de Reportes</h1>

    <div class="menu">
        <a href="index.php?action=reporteAsignaturas">
            <button>Reporte por Asignatura</button>
        </a>
        <a href="index.php?action=reporteTutores">
            <button>Reporte por Tutor</button>
        </a>
        <a href="index.php?controller=user&action=backup">
            <button>Respaldo</button>
        </a>
        <a href="index.php?controller=user&action=restore">
            <button>Restaurar</button>
        </a>
    </div>

    <div class="back">
        <a href="index.php?action=panelProfesor">
            <button>Volver al Panel</button>
        </a>
    </div>

    <?php if(isset($restore)){ ?>
        <?php echo $restore; ?>
        <script>
            setTimeout(function () {
                window.location.href = "index.php?controller=reportes&action=gestion_reportes";
            }, 3000);
        </script>
    <?php } ?>

</body>
</html>
