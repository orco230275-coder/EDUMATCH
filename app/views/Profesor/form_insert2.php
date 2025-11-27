<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EDUMATCH</title>

    <link rel="stylesheet" href="public/css/estilos.css">
</head>

<body class="form-insert2">

    <h1>Registra un Usuario</h1>

    <form action="index.php?action=insertarUsuarioProfesor" method="POST" onsubmit="return validarCorreo();">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>

        <label for="correo">Correo institucional:</label>
        <input type="email" name="correo" id="correo" placeholder="ejemplo@upemor.edu.mx" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>

        <label for="rol">Rol:</label>
        <select name="rol" id="rol" required onchange="mostrarCampos()">
            <option value="">-- Profesor, Asesorado, Tutor --</option>
            <option value="Profesor">Profesor</option>
            <option value="Asesorado">Asesorado</option>
            <option value="Tutor">Tutor</option>
        </select>

        <div id="camposProfesor" class="campo-rol hidden">
            <label for="area">Área:</label>
            <input type="text" name="area" id="areaProfesor">
        </div>

        <div id="camposTutor" class="campo-rol hidden">
            <label for="areasEnseñanza">Áreas de Enseñanza:</label>
            <input type="text" name="areasEnseñanza" id="areasEnseñanza">

            <label for="cuatrimestreTutor">Cuatrimestre:</label>
            <input type="number" name="cuatrimestreTutor" id="cuatrimestreTutor" min="1" max="10">
        </div>

        <div id="camposAsesorado" class="campo-rol hidden">
            <label for="cuatrimestreAsesorado">Cuatrimestre:</label>
            <input type="number" name="cuatrimestreAsesorado" id="cuatrimestreAsesorado" min="1" max="10">

            <label for="necesidades">Necesidades:</label>
            <input type="text" name="necesidades" id="necesidades">
        </div>

        <input type="submit" name="enviar" value="Registrar">

    </form>

    <div class="button-group">
        <a href="index.php?action=gestion_usuarios" class="button-link back-button">Regresar</a>
    </div>


    <script>
        function mostrarCampos() {
            const rol = document.getElementById("rol").value;

            document.getElementById("camposProfesor").classList.add("hidden");
            document.getElementById("camposTutor").classList.add("hidden");
            document.getElementById("camposAsesorado").classList.add("hidden");

            document.getElementById("areaProfesor").removeAttribute("required");
            document.getElementById("areasEnseñanza").removeAttribute("required");
            document.getElementById("cuatrimestreTutor").removeAttribute("required");
            document.getElementById("cuatrimestreAsesorado").removeAttribute("required");
            document.getElementById("necesidades").removeAttribute("required");

            if (rol === "Tutor") {
                document.getElementById("camposTutor").classList.remove("hidden");
                document.getElementById("areasEnseñanza").setAttribute("required", "");
                document.getElementById("cuatrimestreTutor").setAttribute("required", "");
            } else if (rol === "Asesorado") {
                document.getElementById("camposAsesorado").classList.remove("hidden");
                document.getElementById("cuatrimestreAsesorado").setAttribute("required", "");
                document.getElementById("necesidades").setAttribute("required", "");
            } else if (rol === "Profesor") {
                document.getElementById("camposProfesor").classList.remove("hidden");
                document.getElementById("areaProfesor").setAttribute("required", "");
            }
        }

        function validarCorreo() {
            const correo = document.getElementById("correo").value;
            const regex = /^[\w.%+-]+@upemor\.edu\.mx$/i;

            if (!regex.test(correo)) {
                alert("Tu correo tiene que ser institucional (@upemor.edu.mx)");
                return false;
            }
            return true;
        }

        window.onload = mostrarCampos;
    </script>

</body>
</html>
