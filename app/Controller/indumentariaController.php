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
            $loginIn = $this->isUserLogin();
            $userName = $this->getUserLoged();
            $this->view->renderHome($loginIn, $userName);
        }

        // 1.a Funciones para ver Categorys
        function showCategories() {
            $category = $this->CategoryModel->getCategories();
            $loginIn = $this->isUserLogin();
            $userName = $this->getUserLoged();
            $this->view->renderCategories($category,$loginIn, $userName);
        }

        // 1.b Funciones para realizar acciones de ABM con la tabla de Categorys
        function insertCategory(){
            $this->checkLoggedIn();
            if ((isset($_POST['url_img'])&&!empty($_POST['url_img']))
            &&(isset($_POST['coleccion'])&&!empty($_POST['coleccion']))) {
                $this->CategoryModel-> insertCategory($_POST['url_img'],$_POST['coleccion']);
                $this->view->showCategoriesLocation();
                echo "saasd";
            }
        }         

        function deleteCategory($params = null){
            $this->checkLoggedIn();
            $id_category = $params[':ID'];
            $this->CategoryModel->deleteCategory($id_category);
            $this->view->showCategoriesLocation();
        }

        function editCategory($params = null){
            $this->checkLoggedIn();
            $id_category = $params[':ID'];
            if ((isset($_POST['url_img'])&&!empty($_POST['url_img']))
            &&(isset($_POST['coleccion'])&&!empty($_POST['coleccion']))) {
                $this->CategoryModel->editCategory($id_category, $_POST['url_img'], $_POST['coleccion']);
                $this->view->showCategoriesLocation();
            }
        }

        // 2.a Funciones para ver los productss
        function showProducts($params = null){
            $id_category = $params[':ID'];
            $category =  $this->CategoryModel->getCategoryById($id_category);
            $products = $this->ProductModel->getProductsByIdCategory($id_category);
            $loginIn = $this->isUserLogin();
            $userName = $this->getUserLoged();
            $this->view->renderProducts($category[0], $products,$loginIn, $userName);
        }

        function showProductById($params = null){
            $id_product = $params[':ID'];
            $products = $this->ProductModel->getProductsById($id_product);
            $loginIn = $this->isUserLogin();
            $userName = $this->getUserLoged();
            $this->view->renderProduct($products[0],$loginIn, $userName);
        }

        // 2.b Funciones para realizar acciones de ABM con productss
        function insertProductsInCategoryByGET($params = null){
            $this->checkLoggedIn();
            $id_category = $params[':ID'];
            if(isset($_POST['color'])&&isset($_POST['talle'])&&isset($_POST['tipo'])) {
                $this->ProductModel->insertProduct($_POST['color'], $_POST['talle'], $_POST['tipo'], $id_category);
            }
            $this->view->showCategoryLocation($id_category);
        }

        function editProducts($params = null){
            $this->checkLoggedIn();
            $id_products = $params[':ID'];
            if ((isset($_POST['color'])&&!empty($_POST['color']))
            &&(isset($_POST['talle'])&&!empty($_POST['talle']))
            &&(isset($_POST['tipo'])&&!empty($_POST['tipo']))) { 
                $this->ProductModel->editProduct($id_products, $_POST['color'], $_POST['talle'], $_POST['tipo']);
            }
            $this->view->showCategoriesLocation();
        }

        function deleteProducts($params = null){
            $this->checkLoggedIn();
            $id_products = $params[':ID'];
            $this->ProductModel->deleteProduct($id_products);
            $this->view->showCategoriesLocation();
        }

        // 3.a Función para ver todas las Categorys con sus productss
        function showAllProducts(){
            $productss = $this->ProductModel->getProductsWithCategory();
            $category = $this->CategoryModel->getCategories();
            $loginIn = $this->isUserLogin();
            $userName = $this->getUserLoged();
            $this->view->renderAllProducsWithCategorys($productss,$category, $loginIn, $userName);
        }

        // 3.b Función para insertar products en Category por POST
        function insertProductsInCategoryByPOST() {
            $this->checkLoggedIn();
            if ((isset($_POST['color'])&&!empty($_POST['color']))
            &&(isset($_POST['talle'])&&!empty($_POST['talle']))
            &&(isset($_POST['tipo'])&&!empty($_POST['tipo']))
            &&(isset($_POST['id_category'])&&!empty($_POST['id_category']))) { 
                $this->ProductModel->insertProduct($_POST['color'], $_POST['talle'], $_POST['tipo'], $_POST['id_category']);
                $this->view->showCategoryLocation($_POST['id_category']);
            } else {
                $this->view->showProductsLocation();
            }
        }

        // 4.a Función para chekear que el usuario está logeado y no realise accines de ABM con las url del sitio
        private function checkLoggedIn(){
            session_start();
            if(!$this->isUserLogin()){
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

        // 4.b Función para chekear que el usuario está logeado y mostrar, o no, el HTML para realizar las acciones de ABM
        function isUserLogin(){
            session_start();
            return (isset($_SESSION["NAME"])&&isset($_SESSION["EMAIL"]));
        }

        // 4.c Obtener el nmbre de usuario
        function getUserLoged(){
            session_start();
            if($this->isUserLogin()) {
                return $_SESSION["NAME"];
            }
        }
    }
?>    
