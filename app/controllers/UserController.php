<?php

    // Incluir el modelo y la conexion a la BD
    include_once "app/models/UserModel.php";
    include_once "config/db_connection.php";



    // Clase de controlador
    class UserController{

        private $model;

        // Constructor de la clase
        public function __construct($connection){
            $this -> model = new UserModel($connection);

        }

        // Método para obtener la información del formulario
        public function insertarUsuario() {
            if (isset($_POST['enviar'])) {
                $nombre = trim($_POST['nombre']);
                $apellidos = trim($_POST["apellidos"]);
                $correo = trim($_POST["correo"]);
                $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
                $rol = $_POST["rol"];

                // Campos opcionales
                $area = $_POST["area"] ?? '';
                $areasEnseñanza = $_POST["areasEnseñanza"] ?? '';
                $necesidades = $_POST["necesidades"] ?? '';

                // cuatrimestre según el rol
                if ($rol === 'Tutor') {
                    $cuatrimestre = $_POST['cuatrimestreTutor'] ?? null;
                } elseif ($rol === 'Asesorado') {
                    $cuatrimestre = $_POST['cuatrimestreAsesorado'] ?? null;
                } else {
                    $cuatrimestre = null;
                }

                // Validar correo institucional
                if (!preg_match('/^[a-zA-Z0-9._%+-]+@upemor\.edu\.mx$/', $correo)) {
                    echo "<script>alert('Solo se permiten correos institucionales (@upemor.edu.mx)'); window.history.back();</script>";
                    exit();
                }

                // Verificar si el correo ya existe
                $verificar = $this->model->verificarUsuario($correo);
                if ($verificar) {
                    echo "<script>alert('El correo ya está registrado. Usa otro.'); window.history.back();</script>";
                    exit();
                }

                // Insertar en la base de datos
                $insert = $this->model->insertarUsuario(
                    $nombre, $apellidos, $correo, $contraseña,
                    $rol, $area, $areasEnseñanza, $cuatrimestre, $necesidades
                );

                if ($insert) {
                    echo "<script>alert('Registro exitoso'); window.location='index.php?action=login';</script>";
                } else {
                    echo "<script>alert('Error al registrar usuario'); window.history.back();</script>";
                }
            }

            // Mostrar la vista del formulario
            include_once "app/views/form_insert.php";
        }



        //insertar usuario como profesor
        public function insertarUsuarioProfesor() {
            if (isset($_POST['enviar'])) {
                $nombre = trim($_POST['nombre']);
                $apellidos = trim($_POST["apellidos"]);
                $correo = trim($_POST["correo"]);
                $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
                $rol = $_POST["rol"];

                // Campos opcionales
                $area = $_POST["area"] ?? '';
                $areasEnseñanza = $_POST["areasEnseñanza"] ?? '';
                $necesidades = $_POST["necesidades"] ?? '';

                // cuatrimestre según el rol
                if ($rol === 'Tutor') {
                    $cuatrimestre = $_POST['cuatrimestreTutor'] ?? null;
                } elseif ($rol === 'Asesorado') {
                    $cuatrimestre = $_POST['cuatrimestreAsesorado'] ?? null;
                } else {
                    $cuatrimestre = null;
                }

                // Validar correo institucional
                if (!preg_match('/^[a-zA-Z0-9._%+-]+@upemor\.edu\.mx$/', $correo)) {
                    echo "<script>alert('Solo se permiten correos institucionales (@upemor.edu.mx)'); window.history.back();</script>";
                    exit();
                }

                // Verificar si el correo ya existe
                $verificar = $this->model->verificarUsuario($correo);
                if ($verificar) {
                    echo "<script>alert('El correo ya está registrado. Usa otro.'); window.history.back();</script>";
                    exit();
                }

                // Insertar en la base de datos
                $insert = $this->model->insertarUsuario(
                    $nombre, $apellidos, $correo, $contraseña,
                    $rol, $area, $areasEnseñanza, $cuatrimestre, $necesidades
                );

                if ($insert) {
                    echo "<script>alert('Usuario registrado exitosamente'); window.location='index.php?action=formInsert2';</script>";
                } else {
                    echo "<script>alert('Error al registrar usuario'); window.history.back();</script>";
                }

            }
            // Mostrar la vista del formulario
            include_once "app/views/Profesor/form_insert2.php";
        }


        //Metodo para consultar usuarios
        public function consultarUsuarios(){
             if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

            $usuario = $this -> model -> consultarUsuarios();

            include_once "app/views/consult.php";
        }

        public function actualizarUsuario() {

            if (isset($_POST['editar'])) {

                $id = (int)$_GET['id'];

                $nombre = $_POST['nombre'];
                $apellidos = $_POST["apellidos"];
                $correo = $_POST["correo"];
                $rol = $_POST["rol"];

                // Campos opcionales
                $area = null;
                $areasEnseñanza = null;
                $cuatrimestre = null;
                $necesidades = null;

                
                if ($rol == 'Profesor') {
                    $area = $_POST["area"] ?? null;

                } elseif ($rol == 'Tutor') {
                    $areasEnseñanza = $_POST["areasEnseñanza"] ?? null;
                    $cuatrimestre = $_POST["cuatrimestreTutor"] ?? null;

                } elseif ($rol == 'Asesorado') {
                    $cuatrimestre = $_POST["cuatrimestreAsesorado"] ?? null;
                    $necesidades = $_POST["necesidades"] ?? null;
                }


                $update = $this->model->actualizarDatosUsuario(
                    $id, $nombre, $apellidos, $correo,
                    $rol, $area, $areasEnseñanza, $cuatrimestre, $necesidades
                );

                if ($update) {
                    echo "<script>alert('Usuario actualizado correctamente'); window.location='index.php?action=consult';</script>";
                } else {
                    echo "<script>alert('Error al actualizar el usuario'); window.history.back();</script>";
                }

            } else if (isset($_GET['id']) && is_numeric($_GET['id'])) {

                $id_browser = (int) $_GET['id'];
                $row = $this->model->consultarPorID($id_browser);

                include_once "app/views/edit.php";

            } else {
                echo "ID no valido";
            }
        }



        //metodo para eliminar usuario
        public function eliminarUsuario() {
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = (int) $_GET['id'];

                $delete = $this->model->eliminarUsuario($id);

                if ($delete) {
                    echo "<script>alert('Usuario eliminado correctamente'); 
                    window.location='index.php?action=consult';</script>";
                } else {
                    echo "<script>alert('Error al eliminar el usuario'); 
                    window.location='index.php?action=consult';</script>";
                }
            } else {
                echo "<script>alert('ID inválido'); 
                window.location='index.php?action=consult';</script>";
            }
        }
        
        //inicio de sesion validando
        public function loginUsuario() {
               if (session_status() === PHP_SESSION_NONE) {
                    session_start();
               }
            if (isset($_POST['ingresar'])) {
                $correo = $_POST['correo'];
                $pass_form = $_POST['pass']; 

                // Buscar usuario en la base de datos
                $usuario = $this->model->verificarUsuario($correo);

                if ($usuario) {
                    // Validar contraseña
                    if (password_verify($pass_form, $usuario['contraseña'])) {

                        // Guardar datos en sesión
                        $_SESSION['id_usuario'] = $usuario['id_usuario'];
                        $_SESSION['nombre_usuario'] = $usuario['nombre'];
                        $_SESSION['apellidos_usuario'] = $usuario['apellidos'];
                        $_SESSION['rol_usuario'] = $usuario['rol'];

                        // Redirigir según el rol
                        switch ($usuario['rol']) {
                            case 'Asesorado':
                                header("Location: index.php?action=panelAsesorado");
                                exit;
                            case 'Profesor':
                                header("Location: index.php?action=panelProfesor");
                                exit;
                            case 'Tutor':
                                header("Location: index.php?action=panelTutor");
                                exit;
                            default:
                                echo "<script>alert('Rol no reconocido');</script>";
                                break;
                        }
                    } else {
                        echo "<script>alert('Contraseña incorrecta');</script>";
                    }
                } else {
                    echo "<script>alert('Usuario no encontrado');</script>";
                }
            }

    include_once "app/views/login.php";
        }

        //Respaldo de la base de datos
           public function realizarRespaldoBD(){

            $server = "localhost";
            $user = "root";
            $password = "";
            $db = "sa_prueba";

           $backup = $this -> model -> backup_tables($server, $user, $password, $db);

           echo $backup;

           $fecha = date("Y-m-d");

            //funcion que permite crear y nombrar el archivo
           header("Content-disposition: attachment; filename=db-backup-".$fecha.".sql");

           //permite que el archivo se descargue y no se ejecute
           header("content-type: MIME");

            //leer el archivo del escrip y mandarlo con descarga al navegador
           readfile("config/backups/db-backup-".$fecha.".sql");

        }

        // Metodo para la restauración
        public function restaurarBD(){
            $fecha = date("Y-m-d");

            $ruta = "config/backups/db-backup-" . $fecha .".sql";

           $restore = $this -> model -> restaurarBD($ruta);

            include_once "app/views/Profesor/gestion_reportes.php";
;
        }

    }