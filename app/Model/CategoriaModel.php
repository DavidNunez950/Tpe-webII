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
        function InsertCategoria($disenador){
            $sentencia = $this->db->prepare( "INSERT INTO categoria(disenador) VALUES(?)");           
            $sentencia->execute(array($disenador));
            
        }
        
        function DeleteCategoria($id){
            $sentencia = $this->db->prepare( "DELETE FROM categoria WHERE id=?");
            $sentencia->execute(array($id));
        }
        
        function EditCategria($id,$disenador){
            $sentencia = $this->db->prepare( "UPDATE categoria SET disenador=? WHERE id=?");
            $sentencia->execute(array($disenador,$id));
        }
    }
?>

