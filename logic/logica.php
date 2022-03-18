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
}else if($email == "empleado" && $pass == "12345"){
    $_SESSION["idUsuario"]=2;
    $_SESSION["username"]="empleado";
    $_SESSION["password"]="12345";
    $_SESSION["nombre"]="empleado";
    $_SESSION["tipo"]="Empleado";
    echo "2";
}else{
    echo "3";
}


