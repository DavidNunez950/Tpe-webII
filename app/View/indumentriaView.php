<?php

require_once('libs/smarty/libs/Smarty.class.php');

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "Subject";
        }

        function showHome($categorias){
            $smarty = new Smarty();
            $smarty->assign('categorias', $categorias);
            $smarty->display('templates/categorias.tpl');
            
        }

        function showProducto($categoria, $producto){
            $smarty = new Smarty();
            $smarty->assign('categoria', $categoria, true);
            $smarty->assign('producto', $producto, true);
            $smarty-> display('templates/tabla.tpl');
        }
        

        // function showProductosPorCategoria($productos){
        //     $smarty = new Smarty();
        //     $smarty->assign('productos', $productos);
        //     $smarty->display('templates/productos_por_categoria.tpl');
        // }



        function showLoggin(){
        }

        function ShowHomeLocation(){
            header("Location: ".BASE_URL."home");
        }

        function ShowCategoriasNombreLocation($coleccion){
            header("Location: ".BASE_URL."home/categorias/".$coleccion);
        }
        function ShowCategoriasIDLocation($id_coleccion){
            header("Location: ".BASE_URL."home/categorias/".$id_coleccion);
        }
    }
?>