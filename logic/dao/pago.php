<?php
require_once "conexion.php";

class Pago{

    function registrar($monto,$paquete,$codigo,$fecha){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="INSERT INTO `pago`(`monto`, `paquete`, `codigo`,fecha) VALUES ('$monto','$paquete','$codigo','$fecha')";
        $result = mysqli_query($conectar,$sql);
        return $result;
    }

    
}