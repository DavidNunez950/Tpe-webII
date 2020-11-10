<?php

class UserModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', 'root');
    }

    function getUser($email){
        $query = $this->db->prepare("SELECT * FROM user WHERE email=?");
        $query->execute(array($email));
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

    function changeAdministrationPermissions($id){
        $admin = ($this->getUserById($id)->admin==1) ? 0 : 1;
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