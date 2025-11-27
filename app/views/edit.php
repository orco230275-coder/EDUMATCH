<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - EDUMATCH</title>
    <link rel="stylesheet" href="public/css/edit.css">
</head>
<body class="edit-user-page">
    <h1>Editar Usuario: <?php echo $row['nombre']; ?></h1>

    <form action="index.php?action=update&id=<?php echo $row['id_usuario']; ?>" method="POST" onsubmit="return validarCorreo();">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required>

        <label for="correo">Correo institucional:</label>
        <input type="email" name="correo" id="correo" value="<?php echo $row['correo']; ?>" required>


        <label for="rol">Rol:</label>
        <select name="rol" id="rol" required onchange="mostrarCampos()">
            <option value="Profesor" <?php if ($row['rol'] == 'Profesor') echo 'selected'; ?>>Profesor</option>
            <option value="Tutor" <?php if ($row['rol'] == 'Tutor') echo 'selected'; ?>>Tutor</option>
            <option value="Asesorado" <?php if ($row['rol'] == 'Asesorado') echo 'selected'; ?>>Asesorado</option>
        </select>

        <div id="camposProfesor" class="campo-rol <?php echo ($row['rol'] == 'Profesor') ? '' : 'hidden'; ?>">
            <label for="area">Área:</label>
            <input type="text" name="area" value="<?php echo $row['area']; ?>">
        </div>


        <div id="camposTutor" class="campo-rol <?php echo ($row['rol'] == 'Tutor') ? '' : 'hidden'; ?>">
            <label for="areasEnseñanza">Áreas de Enseñanza:</label>
            <input type="text" name="areasEnseñanza" value="<?php echo $row['areasEnseñanza']; ?>">

            <label for="cuatrimestreTutor">Cuatrimestre:</label>
            <input type="number" name="cuatrimestreTutor" min="1" max="10" value="<?php echo $row['cuatrimestre']; ?>">
        </div>

   
        <div id="camposAsesorado" class="campo-rol <?php echo ($row['rol'] == 'Asesorado') ? '' : 'hidden'; ?>">
            <label for="cuatrimestreAsesorado">Cuatrimestre:</label>
            <input type="number" name="cuatrimestreAsesorado" min="1" max="10" value="<?php echo $row['cuatrimestre']; ?>">

            <label for="necesidades">Necesidades:</label>
            <input type="text" name="necesidades" value="<?php echo $row['necesidades']; ?>">
        </div>

        <div class="actions">
            <input type="submit" name="editar" value="Actualizar Usuario">
            <a href="index.php?action=consult" class="button-link back-button">
                Regresar
            </a>
        </div>
    </form>


    <script>
        function mostrarCampos() {
            const rol = document.getElementById("rol").value;

            document.getElementById("camposProfesor").classList.add("hidden");
            document.getElementById("camposTutor").classList.add("hidden");
            document.getElementById("camposAsesorado").classList.add("hidden");

            if (rol === "Profesor") {
                document.getElementById("camposProfesor").classList.remove("hidden");
            } else if (rol === "Tutor") {
                document.getElementById("camposTutor").classList.remove("hidden");
            } else if (rol === "Asesorado") {
                document.getElementById("camposAsesorado").classList.remove("hidden");
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
        
        // Ejecutar la función para asegurar que los campos iniciales estén visibles
        window.onload = mostrarCampos;
    </script>
</body>
</html>