<?php
    //Crear las variables del servidor
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "sa_prueba";

    //Función para la conexión a la BD
    $connection = new mysqli($server, $user, $password, $db);

    if ($connection->connect_errno) {
         //conexión fallida
         die("Fallo la conexión: " . $connection->connect_errno);
    } else {
        //conexión exitosa
        echo "";
    }

?>