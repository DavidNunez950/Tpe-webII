<?php

require_once 'libs/smarty/libs/Smarty.class.php';

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "TodoRopa";
        }

        function renderHome($loginIn, $userName){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->assign('userName', $userName, true);
            $smarty->display('templates/home.tpl');
        }

        function renderCategories($categories,$loginIn, $userName){ 
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categories, false);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->assign('userName', $userName, true);
            $smarty->display('templates/categories.tpl');
            
        }

        function renderProducts($categories, $products,$loginIn, $userName){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categoria', $categories, true);
            $smarty->assign('producto', $products, true);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->assign('userName', $userName, true);
            $smarty->display('templates/productsByCategory.tpl');
        }

        function renderProduct($products,$loginIn, $userName) {
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('producto', $products, true);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->assign('userName', $userName, true);
            $smarty->display('templates/product.tpl');
        }

        function renderAllProducsWithCategorys($productss, $categories, $loginIn, $userName){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categories, true);
            $smarty->assign('producto', $productss, true);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->assign('userName', $userName, true);
            $smarty->display('templates/products.tpl');
        }

        function showHomeLocation(){
            header("Location: ".BASE_URL."Home");
        }
        function showCategoriesLocation(){
            header("Location: ".BASE_URL."categories");
        }

        function showCategoryLocation($id_category){
            header("Location: ".BASE_URL."category/$id_category");
        }
        function showProductsLocation(){
            header("Location: ".BASE_URL."products");
        }
    }
?>