<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/css/login.css">

</head>
<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <hr>
        <form action="index.php?action=login" method="POST">
            <div class="input-group">
                <label for="correo">Correo:</label>
                <input type="text" name="correo" id="correo" required>
            </div>
            
            <div class="input-group">
                <label for="pass">Contraseña:</label>
                <input type="password" name="pass" id="pass" required>
            </div>
            
            <button type="submit" name="ingresar">Ingresar</button>
        </form>

        <p>¿No tienes una cuenta? Crea una</p>
        <a href="index.php?action=registrar">
            <button>Registrarse</button>
        </a>

        <br><br>
        <a href="index.php?action=home">
            <button>Volver al Inicio</button>
        </a>
    </div>
</body>
</html>
