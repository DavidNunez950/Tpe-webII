<?php

require_once("app/Model/UserModel.php");
require_once("app/View/UserView.php");

class UserController{

    private $view;
    private $model;
    private $AuthHelper;

    function __construct(){
        $this->view = new UserView();
        $this->model = new UserModel();
        $this->AuthHelper =  new AuthHelper();
    }

    function login(){
        $this->view->renderlogin();
    }

    function logout(){
        $this->AuthHelper->logout();
        header("Location: ".LOGIN);
    }

    function verifyUser(){
        $user = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        if(isset($email)){
            $userFromDB = $this->model->getUser($email);
            if(isset($userFromDB) && $userFromDB){  
                if (password_verify($pass, $userFromDB->password)){
                    session_start();
                    $this->AuthHelper->login($userFromDB);
                    $_SESSION['LAST_ACTIVITY'] = time();
                    header("Location: ".BASE_URL."home");
                }else{
                    $this->view->renderlogin("Contraseña incorrecta");
                }
            }else{
                $this->view->renderlogin("El usuario no existe");
            }
        }
    }
}

?>