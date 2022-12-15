<?php 

require_once 'conexion.php';

class Empleado{

    
    function registrarEmpleado($a){
        $dia=date("Y-m-d");
        $hora=date("H:i:s");   
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="INSERT INTO `usuario`(`nombre`, `direccion`, `username`, `password`, `tipoUsuario`,`eliminado`, `fecha`, `enSesion`, `hora`)"
        . "VaLUES ('" . $a[0] . "','" . $a[1]. "','" . $a[2] . "','" . $a[3] . "','empleado', false ,'". $dia ."', false ,'".$hora."')";

        $result = mysqli_query($conectar,$sql);
        return $result;
    }

    function registrarUsuario($a){
        $dia=date("Y-m-d");
        $hora=date("H:i:s");   
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="INSERT INTO `usuario`(idUsuario,`nombre`, `direccion`, `username`, `password`, `tipoUsuario`,`eliminado`, `fecha`, `enSesion`, `hora`)"
        . "VaLUES ('".$a->{"idUsuario"}."','" . $a->{"nombre"}. "','" . $a->{"direccion"}. "','" . $a->{"username"}. "','" . $a->{"password"}. "','".$a->{"tipoUsuario"}."', false ,'". $dia ."', false ,'".$hora."')";

        $result = mysqli_query($conectar,$sql);
        return $result;
    }

    function consultarEmpleados(){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="SELECT * from usuario WHERE tipoUsuario='empleado' and eliminado=false;";
        $result=mysqli_query($conectar,$sql);
        return $result;
    }

    function eliminarEmpleado($id){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="UPDATE usuario SET eliminado=true where idUsuario= ".$id;
        $result=mysqli_query($conectar,$sql);
        return $result;
        
    }

    

    function buscaEmpleadoByUseName($email){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql = "select * from usuario where username= BINARY '".$email."' and eliminado=false";
        $result = mysqli_query($conectar,$sql);
        $num=mysqli_num_rows($result);
        return $num;  
    } 

    function modificarEmpleado($a){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="UPDATE `usuario` SET `nombre`= '" . $a[0] . "',`direccion`='".$a[1]."',`username`='".$a[2]."',`password`='".$a[3]."' WHERE idUsuario= ".$a[4];
        $result = mysqli_query($conectar,$sql);
        return $result;
    }

    function modificarEmpleadoApi($a){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql="UPDATE `usuario` SET tipoUsuario='".$a->{"tipoUsuario"}."', `nombre`= '" . $a->{"nombre"} . "',`direccion`='".$a->{"direccion"}."',`username`='".$a->{"username"}."',`password`='".$a->{"password"}."' WHERE idUsuario= ".$a->{"idUsuario"};
        $result = mysqli_query($conectar,$sql);
        return $result;
    }

}