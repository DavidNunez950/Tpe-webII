<?php

    require_once("app/Model/ProductoModel.php");
    require_once("app/Model/CategoriaModel.php");
    require_once("app/View/indumentariaView.php");

    class IndumentariaController{

        private $view;
        private $CategoryModel;
        private $ProductModel;

        function __construct() {
            $this->view = new IndumentariaView();
            $this->CategoryModel = new CategoryModel();
            $this->ProductModel = new ProductModel();
        }

        // 0.a Funcion para ver el home de la página
        function showHome() {
            $this->view->RenderHome();
        }

        // 1.a Funciones para ver Categorys
        function showCategories() {
            $category = $this->CategoryModel->GetCategories();
            $loginIn = $this->IsUserLogin();
            $this->view->RenderCategories($category,$loginIn);
        }

        // 1.b Funciones para realizar acciones de ABM con la tabla de Categorys
        function insertCategory(){
            $this->checkLoggedIn();
            if ((isset($_POST['input_url_img'])&&!empty($_POST['input_url_img']))
            &&(isset($_POST['input_coleccion'])&&!empty($_POST['input_coleccion']))) {
                $this->CategoryModel-> InsertCategory($_POST['input_url_img'],$_POST['input_coleccion']);
                $this->view->ShowCategoriesLocation();
            }
        }         

        function deleteCategory($params = null){
            $this->checkLoggedIn();
            $id_category = $params[':ID'];
            $this->CategoryModel->DeleteCategory($id_category);
            $this->view->ShowCategoriesLocation();
        }

        function editCategory($params = null){
            $this->checkLoggedIn();
            $id_category = $params[':ID'];
            if ((isset($_POST['url_img'])&&!empty($_POST['url_img']))
            &&(isset($_POST['coleccion'])&&!empty($_POST['coleccion']))) {
                $this->CategoryModel->EditCategory($id_category, $_POST['coleccion'], $_POST['url_img'], );
                $this->view->ShowCategoriesLocation();
            }
        }

        // 2.a Funciones para ver los productss
        function showProducts($params = null){
            $id_category = $params[':ID'];
            $loginIn = $this->IsUserLogin();
            $category =  $this->CategoryModel->GetCategoryById($id_category);
            $products = $this->ProductModel->GetProductsById($id_category);
            $this->view->RenderProducts($category[0], $products,$loginIn);
        }

        // 2.b Funciones para realizar acciones de ABM con productss
        function insertProductsInCategoryByGET($params = null){
            $this->checkLoggedIn();
            $id_category = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductModel->InsertProduct($_POST['color'], $_POST['talle'], $_POST['tipo'], $id_category);
            }
            $this->view->ShowCategoryLocation($id_category);
        }

        function editProducts($params = null){
            $this->checkLoggedIn();
            $id_products = $params[':ID'];
            if ((isset($_POST['color'])&&!empty($_POST['color']))
            &&(isset($_POST['talle'])&&!empty($_POST['talle']))
            &&(isset($_POST['tipo'])&&!empty($_POST['tipo']))) { 
                $this->ProductModel->EditProduct($id_products, $_POST['color'], $_POST['talle'], $_POST['tipo']);
            }
            $this->view->ShowCategoriesLocation();
        }

        function deleteProducts($params = null){
            $this->checkLoggedIn();
            $id_products = $params[':ID'];
            $this->ProductModel->DeleteProduct($id_products);
            $this->view->ShowCategoriesLocation();
        }

        // 3.a Función para ver todas las Categorys con sus productss
        function ShowAllProducts(){
            $productss = $this->ProductModel->GetProductsWithCategory();
            $category = $this->CategoryModel->GetCategories();
            $loginIn = $this->IsUserLogin();
            $this->view->renderAllProducsWithCategorys($productss,$category, $loginIn);
        }

        // 3.b Función para insertar products en Category por POST
        function insertProductsInCategoryByPOST() {
            $this->checkLoggedIn();
            if ((isset($_POST['color'])&&!empty($_POST['color']))
            &&(isset($_POST['talle'])&&!empty($_POST['talle']))
            &&(isset($_POST['tipo'])&&!empty($_POST['tipo']))
            &&(isset($_POST['id_category'])&&!empty($_POST['id_category']))) { 
                $this->ProductModel->InsertProduct($_POST['color'], $_POST['talle'], $_POST['tipo'], $_POST['idCategory']);
                $this->view->ShowCategoryLocation($_POST['id_category']);
            } else {
                $this->view->ShowProductsLocation();
            }
        }

        // 4.a Función para chekear que el usuario está logeado y no realise accines de ABM con las url del sitio
        private function checkLoggedIn(){
            session_start();
            if(!isset($_SESSION["EMAIL"])){
                header("Location: ".LOGIN);
                die();
            }else{
                if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000000)) { 
                    header("Location: ".LOGOUT);
                    die();
                } 
                $_SESSION['LAST_ACTIVITY'] = time();
            }
        }

        // 4.a Función para chekear que el usuario está logeado y mostrar, o no, el HTML para realizar las acciones de ABM
        function IsUserLogin(){
            session_start();
            return isset($_SESSION["EMAIL"]);
        }
    }
