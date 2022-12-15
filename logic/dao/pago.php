<?php
require_once "conexion.php";
$objMov = new Movimientos();


class Pago{

    function registrar($monto,$paquete,$codigo,$fecha){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="INSERT INTO `pago`(`monto`, `paquete`, `codigo`,fecha) VALUES ('$monto','$paquete','$codigo','$fecha')";
        $result = mysqli_query($conectar,$sql);

        if ($result > 0) {
            $objMov = new Movimientos();
            $b = ["Pago de paquete: " . $paquete . " del cliente con código: " . $codigo, $monto, "Pago servicio"];
            $objMov->registrar($b);
          
        }
        return $result;
    }

    
}