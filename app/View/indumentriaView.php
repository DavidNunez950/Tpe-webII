<?php

require_once('libs/smarty/libs/Smarty.class.php');

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "Subject";
        }

        function showProducto($categoria, $producto){
            $smarty = new Smarty();
            // var_dump($categoria);
            // var_dump($producto);
            $smarty->assign('categoria', $categoria, true);
            $smarty->assign('producto', $producto, true);
            $smarty-> display('templates/tabla.tpl');
        }
        
        function showHome($categorias){
            $smarty = new Smarty();
            $smarty->assign('categorias', $categorias);
           
            $smarty->display('templates/categorias.tpl');
            
        }



        function showLoggin(){
        }

        function ShowHomeLocation(){
            header("Location: ".BASE_URL."home");
        }
    }
?>