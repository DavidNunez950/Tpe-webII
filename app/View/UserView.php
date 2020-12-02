<?php

require_once("libs/smarty/libs/Smarty.class.php");

class UserView{

    private $title;
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
        $this->title = "login";
    }

    function renderlogin($userData, $message){
        $this->smarty->assign('titulo', $this->title, true);
        $this->smarty->assign('message', $message);
        $this->smarty->assign('BASE_URL', BASE_URL, true);
        $this->smarty->assign('userData', $userData, true);
        $this->smarty->display('templates/login.tpl');
    }

    function renderUsers($users, $userData) {
        $this->smarty->assign('users', $users, true);
        $this->smarty->assign('BASE_URL', BASE_URL, true);
        $this->smarty->assign('userData', $userData, true);
        $this->smarty->display('templates/users.tpl'); 
    }

    function renderUser($user, $userData) {
        $this->smarty->assign('user', $user, true);
        $this->smarty->assign('BASE_URL', BASE_URL, true);
        $this->smarty->assign('userData', $userData, true);
        $this->smarty->display('templates/user.tpl'); 
    }

    function renderRegister($userStatus, $message){
        $this->smarty->assign('BASE_URL', BASE_URL, true);
        $this->smarty->assign('message', $message);
        $this->smarty->assign('userData', $userStatus, true);
        $this->smarty->display('templates/register.tpl'); 
    }

    function renderUserLocation() {
        header("Location: ".BASE_URL."users");
    }
}

?>