<?php

class Utilidades {

    function revisarSession($ruta){
        session_start();
        if(empty($_SESSION["idUsuario"])){
            if($ruta==1){
            header("Location: ../../index.html");
        }else{
            header("Location: index.html");
        }
        }else{
            return true;
        }
    }
}