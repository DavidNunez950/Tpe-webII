<?php

    class ProductModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', '');
        }

        function getProductsWithCategory(){
            $query = $this->db->prepare("SELECT producto.id,producto.tipo,producto.color,producto.talle,producto.id_categoria,categoria.coleccion FROM producto,categoria WHERE producto.id_categoria = categoria.id");
            $query->execute(array());
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getProductsByIdCategory($id){
            $query = $this->db->prepare("SELECT * FROM producto WHERE id_categoria=?");
            $query->execute(array($id));
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getProductsById($id){
            $query = $this->db->prepare("SELECT producto.id,producto.tipo,producto.color,producto.talle,producto.id_categoria,categoria.coleccion FROM producto,categoria WHERE  producto.id =? AND producto.id_categoria = categoria.id");
            $query->execute(array($id));
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function insertProduct($color,$talle,$tipo, $id_Category){
            $query = $this->db->prepare("INSERT INTO producto(color,talle,tipo,id_categoria) VALUES(?,?,?,?)");           
            $query->execute(array($color,$talle,$tipo, $id_Category));
            
        }

        function deleteProduct($id){
            $query = $this->db->prepare("DELETE FROM producto WHERE id=?");
            $query->execute(array($id));
        }

        function editProduct($id,$color,$talle,$tipo){
            $query = $this->db->prepare("UPDATE producto SET tipo=?, color=?, talle=? WHERE id=?");
            $query->execute(array($tipo,$color,$talle,$id));
        }
    }
?>


