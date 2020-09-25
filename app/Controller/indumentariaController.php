<?php

    require_once("app/View/indumentariaView.php");
    require_once("app/Model/ProductoModel.php");
    require_once("app/Model/CategoriaModel.php");

    class IndumentariaController{

        private $view;
        private $CategoriaModel;
        private $ProductoModel;

        function __construct() {
            $this->view = new indumentariaView();
            $this->CategoriaModel = new ProductoModel();
            $this->ProductoModel = new CategoriaModel();
        }


    }
?>