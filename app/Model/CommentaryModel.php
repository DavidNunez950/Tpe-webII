<?php

    class CommentaryModel {
        private $db;

        function __construct() {
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', 'root');
        }

        function getCommentaryById($id){
            $query = $this->db->prepare("SELECT * FROM commentary WHERE id = ?");
            $query->execute(array($id));
            return $query->fetch(PDO::FETCH_OBJ);
        }

        function getCommentariesByProduct($id_product) {
            $query = $this->db->prepare("SELECT * FROM commentary WHERE id_product = ?");
            $query->execute(array($id_product));
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function deleteCommentary($id) {
            $query = $this->db->prepare("DELETE FROM commentary WHERE id = ?");
            $query->execute(array($id));
        }

        function insertCommentary($text, $star, $date, $id_product, $id_user) {
            $query = $this->db->prepare("INSERT INTO commentary(text, star, date, id_product, id_user) VALUES (?,?,?,?,?)");
            $query->execute(array($text, $star, $date, $id_product, $id_user));
            return $this->db->lastInsertId();
        }

        function updateCommentary($text, $star,$id){
            $query = $this->db->prepare("UPDATE commentary SET text=?, star=? WHERE id=?");
            $query->execute(array($text, $star,$id));
        }

    }


?>