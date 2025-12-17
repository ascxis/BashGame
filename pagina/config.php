<?php
 $host = "localhost";
 $user = "root";
 $password = "";
 $database = "usuarios_db";

 $conn = new mysqli($host,$user,$password,$database);

 if ($conn->connect_error){
    die("conexion fallida:  ". $conn->connect_error);
 }

?>