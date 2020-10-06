<?php

    class ProductoModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', '');
        }

        function GetProducto($id){
            $sentencia = $this->db->prepare( "SELECT * FROM producto WHERE id_categoria=?");
            $sentencia->execute(array($id));
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        function InsertProducto($color,$talle,$tipo, $id_categoria){
            $sentencia = $this->db->prepare("INSERT INTO producto(color,talle,tipo,id_categoria) VALUES(?,?,?,?)");           
            $sentencia->execute(array($color,$talle,$tipo, $id_categoria));
            
        }

        function DeleteProducto($id){
            $sentencia = $this->db->prepare("DELETE FROM producto WHERE id=?");
            $sentencia->execute(array($id));
        }

        function EditProducto($id,$color,$talle,$tipo){
            $sentencia = $this->db->prepare("UPDATE producto SET tipo=?, color=?, talle=? WHERE id=?");
            $sentencia->execute(array($tipo,$color,$talle,$id));
        }
        
    }
?>


