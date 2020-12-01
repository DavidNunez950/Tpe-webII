<?php

    require_once("app/Model/ProductoModel.php");
    require_once("app/Model/CategoriaModel.php");
    require_once("app/View/indumentariaView.php");
    require_once("app/Helper/AuthHelper.php");

    class IndumentariaController{

        private $view;
        private $CategoryModel;
        private $ProductModel;
        private $AuthHelper;

        function __construct() {
            $this->view = new IndumentariaView();
            $this->CategoryModel = new CategoryModel();
            $this->ProductModel = new ProductModel();
            $this->AuthHelper =  new AuthHelper();
        }

        // 0.a Funcion para ver el home de la página
        function showHome() {
            $userStatus = $this->AuthHelper->getUserStatus();
            $this->view->renderHome($userStatus);
        }

        // 1.a Funciones para ver Categorys
        function showCategories() {
            $category = $this->CategoryModel->getCategories();
            $userStatus = $this->AuthHelper->getUserStatus();
            $this->view->renderCategories($category, $userStatus);
        }

        // 1.b Funciones para realizar acciones de ABM con la tabla de Categorys
        function insertCategory(){
            $this->AuthHelper->checkLoggedIn();
            if ((isset($_POST['url_img'])&&!empty($_POST['url_img']))
            &&(isset($_POST['coleccion'])&&!empty($_POST['coleccion']))) {
                $this->CategoryModel-> insertCategory($_POST['url_img'],$_POST['coleccion']);
                $this->view->showCategoriesLocation();
            }
        }         

        function deleteCategory($params = null){
            $this->AuthHelper->checkLoggedIn();
            $id_category = $params[':ID'];
            $this->CategoryModel->deleteCategory($id_category);
            $this->view->showCategoriesLocation();
        }

        function editCategory($params = null){
            $this->AuthHelper->checkLoggedIn();
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
            $userData = $this->AuthHelper->getUserStatus();
            $this->view->renderProducts($category[0], $products,$userData);
        }

        function showProductById($params = null){
            $id_product = $params[':ID'];
            $products = $this->ProductModel->getProductsById($id_product);
            $userData = $this->AuthHelper->getUserStatus();
            $this->view->renderProduct($products,$userData);
        }

        // 2.b Funciones para realizar acciones de ABM con productss
        function insertProductsInCategoryByGET($params = null){
            $this->AuthHelper->checkLoggedIn();
            $destino = null;
            $id_category = $params[':ID'];
            if(isset($_POST['color']) && isset($_POST['talle']) && isset($_POST['tipo'])) { 
                $this->ProductModel->insertProduct($_POST['color'], $_POST['talle'], $_POST['tipo'], $id_category, $destino);
            }
            $this->view->showCategoryLocation($id_category);
        }
        
        function editProducts($params = null){
            $this->AuthHelper->checkLoggedIn();
            $id_products = $params[':ID'];
            if ((isset($_POST['color'])&&!empty($_POST['color']))
            &&(isset($_POST['talle'])&&!empty($_POST['talle']))
            &&(isset($_POST['tipo'])&&!empty($_POST['tipo']))) {
                $this->ProductModel->editProduct($_POST['tipo'], $_POST['color'], $_POST['talle'], $id_products,);
            } 
            $this->view->showCategoriesLocation();
        }

        function deleteProducts($params = null){
            $this->AuthHelper->checkLoggedIn();
            $id_product = $params[':ID'];
            $id_category = ($this->ProductModel->getProductsById($id_product))->id_categoria;
            $this->ProductModel->deleteProduct($id_product);
            $this->view->showCategoryLocation($id_category);
        }

        // 3.a Función para ver todas las Categorys con sus productss
        function showAllProducts($params = null) {
            $conectorLogico = ($_GET['conectorLogico'] == 'on') ? true : false;
            $cantPag = ceil((($this->ProductModel->getCountProducts($conectorLogico, $_GET['prenda'], $_GET['color'], $_GET['talle'], $_GET['coleccion']))->cant)/5);
            $page = (!isset($params[':PAGE'])||$params[':PAGE']<1) ? 1 : $params[':PAGE'];
            $page = ($page > $cantPag) ? $cantPag : $page;
            $index =  ($page - 1) * 5;
            $products = $this->ProductModel->getFilteredProducts($index, $conectorLogico, $_GET['prenda'], $_GET['color'], $_GET['talle'], $_GET['coleccion']);
            $category = $this->CategoryModel->getCategories();
            $userData = $this->AuthHelper->getUserStatus();
            $this->view->renderAllProducsWithCategorys($products,$category, $userData, $cantPag, $page, ('?prenda='.$_GET['prenda'].'&color='.$_GET['color'].'&talle='.$_GET['talle'].'&coleccion='.$_GET['coleccion'].''));
        }

        // 3.b Función para insertar products en Category por POST
        function insertProductsInCategoryByPOST() {
            $this->AuthHelper->checkLoggedIn();
            $destino = null;
            if ((isset($_POST['color'])&&!empty($_POST['color']))
            &&(isset($_POST['talle'])&&!empty($_POST['talle']))
            &&(isset($_POST['tipo'])&&!empty($_POST['tipo']))
            &&(isset($_POST['id_category'])&&!empty($_POST['id_category']))) {
                $this->ProductModel->insertProduct($_POST['color'], $_POST['talle'], $_POST['tipo'], $_POST['id_category'],$destino);
            } 
            $this->view->showProductsLocation();
        }

        // 4 ABM de imágenes
        function deleteImage($params = null){
            $this->AuthHelper->checkLoggedIn();
            $id_product = $params[':ID'];
            $id_category = ($this->ProductModel->getProductsById($id_product))->id_categoria;
            $this->ProductModel->deleteImage($id_product);
            $this->view->showCategoryLocation($id_category);
        }

        function editImage($params = null){
            $this->AuthHelper->checkLoggedIn();
            $id_products = $params[':ID'];
            $destino = null;
            if ((isset($_FILES['img']))) {
                $uploads = getcwd() . "//uploads/";
                $destino = tempnam($uploads, $_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], $destino);
                $destino = basename($destino);
                $this->ProductModel->editImage($destino, $id_products,);
            } 
            $this->view->showCategoriesLocation();
        }
    }
?>    
