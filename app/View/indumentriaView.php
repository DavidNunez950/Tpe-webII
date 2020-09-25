<?php

    class IndumentariaView {

        private $title;

        function __construct() {
            $this->title  = "Subject";
        }

        function showHome($categorias){
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