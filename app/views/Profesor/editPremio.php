<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Premio</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
    
<div class="edit-premio">

    <div class="container">
        <h1>Editar Premio: <?php echo $row['nombre_premio']; ?> </h1>
        <hr>

        <form action="index.php?action=actualizarPremio&id=<?php echo $row['id_premio']; ?>" method="POST">

            <label for="nombre_premio">Nombre de premio:</label>
            <input type="text" id="nombre_premio" name="nombre_premio"
                   value="<?php echo $row['nombre_premio']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion"
                   value="<?php echo $row['descripcion']; ?>" required>

            <div class="actions">
                <button type="submit" name="editar" class="update-button">Modificar</button>

                <a href="index.php?action=consultPremios" class="button-link cancel-button">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>


</body>
</html>