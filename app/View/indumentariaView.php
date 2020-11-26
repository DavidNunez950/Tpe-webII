<?php

require_once('libs/smarty/libs/Smarty.class.php');

    class IndumentariaView {

        private $title;
        private $smarty;
    
        function __construct(){
            $this->smarty = new Smarty();
            $this->title  = "TodoRopa";
        }

        function renderHome($userData){
            $this->smarty->assign('BASE_URL', BASE_URL);
            $this->smarty->assign('userData', $userData, true);
            $this->smarty->display('templates/home.tpl');
        }

        function renderCategories($categories,$userData){
            $this->smarty->assign('BASE_URL', BASE_URL);
            $this->smarty->assign('categorias', $categories, false);
            $this->smarty->assign('userData', $userData, true);
            $this->smarty->display('templates/categories.tpl');
            
        }

        function renderProducts($categories, $products, $userData){
            $this->smarty->assign('BASE_URL', BASE_URL);
            $this->smarty->assign('categoria', $categories, true);
            $this->smarty->assign('producto', $products, true);
            $this->smarty->assign('userData', $userData, true);
            $this->smarty->display('templates/productsByCategory.tpl');
        }

        function renderProduct($products, $userData) {
            $this->smarty->assign('BASE_URL', BASE_URL);
            $this->smarty->assign('producto', $products, true);
            $this->smarty->assign('userData', $userData, true);
            $this->smarty->display('templates/product.tpl');
        }

        function renderAllProducsWithCategorys($productss,$categories, $userData, $cantPaginas, $pag){
            $this->smarty->assign('BASE_URL', BASE_URL);
            $this->smarty->assign('categorias', $categories, true);
            $this->smarty->assign('producto', $productss, true);
            $this->smarty->assign('userData', $userData, true);
            $this->smarty->assign('cantPaginas', count($cantPaginas), true);
            $this->smarty->assign('pag', 1 , true);
            $this->smarty->display('templates/products.tpl');
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