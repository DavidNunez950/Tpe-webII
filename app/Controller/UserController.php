<?php

require_once("app/Model/UserModel.php");
require_once("app/View/UserView.php");

class UserController{

    private $view;
    private $model;

    function __construct(){
        $this->view = new UserView();
        $this->model = new UserModel();
    }

    function Login(){
        $this->view->RenderLogin();
    }

    function Logout(){
        session_start();
        session_destroy();
        header("Location: ".LOGIN);
    }

    function VerifyUser(){
        $user = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        if(isset($email)){
            $userFromDB = $this->model->GetUser($email);
            if(isset($userFromDB) && $userFromDB){  
                if (password_verify($pass, $userFromDB->password)){
                    session_start();
                    $_SESSION["EMAIL"] = $userFromDB->email;
                    $_SESSION['LAST_ACTIVITY'] = time();
                    header("Location: ".BASE_URL."home");
                }else{
                    $this->view->RenderLogin("Contraseña incorrecta");
                }
            }else{
                $this->view->RenderLogin("El usuario no existe");
            }
        }
    }
}

?>