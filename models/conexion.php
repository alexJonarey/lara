<?php
class Conexion{
    public function conectar(){
        $server="localhost";
        $user="root";
        $pass="";
        $database="soa1";
        try {
        $conn= new PDO("mysql:host=$server;dbname=$database",$user,$pass);
        } catch (Exception $e) {
        die("fallo conexion ".$e->getMessage());
       }
        return $conn; 
    }
}