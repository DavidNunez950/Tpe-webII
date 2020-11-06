<?php

    class CommentaryModel {
        private $db;

        function __construct() {
            $this->db = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', '');
        }

        function getComentaries() {
            $query = $this->db->prepare("SELECT * FROM commentary");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getComentariesByProduct($id_product) {
            $query = $this->db->prepare("SELECT * FROM commentary WHERE id_product = ?");
            $query->execute(array($id_product));
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function deleteComentary($id) {
            $query = $this->db->prepare("DELETE FROM commentary WHERE id = ?");
            $query->execute(array($id));
        }

        function insertComentary($text, $star, $date, $id_product, $id_user) {
            $query = $this->db->prepare("INSERT INTO commentary(text, star, date, id_product, id_user) VALUES (?,?,?,?,?)");
            $query->execute(array($text, $star, $date, $id_product, $id_user));
        }

    }


?>