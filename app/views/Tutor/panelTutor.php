<?php

if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Tutor') {
    header("Location: index.php?action=login");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Tutor - EDUMATCH</title>
    
    <link rel="stylesheet" href="public/css/estilos.css">
    </head>

<body class="panel-tutor">
    
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="user-profile">
                <div class="avatar"><?php echo strtoupper(substr($_SESSION['nombre_usuario'], 0, 1)); ?></div>
                <h1 class="welcome-title">
                    <?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellidos_usuario']; ?>
                </h1>
                <h2 class="role-info">Tutor</h2>
            </div>

            <nav class="menu">
                <a href="index.php?action=consultHorario">
                    <button>Gestionar Horarios</button>
                </a>
                <a href="index.php?action=premiosDisponibles"> 
                    <button>Consultar premios disponibles</button>
                </a>
                <a href="index.php?action=gestionarSolicitudesTutor">
                    <button>Gestionar solicitudes</button>
                </a>
                <a href="index.php?action=consultarBitacorasTutor">
                    <button>Consultar mi bitácora</button>
                </a>
                <a href="index.php?action=misPremios"> 
                    <button>Consultar mis premios</button>
                </a>
                <a href="index.php?action=consultarAsignaturas">
                    <button>Consultar asignaturas</button>
                </a>
                <a href="index.php?action=consultarRecursos">
                    <button>Consultar recursos</button>
                </a>
            </nav>

            <div class="logout">
                <a href="index.php?action=logout">
                    <button>Cerrar sesión</button>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <h1 class="welcome-title">Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></h1>
            

            <div class="cards-container">
                
                <div class="card requests">
                    <h3>Solicitudes Nuevas</h3>
                    <p class="value">2</p>
                    <p class="description">Solicitudes de asesoría pendientes</p>
                </div>
                <div class="card bitacoras">
                    <h3>Premios</h3>
                    <p class="value">1</p>
                    <p class="description">Premios Recibidos</p>
                </div>
                </div>

            </main>
    </div>

    <footer>Panel de gestión de Tutores | EDUMATCH</footer>
</body>
</html>