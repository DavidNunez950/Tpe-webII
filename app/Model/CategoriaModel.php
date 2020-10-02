<?php

    class CategoriaModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', '');
        }
        
        function GetCategoria(){
            $sentencia = $this->db->prepare( "SELECT * FROM categoria");
            $sentencia->execute();
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        function InsertCategoria($url_img,$coleccion){
            $sentencia = $this->db->prepare( "INSERT INTO categoria(url_img,coleccion) VALUES(?,?)");           
            $sentencia->execute(array($url_img,$coleccion));
        }
        
        function DeleteCategoria($id_categoria){
            $sentencia = $this->db->prepare( "DELETE FROM categoria WHERE id=?");
            $sentencia->execute(array($id_categoria));
        }
        
        function EditCategoria($id_categoria){
            $sentencia = $this->db->prepare( "UPDATE categoria SET url_img='$_POST[url_img]',coleccion='$_POST[coleccion]' WHERE id=?");
            $sentencia->execute(array($id_categoria));
        }
        

    }
?>


