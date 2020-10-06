<?php 
    define("BASE_URL", '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');
    require_once('app/Controller/indumentariaController.php');
    require_once('app/Controller/UserController.php');
    require_once 'RouterClass.php';
    if(!empty($_GET['action'])) {
        $action = $_GET['action'];
    }else {
        $action = "home";
    }
    $r = new Router(); 

    $r->addRoute("home", "GET", "indumentariaController", "Home");
    $r->addRoute("categorias", "GET", "indumentariaController", "Categorias");

    $r->addRoute("login", "GET", "UserController", "Login");
    $r->addRoute("logout", "GET", "UserController", "Logout");
    $r->addRoute("verifyUser", "POST", "UserController", "VerifyUser");
    
    $r->addRoute("insertProducto/:ID", "POST", "indumentariaController", "insertProductoEnCategoria");
    $r->addRoute("deleteProducto/:ID", "GET", "indumentariaController", "deleteProducto");
    $r->addRoute("editProducto/:ID", "POST", "indumentariaController", "editProducto");

    $r->addRoute("insertCategoria", "POST", "indumentariaController", "insertCategoria");
    $r->addRoute("deleteCategoria/:ID", "GET", "indumentariaController", "deleteCategoria");
    $r->addRoute("editCategoria/:ID", "POST", "indumentariaController", "editCategoria");
    $r->addRoute("categoria/:ID", "GET", "indumentariaController", "showProducto");

    $r->setDefaultRoute("IndumentariaController", "Home");

    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>

