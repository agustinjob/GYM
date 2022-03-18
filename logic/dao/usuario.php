<?php

require_once "conexion.php";


class Usuario {

    function buscarUsuario($email, $pass){
        $c = new Conectar();
        $conectar=$c->conexion();
        $sql = "select * from usuario where username= BINARY '".$email."' and password = BINARY '".$pass."' and eliminado=false";
        $result = mysqli_query($conectar,$sql);        
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