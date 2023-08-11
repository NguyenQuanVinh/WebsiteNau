<?php
class Database{
    public function getConnect(){
        $host = 'localhost';
        $db = 'shopdb';
        $user = 'vinhnguyen';
        $pass = 'Cje7BlsFgdyKp0hR';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        return new PDO($dsn, $user, $pass);
    }
}