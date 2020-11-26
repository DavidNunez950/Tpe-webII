<?php

    require_once("app/Helper/DataBaseHelper.php");
    
    class CategoryModel {

        private $db;

        function __construct() {
            $this->db = DataBaseHelper::connection();
        }
        
        function getCategories(){
            $query = $this->db->prepare("SELECT * FROM categoria");
            $query->execute();
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getCategoryById($id){
            $query = $this->db->prepare("SELECT * FROM categoria where id=?");
            $query->execute(array($id));
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }
        function insertCategory($url_img,$coleccion){
            $query = $this->db->prepare("INSERT INTO categoria(url_img,coleccion) VALUES(?,?)");           
            $query->execute(array($url_img,$coleccion));
        }
        
        function deleteCategory($id_category){
            $query = $this->db->prepare("DELETE FROM categoria WHERE id=?");
            $query->execute(array($id_category));
        }
        
        function editCategory($id_Category, $url_img, $coleccion){
            $query = $this->db->prepare("UPDATE categoria SET url_img=?,coleccion=? WHERE id=?");
            $query->execute(array($url_img,  $coleccion, $id_Category));
        }
    }
?>


