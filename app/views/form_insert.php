<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EDUMATCH</title>
    <link rel="stylesheet" href="public/css/registro.css">
</head>
<body class="registro-edumatch">

    <div class="contenedor">

        <div class="panel-izquierdo">
            <h2>¡Bienvenido a EDUMATCH!</h2>
            <p>Conéctate con tutores y asesorados de tu carrera para mejorar tu aprendizaje.</p>
            <div class="botones-izq">
                <a href="index.php?action=login">
                    <button>Iniciar Sesión</button>
                </a>
            </div>
        </div>

        <div class="panel-derecho">
            <form action="" method="POST" onsubmit="return validarCorreo();">
                <h1>Regístrate</h1>

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" required>

                <label for="correo">Correo institucional:</label>
                <input type="email" name="correo" id="correo" placeholder="ejemplo@upemor.edu.mx" required>

                <label for="contraseña">Contraseña:</label>
                <input type="password" name="contraseña" required>

                <label for="rol">Rol:</label>
                <select name="rol" id="rol" required onchange="mostrarCampos()">
                    <option value="">-- Asesorado o Tutor --</option>
                    <option value="Asesorado">Asesorado</option>
                    <option value="Tutor">Tutor</option>
                </select>

                <div id="camposTutor" class="hidden">
                    <label for="areasEnseñanza">Áreas de Enseñanza:</label>
                    <input type="text" name="areasEnseñanza">

                    <label for="cuatrimestreTutor">Cuatrimestre:</label>
                    <input type="number" name="cuatrimestreTutor" min="1" max="10">
                </div>

                <div id="camposAsesorado" class="hidden">
                    <label for="cuatrimestreAsesorado">Cuatrimestre:</label>
                    <input type="number" name="cuatrimestreAsesorado" min="1" max="10">

                    <label for="necesidades">Necesidades:</label>
                    <input type="text" name="necesidades">
                </div>

                <input type="submit" name="enviar" value="Registrar">
            </form>
        </div>
        
    </div>

    <script>
        function mostrarCampos() {
            const rol = document.getElementById("rol").value;
            document.getElementById("camposTutor").classList.add("hidden");
            document.getElementById("camposAsesorado").classList.add("hidden");
            if (rol === "Tutor") {
                document.getElementById("camposTutor").classList.remove("hidden");
            } else if (rol === "Asesorado") {
                document.getElementById("camposAsesorado").classList.remove("hidden");
            }
        }

        function validarCorreo() {
            const correo = document.getElementById("correo").value;
            const regex = /^[a-zA-Z0-9._%+-]+@upemor\.edu\.mx$/;
            if (!regex.test(correo)) {
                alert("Tu correo debe ser institucional (@upemor.edu.mx)");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
