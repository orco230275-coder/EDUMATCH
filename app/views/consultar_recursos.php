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
    <title>Consultar Recursos</title>
    <link rel="stylesheet" href="public/css/consultar_recursos.css">
</head>
<body class="consultar-recursos">

<h2>Consultar Recursos</h2>

<form method="GET" action="">
    <input type="hidden" name="action" value="consultarRecursos">
    <label>Filtrar por asignatura:</label>
    <input type="text" name="asignatura" value="<?php echo $_GET['asignatura'] ?? ''; ?>" placeholder="Ej: Matemáticas">
    <button type="submit">Filtrar</button>
    <a href="index.php?action=consultarRecursos"><button type="button">Ver todos</button></a>
</form>

<?php if ($rol === 'Profesor') { ?>
    <a href="index.php?action=insertarRecurso">
        <button>Agregar nuevo recurso</button>
    </a>
    <br><br>
<?php } ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Enlace</th>
            <th>Asignatura</th>
            <?php if ($rol === 'Profesor') { ?>
                <th>Acciones</th>
            <?php } ?>
        </tr>
    </thead>
   <tbody>
    <?php while ($r = $recursos->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $r['id_recurso']; ?></td>
            <td><?php echo $r['titulo']; ?></td>
            <td><a href="<?php echo $r['enlace']; ?>" target="_blank">Ver</a></td>
            <td><?php echo $r['asignatura']; ?></td>

            <?php if ($rol === 'Profesor') { ?>
            <td class="acciones">
                <a href="index.php?action=editarRecurso&id=<?php echo $r['id_recurso']; ?>">
                    <button>Editar</button>
                </a>
                <a href="index.php?action=eliminarRecurso&id=<?php echo $r['id_recurso']; ?>" 
                   onclick="return confirm('¿Seguro que quieres eliminar este recurso?');">
                    <button class="eliminar-btn">Eliminar</button>
                </a>
            </td>
            <?php } ?>
        </tr>
    <?php } ?>
</tbody>
</table>

<br><br>

<?php if ($rol === 'Profesor') { ?>
    <a href="index.php?action=panelProfesor">
        <button class="volver-btn">Volver</button>
    </a>
<?php } elseif ($rol === 'Tutor') { ?>
    <a href="index.php?action=panelTutor">
        <button class="volver-btn">Volver</button>
    </a>
<?php } else { ?>
    <a href="index.php?action=panelAsesorado">
        <button class="volver-btn">Volver</button>
    </a>
<?php } ?>

</body>
</html>
