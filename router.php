<?php 
    define("BASE_URL", '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/');
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

    $r->addRoute("home", "GET", "IndumentariaController", "showHome");
    $r->addRoute("categories", "GET", "IndumentariaController", "showCategories");

    $r->addRoute("login", "GET", "UserController", "login");
    $r->addRoute("logout", "GET", "UserController", "logout");
    $r->addRoute("verifyUser", "POST", "UserController", "verifyUser");
    
    $r->addRoute("products", "GET", "IndumentariaController", "showAllProducts");
    $r->addRoute("product/:ID", "GET", "IndumentariaController", "showProductById");
    $r->addRoute("insertProduct/:ID", "POST", "IndumentariaController", "insertProductsInCategoryByGET");
    $r->addRoute("deleteProduct/:ID", "GET", "IndumentariaController", "deleteProducts");
    $r->addRoute("editProduct/:ID", "POST", "IndumentariaController", "editProducts");

    $r->addRoute("insertCategory", "POST", "IndumentariaController", "insertCategory");
    $r->addRoute("deleteCategory/:ID", "GET", "IndumentariaController", "deleteCategory");
    $r->addRoute("editCategory/:ID", "POST", "IndumentariaController", "editCategory");
    $r->addRoute("category/:ID", "GET", "IndumentariaController", "showProducts");
    $r->addRoute("insertProductInCategory", "POST", "IndumentariaController", "insertProductsInCategoryByPOST");

    $r->setDefaultRoute("IndumentariaController", "showHome");

    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>

