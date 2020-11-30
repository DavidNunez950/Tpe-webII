<?php

    require_once("app/Helper/DataBaseHelper.php");

    class UserModel{

        private $db;

        function __construct(){
            $this->db = DataBaseHelper::connection();
        }

        function getUser($name){
            $query = $this->db->prepare("SELECT * FROM user WHERE name=?");
            $query->execute(array($name));
            return $query->fetch(PDO::FETCH_OBJ);
        }

        function getNumberUserAdmin() {
            $query = $this->db->prepare("SELECT COUNT(*) AS cant FROM user WHERE admin=1");
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        }

        function getUsers(){
            $query = $this->db->prepare("SELECT * FROM user");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getUserById($id){
            $query = $this->db->prepare("SELECT user.id, user.name, user.email, user.admin FROM user WHERE user.id = ?");
            $query->execute(array($id));
            return $query->fetch(PDO::FETCH_OBJ);
        }

        function deleteUser($id){
            $query = $this->db->prepare("DELETE FROM user WHERE user.id = ?");
            $query->execute(array($id));
            return $query->fetch(PDO::FETCH_OBJ);
        }

        function changeAdministrationPermissions($id, $admin){
            $query = $this->db->prepare("UPDATE user SET admin = ? WHERE id = ?");
            $query->execute(array($admin,$id));
            return $query->fetch(PDO::FETCH_OBJ);
        }

        function insertUser($user, $mail, $pass, $admin){
            $query = $this->db->prepare("INSERT INTO user(name,email,password,admin) VALUES(?,?,?,?)");  //password y admin palabra reservada         
            $query->execute(array($user, $mail, $pass, $admin));
        }
    }

?>