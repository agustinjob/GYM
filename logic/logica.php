<?php
include "dao/usuario.php";

date_default_timezone_set('America/Mexico_City');

session_start();


$usu=new Usuario();
$email=$_POST["email"];
$pass=$_POST["pass"];

if($email == "david" && $pass == "12345"){
    $_SESSION["idUsuario"]=1;
    $_SESSION["username"]="David";
    $_SESSION["password"]="12345";
    $_SESSION["nombre"]="David";
    $_SESSION["tipo"]="Administrador";
    echo "1";
}else if($email == "gym" && $pass == "12345"){
    $_SESSION["idUsuario"]=2;
    $_SESSION["username"]="Usuario";
    $_SESSION["password"]="12345";
    $_SESSION["nombre"]="Usuario";
    $_SESSION["tipo"]="Empleado";
    echo "1";
}else if($email == "carlos" && $pass == "12345"){
    $_SESSION["idUsuario"]=3;
    $_SESSION["username"]="carlos";
    $_SESSION["password"]="12345";
    $_SESSION["nombre"]="Carlos";
    $_SESSION["tipo"]="Administrador";
    echo "1";

}

else{
    echo "0";
}


