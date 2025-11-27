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
    <title>Consultar Asignaturas</title>
    <link rel="stylesheet" href="public/css/consultar_asignaturas.css">
</head>

<body class="consultar-asignaturas">

<div class="container">
    <h2>Asignaturas (ITI) (TSU)</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($a = $asignaturas->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $a['id_asignatura']; ?></td>
                    <td><?php echo $a['nombre']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="boton-volver">
    <?php if ($rol === 'Profesor') { ?>
        <a href="index.php?action=panelProfesor"><button>Volver</button></a>
    <?php } elseif ($rol === 'Tutor') { ?>
        <a href="index.php?action=panelTutor"><button>Volver</button></a>
    <?php } else { ?>
        <a href="index.php?action=panelAsesorado"><button>Volver</button></a>
    <?php } ?>
</div>

</body>
</html>
