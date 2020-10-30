<?php

require_once("app/Model/UserModel.php");

    class AuthHelper {

        private $Model;

        function __construct() {
            $this->Model = new UserModel();
        }
        
        function login($user){
            session_start();
            $_SESSION["NAME"] = $user->user;
            $_SESSION["EMAIL"] = $user->email;
        }

        function logout(){
            session_start();
            session_destroy();
        }
    
        // 1.a Función para chekear que el usuario está logeado y no realise accines de ABM con las url del sitio
        function checkLoggedIn(){
            session_start();
            if(!$this->isUserLogin()){
                header("Location: ".LOGIN);
                die();
            }else{
                if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000000)) { 
                    header("Location: ".LOGOUT);
                    die();
                } 
                $_SESSION['LAST_ACTIVITY'] = time();
            }
        }

        // 1.b Función para chekear que el usuario está logeado y mostrar, o no, el HTML para realizar las acciones de ABM
        function isUserLogin(){
            session_start();
            return (isset($_SESSION["NAME"])&&isset($_SESSION["EMAIL"]));
        }

        // 1.c Obtener el nmbre de usuario
        function getUserLoged(){
            session_start();
            if($this->isUserLogin()) {
                return $_SESSION["NAME"];
            }
        }
    }


?>