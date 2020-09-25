<?php 
   /* define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    require_once('Controller/streamingController.php');
    if(!empty($_GET['action'])) {
        $action = $_GET['action'];
    }else {
        $action = "home";
    }
    $params = explode("/", $action);
    $controller = new StreamingController();
    switch ($params[0]) {
        case  'home':
            $controller->showHome();
            break;
        case  'insert-game':
            $controller->insertGame();
            break;
        case  'addBet':
            $controller->insertBet($params[1]);
            break;
        case  'delete':
            $controller->deleteGame($params[1]);
            break;
        default:
            break;
    }*/

    
    require_once 'Controller/indumentariaController.php';
    //require_once 'Controller/indumentariaAdvanceController.php';
    require_once 'RouterClass.php';
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $r = new Router();

    // rutas
    $r->addRoute("home", "GET", "IndumentariaController", "Home");
    //$r->addRoute("mermelada", "GET", "TasksController", "Home");

    //Esto lo veo en TasksView
    $r->addRoute("insert", "POST", "IndumentariaController", "InsertPago");
    $r->addRoute("edit", "GET", "IndumentariaController", "EditPago");

    $r->addRoute("delete/:ID", "GET", "IndumentariaController", "BorrarLaTaskQueVienePorParametro");
    $r->addRoute("completar/:ID", "GET", "IndumentariaController", "MarkAsCompletedTask");

    //Ruta por defecto.
    $r->setDefaultRoute("IndumentariaController", "Home");

    //Advance
    $r->addRoute("advance", "GET", "IndumentariaAdavanceController", "Mostrar");
    $r->addRoute("autocompletar", "GET", "IndumentariaAdavanceController", "AutoCompletar");

    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>

