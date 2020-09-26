<?php

require_once('libs/smarty/libs/Smarty.class.php');

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "Subject";
        }

        function showHome($categoria, $producto){
            $smarty = new Smarty();
            // var_dump($categoria);
            // var_dump($producto);
            $smarty->assign('categoria', $categoria, true);
            $smarty->assign('producto', $producto, true);
            $smarty-> display('templates/tabla.tpl');
        }

        function showProducto($productosPoriddecoategoria){
        }

        function showLoggin(){
        }

        function ShowHomeLocation(){
            header("Location: ".BASE_URL."home");
        }
    }
?>