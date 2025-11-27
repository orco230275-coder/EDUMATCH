<?php
if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Profesor') {
    header("Location: index.php?action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Profesor - EDUMATCH</title>
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

                <h2 class="role-info">Profesor</h2>
            </div>

            <nav class="menu">
                <a href="index.php?action=gestion_premios">
                    <button>Gestionar Premios</button>
                </a>
                <a href="index.php?action=gestion_usuarios">
                    <button>Gestionar Usuarios</button>
                </a>
                <a href="index.php?action=consultarRecursos">
                    <button>Gestionar Recursos</button>
                </a>
                <a href="index.php?action=consultarAsignaturas">
                    <button>Gestionar Asignaturas</button>
                </a>
                <a href="index.php?action=consultBitacoraProf">
                    <button>Ver Bitácoras de Tutores</button>
                </a>
                <a href="index.php?action=gestion_reportes">
                    <button>Generar Reportes</button>
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
                    <h3>Usuarios Registrados</h3>
                    <p class="value">20</p>
                    <p class="description">Control desde su panel</p>
                </div>

                <div class="card bitacoras">
                    <h3>Bitácoras</h3>
                    <p class="value">2</p>
                    <p class="description">Seguimiento de tutores</p>
                </div>

            </div>
        </main>
    </div>

    <footer>Panel de gestión de Profesores | EDUMATCH</footer>
</body>
</html>
