<?php

    class IndumentariaModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', '');
        }

        function GetIndumentaria(){
            $sentencia = $this->db->prepare( "SELECT * FROM producto,categoria");
            $sentencia->execute();
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        function InsertProducto($color,$id_categoria,$talle,$tipo){

            $sentencia = $this->db->prepare( "INSERT INTO producto(color,id_categoria,talle,tipo) VALUES(?,?,?,?)");           
            $sentencia->execute(array($color,$id_categoria,$talle,$tipo));
            
        }
        function InsertCategoria($disenador){

            $sentencia = $this->db->prepare( "INSERT INTO categoria(disenador) VALUES(?)");           
            $sentencia->execute(array($disenador));
            
        }
        function DeleteProducto($id){
            $sentencia = $this->db->prepare( "DELETE FROM producto WHERE id=?");
            $sentencia->execute(array($id));
        }
        function DeleteCategoria($id){
            $sentencia = $this->db->prepare( "DELETE FROM categoria WHERE id=?");
            $sentencia->execute(array($id));
        }
        function EditProducto($id,$color,$id_categoria,$talle,$tipo){
            $sentencia = $this->db->prepare( "UPDATE producto SET color=?,id_categoria=?,talle=?,tipo=? WHERE id=?");
            $sentencia->execute(array($color,$id_categoria,$talle,$tipo,$id));
        }
        function EditCategria($id,$disenador){
            $sentencia = $this->db->prepare( "UPDATE categoria SET disenador=? WHERE id=?");
            $sentencia->execute(array($disenador,$id));
        }



        

    }
?>

