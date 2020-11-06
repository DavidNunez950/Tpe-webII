<?php

require_once('api/ApiController.php');
require_once('app/Model/CommentaryModel.php');
require_once('api/ApiView.php');

class apiCommentaryController extends ApiController {
 

    public function __construct() {
        parent::__construct();
        $this->view = new ApiView();
        $this->model = new CommentaryModel();
    }

    function showCommentary($params = null){
        $id_product = $params[':ID'];
        $commentary= $this->model->getComentariesByProduct($id_product);
        // if (!empty($commentary)) // verifica si la tarea existe
             $this->view->response($commentary, 200);
        // else
        //     $this->view->response(" con el id=$id_product no existe", 404);

    }

    function deleteCommentary($params = null){
        $id_commentary = $params[':ID'];
        $this->model->deleteComentary($id_commentary);
        $this->view->response("Se borro", 200);
       
    }

    function insertCommentary(){
        $body = $this->getData();
        $this->model->insertCommentary($body->text,$body->star,$body->date,$body->id_product,$body->id_user);     
        
    }


  
} 