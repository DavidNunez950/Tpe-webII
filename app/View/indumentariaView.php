<?php

require_once 'libs/smarty/libs/Smarty.class.php';

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "s";
        }

        function RenderHome(){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->display('templates/home.tpl');
        }

        function RenderCategories($categories,$loginIn){ 
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categories, false);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->display('templates/categories.tpl');
            
        }

        function RenderProducts($categories, $products,$loginIn){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categoria', $categories, true);
            $smarty->assign('producto', $products, true);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->display('templates/productsByCategory.tpl');
            
        }
        function RenderAllProducsWithCategorys($productss, $categories, $loginIn){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categories, true);
            $smarty->assign('producto', $productss, true);
            $smarty->assign('loginIn', $loginIn, false);
            $smarty->display('templates/products.tpl');
        }

        function ShowHomeLocation(){
            header("Location: ".BASE_URL."Home");
        }
        function ShowCategoriesLocation(){
            header("Location: ".BASE_URL."categories");
        }

        function ShowCategoryLocation($id_category){
            header("Location: ".BASE_URL."category/$id_category");
        }
        function ShowProductsLocation(){
            header("Location: ".BASE_URL."products");
        }
    }
?>