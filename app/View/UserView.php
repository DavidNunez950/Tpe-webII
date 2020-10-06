<?php

require_once "libs/smarty/libs/Smarty.class.php";

class UserView{

    private $title;
    

    function __construct(){
        $this->title = "Login";
    }

    function ShowLogin($message = ""){
        $smarty = new Smarty();
        $smarty->assign('titulo_s', $this->title, true);
        $smarty->assign('message', $message);
        $smarty->assign('BASE_URL', BASE_URL, true);
        var_dump(BASE_URL);
        $smarty->display('templates/login.tpl'); // muestro el template 
    }


}


?>