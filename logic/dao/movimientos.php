<?php 

require_once 'conexion.php';

class Movimientos{

    
    function registrar($a){
      
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="INSERT INTO `movimientos`(`concepto`, `monto`, `tipo`, `fecha`) VALUES "
         ."('$a[0]','$a[1]','$a[2]','".Date("Y-m-d H:i:s")."')";
        $result = mysqli_query($conectar,$sql);
        return $result;
    }

    function consultarTodos(){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="SELECT * from movimientos order by fecha";
        $result = mysqli_query($conectar,$sql);
        return $result;

    }

}