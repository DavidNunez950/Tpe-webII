<?php

require_once("app/Model/UserModel.php");

    class AuthHelper {

        private $Model;

        function __construct() {
            $this->Model = new UserModel();
        }

        function login($id_user){
            session_start();
            $_SESSION['ID'] = $id_user;
        }

        function logout(){
            session_start();
            session_destroy();
        }

        // 1.a Función para chekear que el usuario está logeado y no realise accines de ABM con las url del sitio
        function checkLoggedIn(){
            if($this->getUserStatus()['user']['rol']['colab']!=true) {
                $this->sendMessage("Se necesita ser usuario colaborador para realizar esa acción, debes logearte primero");
                header("Location: ".LOGIN);
                die();
            }else{
                $this->verifyTine();
            }
        }

        function checkAdminUsser(){
            if($this->getUserStatus()['user']['rol']['admin']!=true){
                $this->sendMessage("Se necesita ser usuario administrador para realizar esa acción, debes logearte primero");
                header("Location: ".LOGIN);
                die();
            } else { 
                $this->verifyTine();
            }
        }

        function verifyTine() {
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { 
                header("Location: ".LOGOUT);
                die();
            } 
            $_SESSION['LAST_ACTIVITY'] = time();
        }

        function getUserStatus(){
            if (!isset($_SESSION)){
                session_start();
            }
            $userStatus = array(
                'user' => array( 
                    'id' => false,
                    'name' => false,
                    'email'=> false,
                    'rol' => array( 
                        'colab' => false,
                        'admin' => false,
                    )
                ),
            );
            
            if(isset($_SESSION['ID'])){
                $user = $this->Model->getUserById($_SESSION['ID']);
                if ($user){
                    $userStatus['user']['id'] = $user->id;
                    $userStatus['user']['name'] = $user->name;
                    $userStatus['user']['email'] = $user->email;
                    $userStatus['user']['rol']['colab'] = ($user->admin < 1)? true : false;
                    $userStatus['user']['rol']['admin'] = ($user->admin == 1)? true : false;
                }

            }
          
            return $userStatus;
        }

        function sendMessage($message) {
            session_start();
            $_SESSION["MESSAGE"] = $message;
        }

        function getMessage() {
            $message = (isset($_SESSION["MESSAGE"]) && $_SESSION["MESSAGE"]!="") ? $_SESSION["MESSAGE"] : "";
            $_SESSION["MESSAGE"] = "";
            return  $message;
        }
    }
