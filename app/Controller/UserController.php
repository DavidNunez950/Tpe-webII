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
        $this->view->renderlogin($userStatus, "");
    }

    function logout(){
        $this->AuthHelper->logout();
        header("Location: ".LOGIN);
    }

    function verifyUser(){
        $userStatus = $this->AuthHelper->getUserStatus();
        $name = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        if(isset($name)&&isset($email)){
            $userFromDB = $this->model->getUser($name);  
            if(isset($userFromDB) && $userFromDB){ 
                if (password_verify($pass, $userFromDB->password)){
                    session_start();
                    $this->AuthHelper->login($userFromDB);
                    $_SESSION['LAST_ACTIVITY'] = time();
                    header("Location: ".BASE_URL."home");
                } else {
                    $this->view->renderlogin($userStatus, "Contraseña incorrecta");
                }
            }else{
                $this->view->renderlogin($userStatus, "El usuario no existe");
            }
        } else {
            $this->view->renderlogin($userStatus, "Complete todos campos");
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
        $admin = ($this->model->getUserById($id)->admin==1) ? 0 : 1;
        if (($this->model->getNumberUserAdmin())->cant > 1 || $admin == 1) {
            $this->model->changeAdministrationPermissions($id, $admin);
        }
        $this->view->renderUserLocation();
    }

    function showRegister(){
        $userStatus = $this->AuthHelper->getUserStatus();
        $this->view->renderRegister($userStatus, "");
    }

    function insertUser() {
        $userStatus = $this->AuthHelper->getUserStatus();
        $name = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $admin = 0; 
        if ((isset($name)&&!empty($name)) &&
            (isset($email)&&!empty($email))&&
            (isset($pass)&&!empty($pass))) { 
            $userFromDB = $this->model->getUser($name);
            if(!($userFromDB)) { 
                $password = password_hash ($pass , PASSWORD_DEFAULT);
                $this->model->insertUser($name, $email, $password, $admin);
                $this->verifyUser();
                header("Location: ".BASE_URL."home");
            } else {
                $this->view->renderRegister($userStatus, "Ya existe un usuario con ese nombre");
            }
        } else {
            $this->view->renderRegister($userStatus, "Complete todos los campos");
        }
    }
}

?>