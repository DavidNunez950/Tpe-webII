<?php

require_once('libs/smarty/libs/Smarty.class.php');

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "Subject";
        }

        function showHome($categorias){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categorias', $categorias, true);
            $smarty->display('templates/categorias.tpl');
            
        }

        function showProducto($categoria, $producto){
            $smarty = new Smarty();
            $smarty->assign('BASE_URL', BASE_URL);
            $smarty->assign('categoria', $categoria, true);
            $smarty->assign('producto', $producto, true);
            $smarty-> display('templates/tabla.tpl');
        }
        function showLoggin(){
        }

        function ShowHomeLocation(){
            header("Location: ".BASE_URL."home");
        }
    }
?>