<?php 

    define("BASE_URL", '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    require_once('app/Controller/indumentariaController.php');
    require_once 'RouterClass.php';
    
    $r = new Router();

    $r->addRoute("home", "GET", "indumentariaController", "showProducto");

    $r->addRoute("insertar/:ID", "POST", "indumentariaController", "insertarProductoEnCategoria");
    $r->addRoute("modificar/:ID", "POST", "indumentariaController", "editarProducto");
    $r->addRoute("borrar/:ID", "GET", "indumentariaController", "borrarProducto");

    $r->setDefaultRoute("IndumentariaController", "showHome");


    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>

