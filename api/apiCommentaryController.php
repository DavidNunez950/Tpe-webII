<?php

require_once('api/ApiController.php');
require_once('app/Model/CommentaryModel.php');
require_once('app/Model/ProductoModel.php');
require_once('api/ApiView.php');

class ApiCommentaryController extends ApiController {

    private $productModel;

    public function __construct() {
        parent::__construct(); // Agregar helper
        $this->view = new ApiView();
        $this->model = new CommentaryModel();
        $this->productModel = new ProductModel();
    }

    function showCommentary($params = null){
        $id_product = $params[':ID'];
        $product = $this->productModel->getProductsById($id_product);
        if (empty($product)){
            $this->view->response("Not found product with id=$id_product", 404);
            die();
        }
        $commentary= $this->model->getCommentariesByProduct($id_product);
        $this->view->response($commentary, 200);
    
    }

    function insertCommentary(){
        $body = $this->getData();
        try {
            $id = $this->model->insertCommentary($body->text,$body->star,$body->date,$body->id_product,$body->id_user);     
            $commentary = $this->model->getCommentaryById($id);
            $status = 200;
            if(empty($commentary)) {
                $commentary = "Cant insert commentary";
                $status = 500;
            }
            $this->view->response($commentary, $status);
        } catch(Exception $e) {
            $this->view->response("Internal server error", 500);
        }  
    }

    function deleteCommentary($params = null){
        $id_commentary = $params[':ID'];
        $commentary = $this->model->getCommentaryById($id_commentary);
        $this->checkIfResorseisNotFound($commentary, $id_commentary);
        $this->model->deleteCommentary($id_commentary);
        $this->view->response("Succesfuly deleted", 200);
    }

    function editCommentary($params = null){
        $id_commentary = $params[':ID'];
        $body = $this->getData();
        $commentary = $this->model->getCommentaryById($id_commentary);
        $this->checkIfResorseisNotFound($commentary, $id_commentary);
        try {
            $this->model->updateCommentary($body->text,$body->star,$id_commentary);
            $this->view->response("Succesfuly updated", 200);
        } catch(exception $e) {
            $this->view->response("Internal server error", 500);
        }  
    }

    function checkIfResorseisNotFound($commentary, $id){
        if (empty($commentary)){
            $this->view->response("Not found commentary with id=$id", 404);
            die();
        }
    }
} 