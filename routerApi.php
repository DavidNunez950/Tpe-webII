<?php

require_once('api/apiController.php');
require_once('api/apiCommentaryController.php');
require_once('RouterClass.php');

if(!empty($_GET['resource'])) {
    $resource = $_GET['resource'];
}else {
    $resource = "";
}

$r = new Router();


$r->setDefaultRoute("apiCommentaryController", "");
$r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 

?>