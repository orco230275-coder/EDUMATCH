<?php

    //Crear una clase de modelo
    class UserModel{
        
        private $connection;

        //Crear constructor para recibir la conexion
        public function __construct($connection){
            $this -> connection = $connection; //Se puede utizar cualquier palabra
        }

        // Metodo para insertar en la base de datos
        public function insertarUsuario($nombre, $apellidos, $correo, $contraseña, $rol,
        $area, $areasEnseñanza, $cuatrimestre, $necesidades){

            $sql_statement = "INSERT INTO usuario (nombre, apellidos, correo, contraseña, rol, area, areasEnseñanza,
            cuatrimestre, necesidades) VALUES (?,?,?,?,?,?,?,?,?)";

            $statement = $this -> connection -> prepare($sql_statement);
            
            if (empty($cuatrimestre)) {
                $cuatrimestre = null;
            }
            $statement -> bind_param("sssssssss",$nombre, $apellidos, $correo, $contraseña, $rol,
            $area, $areasEnseñanza, $cuatrimestre, $necesidades);

            //Mandar el resultado de la inserción
            return $statement -> execute();

        }

        //Metodo para consultar usuarios
        public function consultarUsuarios(){
            $sql_statement = "SELECT * FROM usuario";

            $result = $this -> connection -> query($sql_statement);

            return $result;
        }

        public function consultarPorID($id_browser){

            $sql_statement = "SELECT * FROM usuario WHERE id_usuario = ?";

            $statement = $this -> connection -> prepare($sql_statement);
            $statement -> bind_param("i", $id_browser);

            $statement -> execute();

            $result = $statement -> get_result();
            
            return $result -> fetch_assoc();
        }

        public function actualizarDatosUsuario($id, $nombre, $apellidos, $correo, $rol, $area, $areasEnseñanza, $cuatrimestre, $necesidades){
            
            $sql = "UPDATE usuario SET nombre = ?, apellidos = ?, correo = ?, rol = ?, area = ?, 
                        areasEnseñanza = ?, cuatrimestre = ?, necesidades = ? WHERE id_usuario = ?";
            $statement = $this -> connection -> prepare($sql);
            $statement -> bind_param("ssssssisi", $nombre, $apellidos, $correo, $rol, $area, $areasEnseñanza, $cuatrimestre, $necesidades, $id);

            return $statement -> execute();
        }

        
        public function verificarUsuario($correo){
            $sql = "SELECT * FROM usuario WHERE correo = ?";
            $statement = $this -> connection -> prepare($sql);
            $statement -> bind_param("s", $correo);
            $statement -> execute();
            
            $result = $statement -> get_result();
            
            return $result -> fetch_assoc(); 
        }



        public function eliminarUsuario($id){
            $sql = "DELETE FROM usuario WHERE id_usuario = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            return $statement->execute();
        }
        //metodo para el respaldo de la BD
        public function backup_tables($host,$user,$pass,$name,$tables = '*'){
            $return='';
            $link = new mysqli($host,$user,$pass,$name);
            
            // Se obtienen los nombres de las tablas de datos si se eligen todas
            if($tables == '*')
            {
                $tables = array();
                $result = $link->query('SHOW TABLES');
                // Guardar tablas de la base de datos
                while($row = mysqli_fetch_row($result))
                {
                    $tables[] = $row[0];
                }
            }
            else
            {
                $tables = is_array($tables) ? $tables : explode(',',$tables);
            }
            
        // Obtener registros de la tabla
        foreach ($tables as $table) {

            $result = $link->query("SELECT * FROM `$table`");
            $num_fields = mysqli_num_fields($result);

            // Obtener estructura
            $row2 = mysqli_fetch_row($link->query("SHOW CREATE TABLE `$table`"));

            $return .= "\n\nDROP TABLE IF EXISTS `$table`;\n";
            $return .= $row2[1] . ";\n\n";

            // Insertar datos
            while ($row = mysqli_fetch_row($result)) {

                $return .= "INSERT INTO `$table` VALUES(";

                for ($j = 0; $j < $num_fields; $j++) {

                    if ($row[$j] === null) {
                        $return .= "NULL";
                    } else {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);
                        $return .= '"' . $row[$j] . '"';
                    }

                    if ($j < $num_fields - 1) {
                        $return .= ",";
                    }
                }

                $return .= ");\n";  
            }

            $return .= "\n\n";
        }


            // Guardar el nombre de la tabla de datos
            $fecha=date("Y-m-d");

            $handle = fopen('config/backups/db-backup-'.$fecha.'.sql','w+');
                fwrite($handle,$return);
                fclose($handle);
        }
    
    // Metodo para restaurar la base de datos
    
        public function restaurarBD($ruta){

            $this->connection->query("SET FOREIGN_KEY_CHECKS = 0");

                $query_archivo = file_get_contents($ruta);

                if($this->connection->multi_query($query_archivo)){
                    do{
                        if($result = $this->connection->store_result()){
                            $result->free();
                        }
                    } while ($this->connection->more_results() && $this->connection->next_result());

                    $this->connection->query("SET FOREIGN_KEY_CHECKS = 1");

                    return "Restauración exitosa :D";
                } else {
                    return "Error en la restauración :(";
                }
        }       

    }