<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis premios</title>
    <link rel="stylesheet" href="public/css/mis_premios.css">
</head>
<body>

    <div class="main-container">
        <h2>Mis Premios</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Premio</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $premio->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row["id_premio"] ?></td>
                    <td><?= $row["nombre_premio"] ?></td>
                    <td><?= $row["descripcion"] ?></td>
                    <td><?= $row["estado"] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="index.php?action=panelTutor" class="back-btn">Volver</a>

    </div>

</body>
</html>
