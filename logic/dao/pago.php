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

    
    function modificarFecha($codigo,$fecha_registro){
        $c = new Conectar();
        $conectar=$c->conexion();
        $query="select min(fecha) as fecha from pago where codigo='$codigo'";
        $resultado=mysqli_query($conectar,$query);
        $fila = mysqli_fetch_assoc($resultado);
        $fecha=$fila['fecha'];
        $sql="UPDATE pago SET fecha ='$fecha_registro' where codigo='$codigo' and fecha='$fecha'";
        mysqli_query($conectar,$sql);
    }

    
}