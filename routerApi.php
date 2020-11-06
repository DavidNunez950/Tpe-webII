<?php

require_once('api/ApiController.php');
require_once('api/ApiCommentaryController.php');
require_once('RouterClass.php');


$r = new Router();

$r->addRoute("commentary/:ID", "GET", "ApiCommentaryController", "showCommentary");
$r->addRoute("commentary", "POST", "ApiCommentaryController", "insertCommentary");
$r->addRoute("commentary/:ID", "DELETE", "ApiCommentaryController", "deleteCommentary");

$r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 

?>