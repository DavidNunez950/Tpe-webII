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

        function showProducto($params = null){
            $this->checkLoggedIn(); 
            $colection = $params[':COLECCION'];
            $id_categoria = $this->CategoriaModel->GetCategoriaPorColeccion($colection);
            $producto = $this->ProductoModel->GetProducto($id_categoria[0]->id);
            $this->view->showProducto($id_categoria[0]->id, $producto);
        }

        function insertProductoEnCategoria(){
            $this->checkLoggedIn();
            $this->ProductoModel->InsertProducto($_POST['color'], $_POST['talle'], $_POST['tipo']);
            //$this->view->ShowCategoriasLocation($colection);
            $this->view->ShowHomeLocation();
        }

        function editProducto($params = null){
            $this->checkLoggedIn();
            $id_producto = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductoModel->EditProducto($id_producto, $_POST['color'], $_POST['talle'], $_POST['tipo']);
            }
            $this->view->ShowHomeLocation();
        }

        function deleteProducto($params = null){
            $this->checkLoggedIn();
            $id_producto = $params[':ID'];
            $this->ProductoModel->DeleteProducto($id_producto);
            //$this->view->ShowCategoriasIDLocation($id_producto);
            $this->view->ShowHomeLocation();
        }
        function Home() {

           $this->checkLoggedIn();
           $this->view->showHome(); 
            
        }
        function Categorias() {
            $this->checkLoggedIn();
            $categoria = $this->CategoriaModel->GetCategoria();
            $this->view->showCategorias($categoria);
        }

        function insertCategoria(){
            $this->checkLoggedIn();
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
    

    }
?>