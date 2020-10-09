<?php

    class CategoryModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', 'root');
        }
        
        function GetCategories(){
            $sentencia = $this->db->prepare("SELECT * FROM categoria");
            $sentencia->execute();
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        function GetCategoryByID($id){
            $sentencia = $this->db->prepare("SELECT * FROM categoria where id=?");
            $sentencia->execute(array($id));
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        function InsertCategory($url_img,$coleccion){
            $sentencia = $this->db->prepare("INSERT INTO categoria(url_img,coleccion) VALUES(?,?)");           
            $sentencia->execute(array($url_img,$coleccion));
        }
        
        function DeleteCategory($id_category){
            $sentencia = $this->db->prepare("DELETE FROM categoria WHERE id=?");
            $sentencia->execute(array($id_category));
        }
        
        function EditCategory($id_Category, $url_img, $coleccion){
            $sentencia = $this->db->prepare("UPDATE categoria SET url_img=?,coleccion=? WHERE id=?");
            $sentencia->execute(array($url_img,  $coleccion, $id_Category));
        }
    }
?>


