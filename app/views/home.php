<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EDUMATCH</title>
    <link rel="stylesheet" href="public/css/edumatch_inicio.css">
</head>

<body>
    <div class="container">
        <img src="html/img/logo_upemor.png" alt="Logo Upemor" class="logo">
        <h1>Bienvenido a <span>EDUMATCH</span></h1>
        <p>Conecta, aprende y crece con tus compañeros</p>

        <div class="btn-container">
            <a href="index.php?action=login">
                <button class="btn-login">Iniciar sesión</button>
            </a>
            <a href="index.php?action=registrar">
                <button class="btn-register">Registrarse</button>
            </a>
        </div>
    </div>

    <footer>
        © <?php echo date('Y'); ?> Universidad Politécnica del Estado de Morelos - EDUMATCH
    </footer>
</body>
</html>
