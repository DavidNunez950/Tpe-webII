<?php

require_once("libs/smarty/libs/Smarty.class.php");

class UserView{

    private $title;
    

    function __construct(){
        $this->title = "login";
    }

    function renderlogin($message = "", $userData){
        $smarty = new Smarty();
        $smarty->assign('titulo', $this->title, true);
        $smarty->assign('message', $message);
        $smarty->assign('BASE_URL', BASE_URL, true);
        $smarty->assign('userData', $userData, true);
        $smarty->display('templates/login.tpl');
    }

    function renderUsers($users, $userData) {
        $smarty = new Smarty();
        $smarty->assign('users', $users, true);
        $smarty->assign('BASE_URL', BASE_URL, true);
        $smarty->assign('userData', $userData, true);
        $smarty->display('templates/users.tpl'); 
    }

    function renderUser($user, $userData) {
        $smarty = new Smarty();
        $smarty->assign('user', $user, true);
        $smarty->assign('BASE_URL', BASE_URL, true);
        $smarty->assign('userData', $userData, true);
        $smarty->display('templates/user.tpl'); 
    }

    function renderUserLocation() {
        header("Location: ".BASE_URL."users");
    }
}

?>