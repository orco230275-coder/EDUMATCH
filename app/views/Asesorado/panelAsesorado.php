<?php

if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Asesorado') {
    header("Location: index.php?action=login");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Asesorado - EDUMATCH</title>

    <link rel="stylesheet" href="public/css/estilos.css">
</head>

<body class="panel-tutor">

    <div class="dashboard-layout">

        <aside class="sidebar">
            <div class="user-profile">
                <div class="avatar">
                    <?php echo strtoupper(substr($_SESSION['nombre_usuario'], 0, 1)); ?>
                </div>

                <h1 class="welcome-title">
                    <?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellidos_usuario']; ?>
                </h1>

                <h2 class="role-info">Asesorado</h2>
            </div>

            <nav class="menu">
                <a href="index.php?action=consultarAsignaturas">
                    <button>Ver asignaturas</button>
                </a>
                <a href="index.php?action=solicitarAsesoria">
                    <button>Solicitar asesoría</button>
                </a>
                <a href="index.php?action=consultarSolicitudes">
                    <button>Ver mis solicitudes</button>
                </a>
                <a href="index.php?action=consultarRecursos">
                    <button>Ver recursos</button>
                </a>
                <a href="index.php?action=registrarBitacora">
                    <button>Calificar una asesoría</button>
                </a>
            </nav>

            <div class="logout">
                <a href="index.php?action=logout">
                    <button>Cerrar sesión</button>
                </a>
            </div>
        </aside>

        <main class="main-content">

            <h1 class="welcome-title">
                Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>
            </h1>

            <div class="cards-container">

                <div class="card requests">
                    <h3>Solicitudes</h3>
                    <p class="value">3</p>
                    <p class="description">Tus solicitudes registradas</p>
                </div>

                <div class="card bitacoras">
                    <h3>Asesorías</h3>
                    <p class="value">5</p>
                    <p class="description">Retroalimentación y calificaciones</p>
                </div>

            </div>

        </main>
    </div>

    <footer>Panel de gestión de Asesorados | EDUMATCH</footer>
</body>
</html>
