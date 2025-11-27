<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premios Registrados</title>
    <link rel="stylesheet" href="public/css/premios_registrados.css">
</head>
<body>
    <div class="consult-premio">

    <div class="container">
        <h1>Premios Registrados</h1>
        <hr>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Premio</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $premios->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_premio']; ?></td>
                    <td><?php echo $row['nombre_premio']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>

                    <td class="action-buttons">
                        <a href="index.php?action=editarPremio&id=<?php echo $row['id_premio']; ?>">
                            <button class="edit-button">Editar</button>
                        </a>

                        <a href="index.php?action=deletePremio&id=<?php echo $row['id_premio']; ?>"
                           onclick="return confirm('¿Seguro que deseas eliminar este premio?');">
                            <button class="delete-button">Eliminar</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="main-button-group">
        <a href="index.php?action=gestion_premios">
            <button class="add-button">Registrar Nuevo Premio</button>
        </a>

        <a href="index.php?action=panelProfesor">
            <button class="back-button">Volver</button>
        </a>
    </div>

</div>
