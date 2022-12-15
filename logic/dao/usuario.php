<?php

require_once "conexion.php";


class Usuario
{

    function consultarUsuarios()
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "select * from usuario where estatus='vigente'";
        $result = mysqli_query($conectar, $sql);
        return $result;
    }

    function registrarUsuario($a)
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "INSERT INTO `usuario`( `nombre`, `apellidos`, `email`, `celular`, `paquete`, `codigo`, `fecha_nacimiento`, `fecha_registro`, `costo_paquete`,estatus,frecuencia,tipo_paquete)"
            . "VaLUES ('" . $a[0] . "','" . $a[1] . "','" . $a[2] . "','" . $a[3] . "','" . $a[4] . "', '" . $a[5] . "' ,'" . $a[6] . "', '" . Date("Y-m-d H:i:s") . "' ,'" . $a[7] . "','vigente','" . $a[8] . "','" . $a[9] . "')";

        $result = mysqli_query($conectar, $sql);
        if ($result > 0) {
         /*   $objMov = new Movimientos();
            $b = ["Pago de paquete: " . $a[4] . " del cliente con código: " . $a[5], $a[7], "Pago servicio"];
            $objMov->registrar($b);*/
            $objPago = new Pago();
            $objPago->registrar($a[7], $a[4], $a[5],Date("Y-m-d"));
        }
        return $result;
    }

    function modificarUsuario($a, $codigo)
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "UPDATE `usuario` SET `nombre`='$a[0]',`apellidos`='$a[1]'," .
            "`email`='$a[2]',`celular`='$a[3]',`paquete`='$a[4]',`fecha_nacimiento`='$a[5]'," .
            "`costo_paquete`='$a[6]', frecuencia='$a[7]',tipo_paquete='$a[8]' WHERE codigo='" . $codigo . "'";
        $result = mysqli_query($conectar, $sql);
        return $result;
    }

    function eliminarUsuario($codigo)
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "UPDATE `usuario` SET `estatus`='eliminado' WHERE codigo=" . $codigo;
        $result = mysqli_query($conectar, $sql);
        return $result;
    }

    function generaCodigo()
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "SELECT MAX(id_usuario) AS id FROM usuario";
        $result = mysqli_query($conectar, $sql);
        $num = mysqli_fetch_assoc($result);
        $info = $num["id"];
        $info = $info + 1;

        return str_pad($info, 4, "0", STR_PAD_LEFT);
        //“”
    }
    function devolverFechaPago($fecha,$tipo){
        $fechaPago="";
        switch ($tipo) {
            case 'Día':$fechaPago=date("Y-m-d",strtotime($fecha."+ 1 days")); break;
            case 'Semana':$fechaPago=date("Y-m-d",strtotime($fecha."+ 7 days")); break;
            case 'Quincena':$fechaPago=date("Y-m-d",strtotime($fecha."+ 15 days")); break;
            case 'Mensualidad':$fechaPago=date("Y-m-d",strtotime($fecha."+ 1 month")); break;
            case 'Trimestre':$fechaPago=date("Y-m-d",strtotime($fecha."+ 3 month")); break;
            case 'Semestre':$fechaPago=date("Y-m-d",strtotime($fecha."+ 6 month")); break;
            case 'Anualidad':$fechaPago=date("Y-m-d",strtotime($fecha."+ 1 year")); break;
        }
        return $fechaPago;
         
    }

    function buscarParaRedireccionar($codigo,$fechaActual){
        $informacion="";
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "SELECT codigo,nombre,paquete,frecuencia,max(fecha) as fecha from (SELECT u.codigo,u.nombre,u.frecuencia, p.paquete,p.monto,p.fecha FROM `pago` p, usuario u".
        " where  p.codigo = u.codigo and u.estatus='vigente') tab where tab.codigo='$codigo';";
        $result = mysqli_query($conectar, $sql);
         $fila = mysqli_fetch_assoc($result);
        if($fila["codigo"]==""){
            $informacion="Datos no encontrados";
        }else{
           $fechaPago=$this->devolverFechaPago($fila["fecha"],$fila["frecuencia"]);
           if($fechaPago>=$fechaActual){
            $informacion="Correcto";
           }else{
            $informacion="Atrasado";
           }
        }
        return $informacion;
    }

    function buscarByCodigo($codigo)
    {
        // Logica
        // aquí hacer logica para saber si ya pago
        $c = new Conectar();
        $conectar = $c->conexion();
        $sql = "select * from usuario where estatus='vigente' and codigo='$codigo'";
        $result = mysqli_query($conectar, $sql);
        return $result;
    }

    function verPagos($tipo)
    {
        $c = new Conectar();
        $conectar = $c->conexion();
        //$sql="SELECT u.codigo,u.nombre, u.apellidos,u.paquete,u.costo_paquete,IFNULL(a.monto,0) as pagado from usuario u left join (SELECT  *  from pago where EXTRACT(MONTH FROM fecha)=EXTRACT(MONTH FROM NOW()) and EXTRACT(YEAR FROM fecha)=EXTRACT(YEAR FROM NOW())) a on u.codigo=a.codigo  where u.estatus='vigente';";
        $sql = "SELECT u.codigo,u.nombre,u.apellidos,u.paquete,u.frecuencia,u.costo_paquete,p.fecha from usuario u,
       (SELECT p.codigo,p.paquete,p.monto,o.fecha FROM pago p, (SELECT codigo,max(fecha) as fecha FROM `pago` GROUP by codigo) o where p.codigo=o.codigo and p.fecha=o.fecha) p where u.codigo=p.codigo and u.frecuencia='$tipo';";
        $result = mysqli_query($conectar, $sql);
        return $result;
    }


function verPagosCliente($codigo)
{
    $c = new Conectar();
    $conectar = $c->conexion();
    $sql = "SELECT * from (SELECT u.codigo,u.nombre, p.paquete,p.monto,p.fecha FROM `pago` p, usuario u where  p.codigo = u.codigo) tab where tab.codigo='$codigo';";
    $result = mysqli_query($conectar, $sql);
    return $result;
}
}



/*
$usu = new Usuario();
$res=$usu->buscarUsuario("<?php echo $_SESSION['nombre']; ?>","201985");

while ($fila = mysqli_fetch_row($res)) {
    printf ("%s (%s)\n", $fila[0], $fila[1]);
}
*/