<?php

require "dao/usuario.php";
require "dao/movimientos.php";
require "dao/acceso.php";
require "dao/pago.php";

date_default_timezone_set('America/Mexico_City');

$objUsu = new Usuario();
$objMov = new Movimientos();
$objAcc = new Acceso();
$objPago = new Pago();
//2022-04-01 21:10:01
$fecha = date("Y-m-d H:i:s"); 

$opcion = $_POST['opcion'];

if ($opcion == "usuario_registrar") {

  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $fnacimiento = $_POST['nacimiento'];
  $celular = $_POST['celular'];
  $paquete = $_POST['paquete'];
  $costo = $_POST['costo'];
  $frecuencia = $_POST['frecuencia'];
  $tipoPaque = $_POST['tipoPaquete'];
  //  `nombre`, `apellidos`, `email`, `celular`, `paquete`, `codigo`, `fecha_nacimiento`, `fecha_registro`, `costo_paquete`,estatus
  $arr = [$nombre, $apellidos, $email, $celular, $paquete, $objUsu->generaCodigo(), $fnacimiento, $costo, $frecuencia, $tipoPaque];
  $res = $objUsu->registrarUsuario($arr);
  echo $res;
}
if ($opcion == "usuario_modificar") {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $fnacimiento = $_POST['nacimiento'];
  $celular = $_POST['celular'];
  $paquete = $_POST['paquete'];
  $costo = $_POST['costo'];
  $codigo = $_POST['codigo'];
  $frecuencia = $_POST['frecuencia'];
  $tipoPaque = $_POST['tipoPaquete'];

  $arr = [$nombre, $apellidos, $email, $celular, $paquete, $fnacimiento, $costo, $frecuencia, $tipoPaque];
  $res = $objUsu->modificarUsuario($arr, $codigo);
  echo $res;
}

if ($opcion == "usuario_eliminar") {

  $codigo = $_POST['codigo'];
  $res = $objUsu->eliminarUsuario($codigo);
  echo $res;
}

if ($opcion == "movimientos_registrar") {
  $monto = $_POST['monto'];
  $concepto = $_POST['concepto'];
  $tipo = $_POST['tipo'];
  $arr = [$concepto, $monto, $tipo];
  $res =  $objMov->registrar($arr);
  echo $res;
}

if ($opcion == "acceso") {
  $codigo = $_POST["codigo"];
  $res =  $objUsu->buscarByCodigo($codigo);

  $size = mysqli_num_rows($res);
  if ($size <= 0) {
    echo "vacio";
  } else {

    $fila = mysqli_fetch_assoc($res);
    $objAcc->registrar($fila["codigo"],$fecha);
    echo $fila["codigo"];
  }
}

if ($opcion == "pago_registrar") {
  $codigo = $_POST["codigo"];
  $monto = $_POST["monto"];
  $paquete = $_POST["paquete"];
  $fecha = $_POST["fecha"];

  $res = $objPago->registrar($monto, $paquete, $codigo, $fecha);
  echo $res;
}

if ($opcion == "pagos_realizados") {
  $codigo = $_POST["codigo"];
  $res = $objUsu->verPagosCliente($codigo);

  echo '<div class="table-responsive pt-4">';
  echo '<table class="table table-bordered" id="pagos" width="100%" cellspacing="0">';
  echo '
<thead>
<tr>
    <th>Nombre</th>
    <th>Paquete</th>
    <th>Costo</th>
    <th>Fecha pago</th>
</tr>
</thead>
';

  echo '<tfoot>
<th>Nombre</th>
<th>Paquete</th>
<th>Costo</th>
<th>Fecha pago</th>
    </tfoot>
    <tbody>';
  while ($fila = mysqli_fetch_assoc($res)) {
    echo "<tr>";

    echo "<td>" . $fila["nombre"] . "</td>";
    echo "<td>" . $fila["paquete"] . "</td>";
    echo "<td> $" . $fila["monto"] . "</td>";
    echo "<td>" . $fila["fecha"] . "</td>";
    echo "</tr>";
  }

  echo '
  </tbody>
  </table>';
  echo '</div>';
}
