<?php

require_once("libs/smarty/libs/Smarty.class.php");

class UserView{

    private $title;
    

    function __construct(){
        $this->title = "login";
    }

    function renderlogin($message = ""){
        $smarty = new Smarty();
        $smarty->assign('titulo_s', $this->title, true);
        $smarty->assign('message', $message);
        $smarty->assign('BASE_URL', BASE_URL, true);
        $smarty->display('templates/login.tpl'); // muestro el template 
    }
}


?>