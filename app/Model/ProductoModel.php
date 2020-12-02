<?php

    require_once("app/Helper/DataBaseHelper.php");

    class ProductModel {

        private $db;

        function __construct() {
            $this->db = DataBaseHelper::connection();
        }

        function getCountProducts($conectorLogico, $tipo,$color,$talle, $categoria, $image){
            $sentence = $this->generateDidamicQueryCondition($conectorLogico, $tipo,$color,$talle, $categoria, $image);
            $sentence = 'SELECT COUNT(*) AS cant FROM producto INNER JOIN categoria ON categoria.id = producto.id_categoria '.$sentence;
            $query = $this->db->prepare($sentence);
            $query->execute();
            return  $query->fetch(PDO::FETCH_OBJ);
        }

        function getFilteredProducts($index, $conectorLogico, $tipo,$color,$talle, $categoria, $image){
            $sentence = $this->generateDidamicQueryCondition($conectorLogico, $tipo,$color,$talle, $categoria, $image);
            $sentence ='SELECT producto.*, categoria.coleccion FROM producto INNER JOIN categoria ON categoria.id = producto.id_categoria '.$sentence.'LIMIT '.$index.', 5';
            $query = $this->db->prepare($sentence);
            $query->execute();
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getProductsWithCategory($n1, $n2){
            $query = $this->db->prepare('SELECT * FROM categoria INNER JOIN producto ON categoria.id = producto.id_categoria LIMIT '.$n1.', 5');
            $query->execute(array());
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getProductsByIdCategory($id){
            $query = $this->db->prepare("SELECT producto.*, categoria.coleccion FROM producto INNER JOIN categoria ON categoria.id = producto.id_categoria WHERE id_categoria=?");
            $query->execute(array($id));
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getProductsById($id){
            $query = $this->db->prepare("SELECT  producto.*, categoria.coleccion  FROM producto,categoria WHERE  producto.id =? AND producto.id_categoria = categoria.id");
            $query->execute(array($id));
            return  $query->fetch(PDO::FETCH_OBJ);
        }

        function insertProduct($color,$talle,$tipo, $id_category){
            $query = $this->db->prepare("INSERT INTO producto(color,talle,tipo,id_categoria) VALUES(?,?,?,?)");           
            $query->execute(array($color,$talle,$tipo, $id_category));
            
        }

        function deleteProduct($id){
            $query = $this->db->prepare("DELETE FROM producto WHERE id=?");
            $query->execute(array($id));
        }

        function editProduct($tipo,$color,$talle,$id){
            $query = $this->db->prepare("UPDATE producto SET tipo=?, color=?, talle=? WHERE id=?");
            $query->execute(array($tipo,$color,$talle,$id));
        }

        function editImage($img,$id){
            $query = $this->db->prepare("UPDATE producto SET img=? WHERE id=?");
            $query->execute(array($img,$id));
        }
        
        function deleteImage($id){
            $query = $this->db->prepare('UPDATE producto SET img= ? WHERE id=?');
            $query->execute(array(null,$id));
        }
        
        private function generateDidamicQueryCondition($conectorLogico, $tipo,$color,$talle, $categoria, $image) {
            $sentence = '';
            $conector = 'WHERE ';
            $arr = array(
                'producto.tipo' =>$tipo,
                'producto.color' =>$color,
                'producto.talle' =>$talle,
                'categoria.coleccion' =>$categoria,
            );
            foreach(array_keys($arr) as $e) {
                if($arr[$e]!= null) {
                    $sentence .= ' '.$conector.' LOWER(  '.$e.' ) LIKE LOWER("%'.$arr[$e].'%")';
                    $conector = ($conectorLogico == true) ? 'AND': 'OR';
                }
            }
            $sentence .= (($image == true) ? (' '.$conector.' producto.img != ""') : "");
            return $sentence;
        }
    }
?>


