<?php 
    define("BASE_URL", '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    require_once('app/Controller/indumentariaController.php');
    require_once 'RouterClass.php';
    if(!empty($_GET['action'])) {
        $action = $_GET['action'];
    }else {
        $action = "home";
    }
    $r = new Router(); 

    $r->addRoute("home", "GET", "indumentariaController", "Home");
    $r->addRoute("categorias", "GET", "indumentariaController", "Categorias");

    // $r->addRoute("home", "GET", "indumentariaController", "showProducto");
    
    $r->addRoute("categoria/insertProducto", "POST", "indumentariaController", "insertProductoEnCategoria");
    $r->addRoute("categoria/deleteProducto/:ID", "GET", "indumentariaController", "deleteProducto");
    $r->addRoute("categoria/editProducto/:ID", "POST", "indumentariaController", "editProducto");

    $r->addRoute("insertCategoria", "POST", "indumentariaController", "insertCategoria");
    $r->addRoute("deleteCategoria/:ID", "GET", "indumentariaController", "deleteCategoria");
    $r->addRoute("editCategoria/:ID", "POST", "indumentariaController", "editCategoria");
    $r->addRoute("categoria/:COLECCION", "GET", "indumentariaController", "showProducto");

    $r->setDefaultRoute("IndumentariaController", "Home");


    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>

