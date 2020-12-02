<?php


    class DataBaseHelper {

        static function connection() {
            return new PDO('mysql:host=localhost;'.'dbname=db_indumentaria;charset=utf8', 'root', 'root');
        }

    }

