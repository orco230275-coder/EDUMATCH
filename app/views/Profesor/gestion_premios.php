<!DOCTYPE html>
<html lang="es" class="registrar-premio">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Premio</title>
    <link rel="stylesheet" href="public/css/registrar_premio.css">
</head>
<body class="registrar-premio">

    <div class="container">
        <h1>Registrar Premio</h1>
        <hr>
        
        <form action="" method="POST">
            <label for="nombre_premio">Nombre del Premio:</label>
            <input type="text" id="nombre_premio" name="nombre_premio" required>
            
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required>

            <input type="submit" name="enviar" value="Registrar Premio">
        </form>

        <div class="actions">
            <a href="index.php?action=consultPremios" class="button-link secondary-button">
                Premios Registrados
            </a>
            
            <a href="index.php?action=panelProfesor" class="button-link exit-button">
                Volver
            </a>
        </div>
    </div>

</body>
</html>
