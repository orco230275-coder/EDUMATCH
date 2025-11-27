<?php

    // Incluir el modelo y la conexion a la BD
    include_once "app/models/AsignaturasModel.php";
    include_once "config/db_connection.php";

    // Clase de controlador
    class AsignaturasController{
        private $model;

        // Constructor de la clase
        public function __construct($connection){
            
            $this -> model = new AsignaturasModel($connection);
        }


        // metodo para consultar las asignaturas
        public function consultarAsignaturas() {
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $asignaturas = $this->model->consultarAsignaturas();
            include_once "app/views/gestion_asignaturas.php";
        }


        // obtiene todas las asignaturas para mostrarlas
        public function obtenerAsignaturas() {
            return $this->model->obtenerAsignaturas();
        }
    }


  

    



















    