<?php

    // inicializando la sesion de usuario
    session_start();

    //Clase Conectar
    class Conectar{

        protected $dbh;

        //Funcion protegida de la cadena de conexion
        protected function Conexion(){
            try{
                //cadena de conexion
                $conectar = $this->dbh = new PDO("mysql:local=localhost;port=3306;dbname=engiecerti_diplomas","root","");
                return $conectar;
            }catch(Exception $e){
                //En caso hubiera un error en la cadena de conexion
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        //Para poder impedir que tengamos problemas con las ñ o tildes
        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        //Ruta principal del Proyecto
        public static function ruta(){
            return "http://localhost/CAPSTONE_PROYECT/";
        }
    }
?>