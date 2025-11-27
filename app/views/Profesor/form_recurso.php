<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Recurso</title>
    <link rel="stylesheet" href="public/css/agregar_recurso.css">
</head>
<body>
    
    <div class="container">
        <h1>Agregar Nuevo Recurso</h1>
        
        <form action="" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="enlace">Enlace (URL):</label>
            <input type="text" id="enlace" name="enlace" required>
            
            <label for="id_asignatura">Asignatura:</label>
            <select id="id_asignatura" name="id_asignatura" required>
                <option value="">-- Selecciona una asignatura --</option>
                <?php while ($a = $asignaturas->fetch_assoc()) { ?>
                    <option value="<?php echo $a['id_asignatura']; ?>">
                        <?php echo $a['nombre']; ?>
                    </option>
                <?php } ?>
            </select>

            <div class="actions">
                <input type="submit" value="Guardar">
                
                <a href="index.php?action=consultarRecursos" class="cancel-button">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>
