<?php
require_once "conexion.php";

class Acceso{

    function registrar($codigo,$fecha){
    
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="INSERT INTO `acceso`(`codigo`,fecha) VALUES ('$codigo','$fecha');";
        $result = mysqli_query($conectar,$sql);
        return $result;
    }

    function consultarTodos(){
       
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="Select u.codigo,nombre, apellidos,fecha from usuario u, acceso a where u.codigo=a.codigo;";
        $result = mysqli_query($conectar,$sql);
        return $result; 
    }
}