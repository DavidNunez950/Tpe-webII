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

    }
?>