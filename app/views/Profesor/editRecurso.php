<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Recurso</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

    <div class="edit-recurso-container">
        <h1 class="edit-recurso-title">Editar Recurso: <?php echo $row['titulo']; ?></h1>

        <form class="edit-recurso-form" action="index.php?action=editarRecurso&id=<?php echo $row['id_recurso']; ?>" method="POST">

            <label for="titulo" class="edit-recurso-label">Título:</label>
            <input type="text" id="titulo" name="titulo" class="edit-recurso-input" value="<?php echo $row['titulo']; ?>" required>

            <label for="enlace" class="edit-recurso-label">Enlace (URL):</label>
            <input type="text" id="enlace" name="enlace" class="edit-recurso-input" value="<?php echo $row['enlace']; ?>" required>

            <label for="id_asignatura" class="edit-recurso-label">Asignatura:</label>
            <select id="id_asignatura" name="id_asignatura" class="edit-recurso-select" required>
                <option value="">-- Selecciona una asignatura --</option>

                <?php 
                while ($a = $asignaturas->fetch_assoc()) { 
                    $selected = ($a['id_asignatura'] == $row['id_asignatura']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $a['id_asignatura']; ?>" <?php echo $selected; ?>>
                        <?php echo $a['nombre']; ?>
                    </option>
                <?php } ?>
            </select>

            <div class="edit-recurso-actions">
                <input type="submit" name="editar" value="Guardar Cambios" class="edit-recurso-submit">

                <a href="index.php?action=consultarRecursos" class="edit-recurso-cancel">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</body>
</html>
