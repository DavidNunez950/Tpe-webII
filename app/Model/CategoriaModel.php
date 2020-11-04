<?php

    class CategoryModel {

        private $db;

        function __construct() {
            $this->db  = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', '');
        }
        
        function getCategories(){
            $sentencia = $this->db->prepare("SELECT * FROM categoria");
            $sentencia->execute();
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }

        function getCategoryById($id){
            $sentencia = $this->db->prepare("SELECT * FROM categoria where id=?");
            $sentencia->execute(array($id));
            return  $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        function insertCategory($url_img,$coleccion){
            $sentencia = $this->db->prepare("INSERT INTO categoria(url_img,coleccion) VALUES(?,?)");           
            $sentencia->execute(array($url_img,$coleccion));
        }
        
        function deleteCategory($id_category){
            $sentencia = $this->db->prepare("DELETE FROM categoria WHERE id=?");
            $sentencia->execute(array($id_category));
        }
        
        function editCategory($id_Category, $url_img, $coleccion){
            $sentencia = $this->db->prepare("UPDATE categoria SET url_img=?,coleccion=? WHERE id=?");
            $sentencia->execute(array($url_img,  $coleccion, $id_Category));
        }
    }
?>


