<?php

    require_once("app/Model/ProductoModel.php");
    require_once("app/Model/CategoriaModel.php");
    require_once("app/View/indumentriaView.php");

    class IndumentariaController{

        private $view;
        private $CategoriaModel;
        private $ProductoModel;

        function __construct() {
            $this->view = new IndumentariaView();
            $this->CategoriaModel = new CategoriaModel();
            $this->ProductoModel = new ProductoModel();
        }

       /* function showHome(*$categoria*) {
            $categoria = $this->CategoriaModel->GetCategoria();
            $id_categoria = $categoria[0]->id;
            $producto = $this->ProductoModel->GetProducto($id_categoria);
            $this->view->showHome($categoria[0], $producto);
        }*/
        function Home() {
            $categoria = $this->CategoriaModel->GetCategoria();
            $this->view->showHome($categoria);
        }


        function showProducto($id) {
            //code
        }

        function loggin($id) {
            //code
        }

        function InsertCategoria(){
            
            $this->CategoriaModel-> InsertCategoria($_POST['input_url_img'],$_POST['input_coleccion']);
            $this->view->ShowHomeLocation();
        } 
        function DeleteCategoria($params = null){
            $id_categoria = $params[':ID'];
            $this->CategoriaModel->DeleteCategoria($id_categoria);
            $this->view->ShowHomeLocation();
        }
        function EditCategoria($params = null){
            $id_categoria = $params[':ID'];
            $this->CategoriaModel->EditCategoria($id_categoria);
            $this->view->ShowHomeLocation();
        }
        function VerCategoria($params = null){
            $id_categoria = $params[':ID'];
            $productos = $this->ProductoModel->GetProducto($id_categoria);
            $this->view->showProductosPorCategoria($productos);
        }

    }
?>