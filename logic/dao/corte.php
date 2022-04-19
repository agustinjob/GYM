<?php
require_once "conexion.php";

class Corte
{

    function obtenerEntradaSalida($fi, $ff, $tipo)
    {

        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "SELECT sum(monto) as total from movimientos where date(fecha)>='$fi' and date(fecha)<='$ff' and tipo='$tipo'";
        $result = mysqli_query($conectar, $sql);
        $res = mysqli_fetch_assoc($result);

        return $res["total"];
    }

    function obtenerGananciasGYM($fi, $ff)
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "SELECT sum(monto) as total FROM `pago` where date(fecha)>='$fi' and date(fecha)<='$ff';";
        $result = mysqli_query($conectar, $sql);
        $res = mysqli_fetch_assoc($result);

        return $res["total"];
    }

    function obtenerTotalDeRegistros($fi, $ff){
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql="SELECT count(*) as total FROM `usuario` where date(fecha_registro)<='$fi' and date(fecha_registro)>='$ff' and estatus='vigente';";
        $result = mysqli_query($conectar, $sql);
        $res = mysqli_fetch_assoc($result);
        return $res["total"];
    }
}
