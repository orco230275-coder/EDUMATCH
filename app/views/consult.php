<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Usuarios</title>

    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body class="consultar-usuarios">

    <div class="container">
    <h1>Usuarios Registrados</h1>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Area</th>
                <th>Areas de enseñanza</th>
                <th>Cuatrimestre</th>
                <th>Necesidades</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $usuario->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id_usuario'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['apellidos'] ?></td>
                    <td><?= $row['correo'] ?></td>
                    <td><?= $row['rol'] ?></td>
                    <td><?= $row['area'] ?></td>
                    <td><?= $row['areasEnseñanza'] ?></td>
                    <td><?= $row['cuatrimestre'] ?></td>
                    <td><?= $row['necesidades'] ?></td>
                    <td class="action-buttons">
                        <a href="index.php?action=update&id=<?= $row['id_usuario'] ?>">
                            <button class="btn-editar">Editar</button> 
                        </a>
                        <a href="index.php?action=delete&id=<?= $row['id_usuario'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">
                            <button class="btn-eliminar">Eliminar</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
    <div>
    <a href="index.php?action=gestion_usuarios">
        <button class="regresar-btn">Regresar</button>
    </a>
    </div>            

</body>
</html>