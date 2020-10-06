<?php

    require_once("app/Model/ProductoModel.php");
    require_once("app/Model/CategoriaModel.php");
    require_once("app/View/indumentariaView.php");

    class IndumentariaController{

        private $view;
        private $CategoriaModel;
        private $ProductoModel;

        function __construct() {
            $this->view = new IndumentariaView();
            $this->CategoriaModel = new CategoriaModel();
            $this->ProductoModel = new ProductoModel();
        }

        // 1.a Funciones para ver categorias

        function Home() {
            // $this->checkLoggedIn();
            $categoria = $this->CategoriaModel->GetCategoria();
            $this->view->showHome($categoria);
        }
        // 1.b Funciones para realizar acciones de ABM con la tabla de categorias

        function insertCategoria(){
            // $this->checkLoggedIn();
            $this->CategoriaModel-> InsertCategoria($_POST['input_url_img'],$_POST['input_coleccion']);
            $this->view->ShowHomeLocation();
        } 

        function deleteCategoria($params = null){
            $this->checkLoggedIn();
            $id_categoria = $params[':ID'];
            $this->CategoriaModel->DeleteCategoria($id_categoria);
            $this->view->ShowHomeLocation();
        }

        function editCategoria($params = null){
            $this->checkLoggedIn();
            $id_categoria = $params[':ID'];
            $url_img = $_POST['url_img'];
            $coleccion= $_POST['coleccion'];
            $this->CategoriaModel->EditCategoria($id_categoria, $url_img, $coleccion);
            $this->view->ShowHomeLocation();
        }

        // 2.a Funciones para ver categorias
        function showProducto($params = null){
            // $this->checkLoggedIn();
            $id_categoria = $params[':ID'];
            $IsUserLogin = $this->IsUserLogin();
            $categoria =  $this->CategoriaModel->GetCategoriaPorID($id_categoria);
            $producto = $this->ProductoModel->GetProducto($id_categoria);
            $this->view->showProducto($categoria[0], $producto,$IsUserLogin);
        }

        // 2.b Funciones para realizar acciones de ABM con productos
        function insertProductoEnCategoria($params = null){
            // $this->checkLoggedIn();
            $id_categoria = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductoModel->InsertProducto($_POST['color'], $_POST['talle'], $_POST['tipo'], $id_categoria);
            }
            $this->view->ShowHomeLocation();
        }

        function editProducto($params = null){
            // $this->checkLoggedIn();
            $id_producto = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductoModel->EditProducto($id_producto, $_POST['color'], $_POST['talle'], $_POST['tipo']);
            }
            $this->view->ShowHomeLocation();
        }

        function deleteProducto($params = null){
            // $this->checkLoggedIn();
            $id_producto = $params[':ID'];
            $this->ProductoModel->DeleteProducto($id_producto);
            $this->view->ShowHomeLocation();
        }

        function Categorias() {
            // $this->checkLoggedIn();
            $categoria = $this->CategoriaModel->GetCategoria();
            $IsUserLogin = $this->IsUserLogin();
            $this->view->showCategorias($categoria,$IsUserLogin);
        }

        private function checkLoggedIn(){
            session_start();
            
            if(!isset($_SESSION["EMAIL"])){
                header("Location: ". LOGIN);
                die();
            }else{
                if ( isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000000)) { 
                    header("Location: ". LOGOUT);
                    die();
                } 
            
                $_SESSION['LAST_ACTIVITY'] = time();
            }
        }
        function IsUserLogin(){
            session_start();
            return $_SESSION["EMAIL"] != null;
        }
    

    }
?>