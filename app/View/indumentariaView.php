<?php

require_once 'libs/smarty/libs/Smarty.class.php';

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "TodoRopa";
        }

        function renderHome($userData){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('userData', $userData, true);
            $smarty->display('templates/home.tpl');
        }

        function renderCategories($categories,$userData){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categories, false);
            $smarty->assign('userData', $userData, true);
            $smarty->display('templates/categories.tpl');
            
        }

        function renderProducts($categories, $products, $userData){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categoria', $categories, true);
            $smarty->assign('producto', $products, true);
            $smarty->assign('userData', $userData, true);
            $smarty->display('templates/productsByCategory.tpl');
        }

        function renderProduct($products, $userData) {
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('producto', $products, true);
            $smarty->assign('userData', $userData, true);
            $smarty->display('templates/product.tpl');
        }

        function renderAllProducsWithCategorys($productss,$categories, $userData, $cantPaginas, $pag){
            $smarty = new Smarty();
            var_dump($cantPaginas);
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categories, true);
            $smarty->assign('producto', $productss, true);
            $smarty->assign('userData', $userData, true);
            $smarty->assign('cantPaginas', count($cantPaginas), true);
            $smarty->assign('pag', 1 , true);
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