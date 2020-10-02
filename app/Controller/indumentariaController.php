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

        function showHome(/*$categoria*/) {
        }

        function showProducto(/*$id_categoria*/) {
            $categoria = $this->CategoriaModel->GetCategoria();
            $id_categoria = $categoria[0]->id;
            // $categoria = $this->CategoriaModel->GetCategoria($id_categoria);
            // $id_categoria = $categoria->id;
            $producto = $this->ProductoModel->GetProducto($id_categoria);
            $this->view->showProducto(($categoria[0]), $producto);
        }

        function insertarProductoEnCategoria($params = null){
            $id_categoria = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductoModel->InsertProducto($_POST['color'], $id_categoria, $_POST['talle'], $_POST['tipo']);
            }
            $this->view->ShowHomeLocation();
        }

        function editarProducto($params = null){
            $id_producto = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductoModel->EditProducto($id_producto, $_POST['color'], $_POST['talle'], $_POST['tipo']);
            }
            $this->view->ShowHomeLocation();
        }

        function borrarProducto($params = null){
            $id_producto = $params[':ID'];
            $this->ProductoModel->DeleteProducto($id_producto);
            $this->view->ShowHomeLocation();
        }

        function loggin($id) {
            //code
        }

    }
?>