<?php

class Conectar {

    
    /*private $servidor = "sql349.main-hosting.eu";
    private $servidor = "localhost";
    private $usuario = "u585135986_mscjob";
    private $bd = "u585135986_almacennube";
    private $pass = "35101107Aa";*/

    
    private $servidor = "localhost";
    private $usuario = "root";
    private $bd = "almacennube";
    private $pass = "";


    public function conexion() {
        $conexion = mysqli_connect($this->servidor, $this->usuario, $this->pass, $this->bd);
        $conexion->set_charset("utf8");
      /*       if (mysqli_connect_errno()) {
          echo "Connect failed: %s\n", mysqli_connect_error();
          exit();
          } else{
              echo "Todo correcto";
          }*/
        return $conexion;
    }

  

}


/*
$obj= new Conectar();
if($obj->conexion()){
    echo "conectado con exito";
}else{
    echo "Hubo problema";
}
*/


