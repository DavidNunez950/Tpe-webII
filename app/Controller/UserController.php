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
        $message = $this->AuthHelper->getMessage();
        $this->view->renderlogin($userStatus, $message);
    }

    function logout(){
        $this->AuthHelper->logout();
        header("Location: ".LOGIN);
    }

    function verifyUser(){
        $name = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        session_start();
        if(isset($name)&&isset($email)){
            $userFromDB = $this->model->getUser($name, $email);  
            if(isset($userFromDB) && $userFromDB){ 
                if (password_verify($pass, $userFromDB->password)){
                    $this->AuthHelper->login($userFromDB);
                    $_SESSION['LAST_ACTIVITY'] = time();
                    header("Location: ".BASE_URL."home");
                } else {
                    $this->AuthHelper->sendMessage("Contraseña incorrecta");
                    header("Location: ".LOGIN);
                }
            }else{
                $this->AuthHelper->sendMessage("No existe usuario con ese mail y/o nombre");
                header("Location: ".LOGIN);
            }
        } else {
            $this->AuthHelper->sendMessage("Complete todos los campos");
            header("Location: ".LOGIN);
        }
    }

    function getUsers() {
        $this->AuthHelper->checkAdminUsser();
        $users = $this->model->getUsers();
        $userStatus = $this->AuthHelper->getUserStatus();
        $message = $this->AuthHelper->getMessage();
        $this->view->renderUsers($users, $userStatus, $message);
    }

    function getUserBydId($params = null) {
        $this->AuthHelper->checkLoggedIn();
        $id = $params[':ID'];
        $users = $this->model->getUserById($id);
        $userStatus = $this->AuthHelper->getUserStatus();
        $this->view->renderUser($users, $userStatus);
    }

    function deleteUser($params = null) {
        $this->AuthHelper->checkAdminUsser();
        $id = $params[':ID'];
        $deletedUser = $this->model->getUserById($id);
        if (($this->model->getNumberUserAdmin())->cant > 1 || $deletedUser->admin != 1) {
            $this->model->deleteUser($id);
        } else {
            $this->AuthHelper->sendMessage("No pudes eliminar tu cuenta porque eres él último administrador!!!");
        }
        $this->view->renderUserLocation();  
    }

    function changeAdministrationPermissions($params = null) {
        $this->AuthHelper->checkAdminUsser();
        $id = $params[':ID'];
        $admin = ($this->model->getUserById($id)->admin==1) ? 0 : 1;
        if (($this->model->getNumberUserAdmin())->cant > 1 || $admin == 1) {
            $this->model->changeAdministrationPermissions($id, $admin);
        } else {
            $this->AuthHelper->sendMessage("No se puede eliminar al último administrador!!!");
        }
        $this->view->renderUserLocation();
    }

    function showRegister(){
        $userStatus = $this->AuthHelper->getUserStatus();
        $message = $this->AuthHelper->getMessage();
        $this->view->renderRegister($userStatus, $message);
    }

    function insertUser() {
        $name = $_POST["user"];        
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $admin = 0; 
        if ((isset($name)&&!empty($name)) &&
            (isset($email)&&!empty($email))&&
            (isset($pass)&&!empty($pass))) { 
            $userFromDB = $this->model->getUser($name, $email);
            if(!($userFromDB)) { 
                $password = password_hash ($pass , PASSWORD_DEFAULT);
                $this->model->insertUser($name, $email, $password, $admin);
                $this->verifyUser();
                header("Location: ".BASE_URL."home");
            } else {
                $this->AuthHelper->sendMessage("Ya existe un usuario con ese nombre");
                header("Location: ".REGISTER);
            }
        } else {
            $this->AuthHelper->sendMessage("Complete todos los campos");
            header("Location: ".REGISTER);
        }
    }
}

?>