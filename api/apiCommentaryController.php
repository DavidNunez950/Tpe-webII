<?php

require_once('api/ApiController.php');
require_once('app/Model/CommentaryModel.php');
require_once('api/ApiView.php');

class ApiCommentaryController extends ApiController {

    public function __construct() {
        parent::__construct();
        $this->view = new ApiView();
        $this->model = new CommentaryModel();
    }

    function showCommentary($params = null){
        $id_product = $params[':ID'];
        $commentary= $this->model->getCommentariesByProduct($id_product);
        $this->view->response($commentary, 200);
    
    }

    function deleteCommentary($params = null){
        $id_commentary = $params[':ID'];
        $this->checkForComment($id_commentary);
        $this->model->deleteCommentary($id_commentary);
        $this->view->response("Se borro", 200);
    }

    function insertCommentary(){
        $body = $this->getData();
        $id = $this->model->insertCommentary($body->text,$body->star,$body->date,$body->id_product,$body->id_user);     
        if (empty ($this->model->getCommentaryById($id))) {
            $this->view->response("Cant insert commentary", 500);
           
        } else{
            $this->view->response("Se inserto", 200);
        } 
    }

    function editCommentary($params = null){
        $id_commentary = $params[':ID'];
        $body = $this->getData();
        $this->checkForComment($id_commentary);      
        $this->model->updateCommentary($body->text,$body->star,$id_commentary);
        $this->view->response("Se edito", 200);

    }

    function checkForComment($id){
        if (empty($this->model->getCommentaryById($id))){
            $this->view->response("Not found commentary with id=$id", 404);
            die();
        }
    }



    


  
} 