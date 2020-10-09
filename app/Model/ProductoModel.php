<?php

    class ProductModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', 'root');
        }

        function GetProductsWithCategory(){
            $sentencia = $this->db->prepare("SELECT producto.id,producto.tipo,producto.color,producto.talle,producto.id_categoria,categoria.coleccion FROM producto,categoria WHERE producto.id_categoria = categoria.id");
            $sentencia->execute(array());
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        function GetProductsById($id){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id_categoria=?");
            $sentencia->execute(array($id));
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        function InsertProduct($color,$talle,$tipo, $id_Category){
            $sentencia = $this->db->prepare("INSERT INTO producto(color,talle,tipo,id_categoria) VALUES(?,?,?,?)");           
            $sentencia->execute(array($color,$talle,$tipo, $id_Category));
            
        }

        function DeleteProduct($id){
            $sentencia = $this->db->prepare("DELETE FROM producto WHERE id=?");
            $sentencia->execute(array($id));
        }

        function EditProduct($id,$color,$talle,$tipo){
            $sentencia = $this->db->prepare("UPDATE producto SET tipo=?, color=?, talle=? WHERE id=?");
            $sentencia->execute(array($tipo,$color,$talle,$id));
        }
    }
?>


