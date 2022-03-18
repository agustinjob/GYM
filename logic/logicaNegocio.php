<?php

require "dao/empleado.php";
require "dao/producto.php";
require "dao/ventas.php";
require "dao/area.php";
require "utils/utilidades.php";

date_default_timezone_set('America/Mexico_City');
   
$empleado = new Empleado();
$producto = new Producto();
$ventas = new Ventas();
$area = new Area();
$utils = new Utilidades();
$utils->revisarSession(2);
$idUsuario=$_SESSION["idUsuario"];

$opcion = $_POST['opcion'];

if($opcion=="area_alta_medicamento_paciente"){
  
    $codigo= $_POST['codigo'];
    $nC = $_POST['nombreC'];
    $nA = $_POST['nombreA'];
    $presentacion = $_POST['presentacion'];
    $primero = $_POST['primero'];
    $segundo = $_POST['segundo'];
    $tercero = $_POST['tercero'];
    $cuarto = $_POST['cuarto'];
    $medico = $_POST['medico'];
    $paciente = $_POST['paciente'];
    $arr=[$codigo,$nC, $nA, $presentacion,$cuarto,$medico,$paciente, $primero, $segundo, $tercero,$idUsuario];
    $res= $area->registrarMedicamentoPaciente($arr);
    echo $res;

}

if($opcion=="area_paciente_medicamento_modificar"){
    $idRegistro = $_POST['idRegistro'];
    $primero= $_POST['primero'];
    $segundo = $_POST['segundo'];
    $tercero= $_POST['tercero'];

    $res=$area->modificarMedicamentoPaciente($idRegistro,$primero,$segundo,$tercero);
    echo $res;

}

if($opcion == "area_paciente_medicamento_eliminar"){
    $idRegistro = $_POST['idRegistro'];
    $res=$area->eliminarMedicamentoPaciente($idRegistro);
    echo $res;
}
if($opcion == "area_alta_paciente"){
    $cuarto=$_POST['cuarto'];
    $res=$area->altaPaciente($cuarto);
    echo $res;
}

if($opcion==="area_producto_ocupar"){
    $codigo= $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $cantidad= $_POST['cantidad'];
    $areaP=$_POST['areaP'];

    $a=[$codigo,$cantidad,$descripcion,$areaP,$idUsuario];
    $res=$area->registrarSalida($a);
    echo $res;

}

if($opcion == "area_producto_eliminar"){
    $codigo = $_POST['codigo'];
    $areaP=$_POST['areaP'];
    
    $res=$area->eliminarProductoEnArea($codigo,$areaP);
    echo $res;

}
if($opcion=="movimientos_periodo_fecha"){

    $tipo= $_POST['tipo'];
    $res=$ventas->consultarMovimientosPorFecha($tipo);
    $total=0;
    if(mysqli_num_rows($res)>0){

        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Activo</th>
                    <th>Presentación</th>
                    <th>Area</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>hora</th>
                    </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Activo</th>
                <th>Presentación</th>
                <th>Area</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>hora</th>
                </tr>
            </tfoot>
            <tbody>';

   
        $i = 1;
      
        while ($fila = mysqli_fetch_row($res)) {
            echo "<tr>";
            echo "<td>" . $fila[1] . "</td>";
            echo "<td>" . $fila[2] . "</td>";
            echo "<td>" . $fila[3] . "</td>";
            echo "<td>" . $fila[8] . "</td>";
            echo "<td>" . $fila[5] . "</td>";
            echo "<td>" . $fila[4] . "</td>";
            echo "<td>" . $fila[6] . "</td>";
            echo "<td>" . $fila[7] . "</td>";
            echo "</tr>";
            $total=$total + $fila[4];
        }
    }else{
        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Activo</th>
                    <th>Presentación</th>
                    <th>Area</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>hora</th>
                    </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Activo</th>
                <th>Presentación</th>
                <th>Area</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>hora</th>
                </tr>
            </tfoot>
            <tbody>
            <tr>
            <td></td>
            <td></td>
            <td>No hay resultados en esa fecha</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            ';

    }

    echo '</tbody>
    </table>
</div> @'.$total;
    
}

if($opcion == "movimientos_por_lapsos_de_tiempo"){
    $fIni= $_POST['fechaInicio'];
    $fFin=$_POST['fechaFin'];
    $res=$ventas->consultarMovimientosPorLapsosDeTiempo($fIni,$fFin);
    $total=0;
    if(mysqli_num_rows($res)>0){
        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Activo</th>
        <th>Presentación</th>
        <th>Area</th>
        <th>Cantidad</th>
        <th>Fecha</th>
        <th>hora</th>
        </tr>
</thead>
<tfoot>
    <tr>
    <th>Código</th>
    <th>Nombre</th>
    <th>Activo</th>
    <th>Presentación</th>
    <th>Area</th>
    <th>Cantidad</th>
    <th>Fecha</th>
    <th>hora</th>
    </tr>
</tfoot>
            <tbody>';

   
            $i = 1;
      
            while ($fila = mysqli_fetch_row($res)) {
                echo "<tr>";
                echo "<td>" . $fila[1] . "</td>";
                echo "<td>" . $fila[2] . "</td>";
                echo "<td>" . $fila[3] . "</td>";
                echo "<td>" . $fila[8] . "</td>";
                echo "<td>" . $fila[5] . "</td>";
                echo "<td>" . $fila[4] . "</td>";
                echo "<td>" . $fila[6] . "</td>";
                echo "<td>" . $fila[7] . "</td>";
                echo "</tr>";
                $total=$total + $fila[4];
            }
    }else{
        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Activo</th>
        <th>Presentación</th>
        <th>Area</th>
        <th>Cantidad</th>
        <th>Fecha</th>
        <th>hora</th>
        </tr>
</thead>
<tfoot>
    <tr>
    <th>Código</th>
    <th>Nombre</th>
    <th>Activo</th>
    <th>Presentación</th>
    <th>Area</th>
    <th>Cantidad</th>
    <th>Fecha</th>
    <th>hora</th>
    </tr>
</tfoot>
            <tbody>
            <tr>
            <td></td>
            <td></td>
            <td>No hay resultados en esa fecha</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            ';

    }

    echo '</tbody>
    </table>
</div> @'.$total;


}

if($opcion=="ventas_por_lapsos_de_tiempo"){
    $fIni= $_POST['fechaInicio'];
    $fFin=$_POST['fechaFin'];
    $res=$ventas->consultarVentasPorLapsosDeTiempo($fIni,$fFin);
    $total=0;
    if(mysqli_num_rows($res)>0){
        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción del producto</th>
                    <th>Cantidad</th>
                    <th>Precio venta</th>
                    <th>Fecha</th>
                    <th>hora</th>
                    </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Código</th>
                <th>Descripción del producto</th>
                <th>Cantidad</th>
                <th>Precio venta</th>
                <th>Fecha</th>
                <th>hora</th>
                </tr>
            </tfoot>
            <tbody>';

   
        $i = 1;
      
        while ($fila = mysqli_fetch_row($res)) {
            echo "<tr>";
            echo "<td>" . $fila[0] . "</td>";
            echo "<td>" . $fila[1] . "</td>";
            echo "<td>" . $fila[2] . "</td>";
            echo "<td>" . $fila[3] . "</td>";
            echo "<td>" . $fila[4] . "</td>";
            echo "<td>" . $fila[5] . "</td>";
            echo "</tr>";
            $total=$total + $fila[2];
        }
    }else{
        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción del producto</th>
                    <th>Cantidad</th>
                    <th>Precio venta</th>
                    <th>Fecha</th>
                    <th>hora</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Código</th>
                <th>Descripción del producto</th>
                <th>Cantidad</th>
                <th>Precio venta</th>
                <th>Fecha</th>
                <th>hora</th>
                </tr>
            </tfoot>
            <tbody>
            <tr>
            <td></td>
            <td></td>
            <td>No hay resultados en esa fecha</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            ';

    }

    echo '</tbody>
    </table>
</div> @'.$total;
}


if($opcion=="ventas_periodo_fecha"){
    $tipo= $_POST['tipo'];
    $res=$ventas->consultarVentasPorFecha($tipo);
    $total=0;
    if(mysqli_num_rows($res)>0){

        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción del producto</th>
                    <th>Cantidad</th>
                    <th>Precio venta</th>
                    <th>Fecha</th>
                    <th>hora</th>
                    </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Código</th>
                <th>Descripción del producto</th>
                <th>Cantidad</th>
                <th>Precio venta</th>
                <th>Fecha</th>
                <th>hora</th>
                </tr>
            </tfoot>
            <tbody>';

   
        $i = 1;
      
        while ($fila = mysqli_fetch_row($res)) {
            echo "<tr>";
            echo "<td>" . $fila[0] . "</td>";
            echo "<td>" . $fila[1] . "</td>";
            echo "<td>" . $fila[2] . "</td>";
            echo "<td>" . $fila[3] . "</td>";
            echo "<td>" . $fila[4] . "</td>";
            echo "<td>" . $fila[5] . "</td>";
            echo "</tr>";
            $total=$total + $fila[2];
        }
    }else{
        echo '<div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción del producto</th>
                    <th>Cantidad</th>
                    <th>Precio venta</th>
                    <th>Fecha</th>
                    <th>hora</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Código</th>
                <th>Descripción del producto</th>
                <th>Cantidad</th>
                <th>Precio venta</th>
                <th>Fecha</th>
                <th>hora</th>
                </tr>
            </tfoot>
            <tbody>
            <tr>
            <td></td>
            <td></td>
            <td>No hay resultados en esa fecha</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>
            ';

    }

    echo '</tbody>
    </table>
</div> @'.$total;

}


if ($opcion == "empleado_registrar") {
    $nombre = $_POST['nombre'];
    $username = $_POST['usuario'];
    $direccion = $_POST['direccion'];
    $password = $_POST['pass1'];

    $a = [$nombre, $direccion, $username, $password];
    $numero = $empleado->buscaEmpleadoByUseName($username);

    if ($numero > 0) {
        echo "2";
    } else {
        $res = $empleado->registrarEmpleado($a);
        if ($res) {
            echo "1";
        } else {
            echo "0";
        }
    }
}

if ($opcion == "empleado_modificar") {
    $id = $_POST["id"];
    $nombre = $_POST['nombre'];
    $username = $_POST['usuario'];
    $direccion = $_POST['direccion'];
    $password = $_POST['pass1'];

    $a = [$nombre, $direccion, $username, $password, $id];
    $res = $empleado->modificarEmpleado($a);
    if ($res == true) {
      echo "1";
    } else {
        echo "0";
    }
}

if ($opcion == "empleado_eliminar") {
    $id = $_POST["id"];
    $res = $empleado->eliminarEmpleado($id);
    if ($res == true) {
        echo '<div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
           <thead>
               <tr>
                   <th>Nombre</th>
                   <th>Dirección</th>
                   <th>Usuario</th>
                   <th>Operaciones</th>
                   </tr>
           </thead>
           <tfoot>
               <tr>
                   <th>Nombre</th>
                   <th>Dirección</th>
                   <th>Usuario</th>
                   <th>Operaciones</th>
               </tr>
           </tfoot>
           <tbody>';

        $res = $empleado->consultarEmpleados();

        while ($fila = mysqli_fetch_row($res)) {
            echo "<tr>";
            echo "<td>" . $fila[1] . "</td>";
            echo "<td>" . $fila[2] . "</td>";
            echo "<td>" . $fila[3] . "</td>";
            echo "<td>
                   <center><a onclick='eliminar(" . $fila[0] . ");' class='btn btn-danger btn-circle' title='Eliminar registro'><i class='fas fa-trash'></i></a>
                       <a href='#' class='btn btn-success btn-circle' title='Modificar registro'><i class='fas fa-bookmark'></i></a></center>
                   </td>";
            echo "</tr>";
        }

        echo '</tbody>
       </table>
   </div>';
    } else {
        echo "0";
    }
}


if ($opcion == "producto_consultar") {

    $codigo = $_POST['codigo'];
    $res = $producto->consultarProductoXcodigo($codigo);
    $row = mysqli_fetch_array($res);
    $datos = $row[1] . "-" . $row[3] . "-" . $row[6] . "-" . $row[7] . "-" . $row[8] . "-" . $row[9];
    echo $datos;
}

if ($opcion == "producto_agregar") {
    $codigo = $_POST['codigo'];
    $cantidad = $_POST['cantidad'];
    $existencia = $_POST['existencia'];

    $res = $producto->agregarInventarioProducto($existencia, $cantidad, $codigo);
    echo $res;
}

if ($opcion == "producto_registrar") {
    $codigo = $_POST['codigo'];
    $nombreComercial = $_POST['nombreComercial'];
    $nombreActivo = $_POST['nombreActivo'];
    $presentacion = $_POST['presentacion'];
    $tipo = $_POST['tipo'];
    $stock= $_POST['stock'];
    $pCosto = $_POST['pCosto'];
    $pVenta = $_POST['pventa'];
    $precioMayoreo = $_POST['precioMayoreo'];
    $existencia = $_POST['existencia'];
    $minimo = $_POST['minimo'];
    $a = [$codigo, $nombreActivo, $nombreComercial, $presentacion, $tipo, $pCosto, $pVenta, $precioMayoreo, $existencia, $minimo,$stock];
    $res = $producto->registrarProducto($a);

    echo $res;
}

if($opcion == "producto_modificar"){
    $id= $_POST['id'];
    $codigo = $_POST['codigo'.$id];
    $nombreComercial = $_POST['nombreComercial'.$id];
    $nombreActivo = $_POST['nombreActivo'.$id];
    $presentacion = $_POST['presentacion'.$id];
    $tipo = $_POST['tipo'.$id];
    $stock= $_POST['stock'.$id];
    $pCosto = $_POST['pCosto'.$id];
    $pVenta = $_POST['pVenta'.$id];
    $precioMayoreo = $_POST['precioMayoreo'.$id];
    $existencia = $_POST['existencia'.$id];
    $minimo = $_POST['minimo'.$id];
    $a = [$codigo, $nombreActivo, $nombreComercial, $presentacion, $tipo, $pCosto, $pVenta, $precioMayoreo, $existencia, $minimo,$stock];
    $res = $producto->modificarProducto($a);
    echo $res;
}

if ($opcion == "producto_eliminar") {
    $id = $_POST['id'];
    echo "hola";
    $res = $producto->eliminarProducto($id);
    echo $res;
}