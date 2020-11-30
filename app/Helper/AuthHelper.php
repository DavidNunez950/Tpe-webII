<?php

require_once("app/Model/UserModel.php");

    class AuthHelper {

        private $Model;

        function __construct() {
            $this->Model = new UserModel();
        }

        function login($user){
            session_start();
            $_SESSION['ID'] = $user->id;
            $_SESSION["NAME"] = $user->name;
            $_SESSION["EMAIL"] = $user->email;
            $_SESSION["ROL"] = $user->admin;
        }

        function logout(){
            session_start();
            session_destroy();
        }

        // 1.a Función para chekear que el usuario está logeado y no realise accines de ABM con las url del sitio
        function checkLoggedIn(){
            if($this->getUserStatus()['user']['rol']['colab']!=true) {
                header("Location: ".LOGIN);
                die();
            }else{
                $this->verifyTine();
            }
        }

        function checkAdminUsser(){
            if($this->getUserStatus()['user']['rol']['admin']!=true){
                header("Location: ".LOGIN);
                die();
            } else { 
                $this->verifyTine();
            }
        }

        function verifyTine() {
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) { 
                header("Location: ".LOGOUT);
                die();
            } 
            $_SESSION['LAST_ACTIVITY'] = time();
        }

        function getUserStatus(){
            session_start();
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

            $userStatus['user']['id'] = (isset($_SESSION['ID'])) ? $_SESSION['ID'] : false;
            $userStatus['user']['name'] = (isset($_SESSION['NAME'])) ? $_SESSION['NAME'] : false;
            $userStatus['user']['email'] = (isset($_SESSION['EMAIL'])) ? $_SESSION['EMAIL'] : false;
            $userStatus['user']['rol']['colab'] = (isset($_SESSION['ROL'])&&($_SESSION['ROL']>=0) )? true : false;
            $userStatus['user']['rol']['admin'] = (isset($_SESSION['ROL'])&&($_SESSION['ROL']==1)) ? true : false;
                

            return $userStatus;
        }
    }
?>