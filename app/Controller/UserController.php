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
        $userStatus = $this->AuthHelper->getUserStatus();
        $this->view->renderlogin("", $userStatus);
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

    function getUsers() {
        $this->AuthHelper->checkAdminUsser();
        $users = $this->model->getUsers();
        $userStatus = $this->AuthHelper->getUserStatus();
        $this->view->renderUsers($users, $userStatus);
    }
    
    function getUserBydId($params = null) {
        $this->AuthHelper->checkAdminUsser();
        $id = $params[':ID'];
        $users = $this->model->getUserById($id);
        $userStatus = $this->AuthHelper->getUserStatus();
        $this->view->renderUser($users, $userStatus);
    }

    function deleteUser($params = null) {
        $this->AuthHelper->checkAdminUsser();
        $id = $params[':ID'];
        $this->model->deleteUser($id);
        $this->view->renderUserLocation();  
    }

    function changeAdministrationPermissions($params = null) {
        $this->AuthHelper->checkAdminUsser();
        $id = $params[':ID'];
        $this->model->changeAdministrationPermissions($id);
        $this->view->renderUserLocation();
    }

    function showRegister(){
        $userStatus = $this->AuthHelper->getUserStatus();
        $this->view->renderRegister( $userStatus);
    }

    function insertUser(){
        $user = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $admin = 0;

        if ((isset($user)&&!empty($user))
        &&(isset($email)&&!empty($email))&&(isset($pass)&&!empty($pass))){

            $userFromDB = $this->model->getUser($email);
            if(isset($userFromDB) && $userFromDB){
             //   $this->view->renderRegister("El usuario existe"); CONSULTAR A DAVID
            }else{
                
                $password = password_hash ($pass , PASSWORD_DEFAULT );
                $this->model->insertUser($_POST['user'], $_POST['email'], $password, $admin);
                $this->verifyUser();
                header("Location: ".BASE_URL."home");
                //$this->view->showhomeLocation(); 
            } 
          
        }
    }
}

?>