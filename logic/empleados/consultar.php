<?php
require "../utils/utilidades.php";
require "../dao/empleado.php";

$utils= new Utilidades();
$sesionIniciada=$utils->revisarSession(1);
$empleado= new Empleado();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Santa Rosa</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
     <script type="text/javascript">
        function eliminar(id){
          info=confirm("Seguro deseas eliminar los datos del usuario");

          var parametros = {
               "id": id,
               "opcion":"empleado_eliminar"
             };

          if(info===true){

            $.ajax({
                data: parametros,
                url: '../logicaNegocio.php',
                type: 'post',
                beforeSend: function() {
                   
                },
                success: function(response) {
                 alert(response);
                    if (response.trim() != "0") {
                     
                       document.getElementById("datosTabla").innerHTML = response;
                    } else {
                        alert("Ocurrio un error, por favor vuelve a intentarlo");
                    }
                }
            });
          }
        }

        function revisaDatos(id,nombre) {
            respuesta=confirm('Seguro deseas modificar del empleado: ' + nombre);
            if(respuesta==false){
                return false;
            }
            var pass1 = document.getElementById("pass1").value;
            var pass2 = document.getElementById("pass2").value;
            
            
            if (pass1 != pass2 ) {
                alert("Tus contraseñas no son iguales, revisa tus datos ingresados");
                return false;
            }
  
            $.ajax({
                data: $("#formulario"+id).serialize(),
                url: '../logicaNegocio.php',
                type: 'post',
                beforeSend: function() {
                   
                },
                success: function(response) {
               
                    if (response.trim() === "1") {
                        location.reload(); 
                    } else {
                        alert("Ocurrio un error, por favor vuelve a intentarlo");
                    }
                }
            });

        }
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SR Administración</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">



<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Menu
</div>

<!-- Nav Item - Pages Collapse Menu -->



<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user"></i>
        <span>Empleados</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Operaciones usuarios</h6>
           <!-- <a class="collapse-item" href="../empleados/registrar.php">Registro</a>-->
            <a class="collapse-item" href="../empleados/consultar.php">Consulta</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-address-book"></i>
        <span>Inventario</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Operaciones inventario:</h6>
            <!--<a class="collapse-item" href="../inventario/registro.php">Alta</a>-->
            <a class="collapse-item" href="../inventario/consultar.php">Datos</a>
            <a class="collapse-item" href="../inventario/bajos.php">Productos bajos</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-cash-register"></i>
        <span>Productos</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Operaciones de productos:</h6>
            <!--<a class="collapse-item" href="../productos/registro.php">Registrar</a>-->
            <a class="collapse-item" href="../productos/consultar.php">Consultar</a>
            <a class="collapse-item" href="../productos/ventas-periodo.php">Ventas por periodo</a>
         
            <a class="collapse-item" href="../productos/productos-eliminados.php">Productos eliminados</a>
        </div>              </div>
</li>





<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="../varios/bitacora.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Bitacora</span></a>
</li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
                <a class="nav-link" href="../areas/mostrarAreas.php">
                    <i class="fas fa-fw fa-share-square"></i>
                    <span>Areas</span></a>
            </li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre']; ?></span>
                                <img class="img-profile rounded-circle" src="../../img/undraw_profile_3.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                       <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <!--   <h1 class="h3 mb-0 text-gray-800">Consultar datos empleado</h1>-->
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div> 
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <center><h6 class="m-0 font-weight-bold text-primary">Consultar datos empleados</h6></center>
                        </div>
                        <div class="card-body">
                            <div id="datosTabla">
                            <div class="table-responsive">
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
                                    <tbody>
                                        <?php
                                        $res=$empleado->consultarEmpleados();
                                        $modales="";
                                        $i=1;
                                        while ($fila = mysqli_fetch_row($res)) {
                                            echo "<tr>";
                                            echo "<td>".$fila[1]."</td>";
                                            echo "<td>".$fila[2]."</td>";
                                            echo "<td>".$fila[3]."</td>";
                                            echo "<td>
                                            <center><a onclick='eliminar(".$fila[0].");' class='btn btn-danger btn-circle' title='Eliminar registro'><i class='fas fa-trash'></i></a>
                                                <a href='#' data-toggle='modal' data-target='#modificarModal".$i."' class='btn btn-success btn-circle' title='Modificar registro'><i class='fas fa-bookmark'></i></a></center>
                                            </td>";
                                            echo "</tr>";
                                            
                                            $modales=$modales.'  
                                            <div class="modal fade" id="modificarModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modificar datos empleado</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                         <div class="modal-body">
                                                         
                                                         <form id="formulario'.$i.'" action="javascript:revisaDatos('.$i.',\''.$fila[1].'\')" class="user">
                                <div class="form-group row">
                                
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <label>Nombre:</label>    
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-user" value="'.$fila[1].'" id="exampleFirstName"
                                            placeholder="Nombre(s)" required>
                                    </div>
                                 
                                </div>
                                <div class="form-group">
                                <label>Nombre de usuario:</label>    
                                    <input type="text" name="usuario" id="usuario" class="form-control form-control-user"  value="'.$fila[3].'" id="exampleInputEmail"
                                        placeholder="Nombre de usuario" readonly required>
                                </div>
                                <div class="form-group">
                                <label>Dirección:</label>    
                                    <input type="text" name="direccion" id="direccion" class="form-control form-control-user" value="'.$fila[2].'" id="exampleInputEmail"
                                        placeholder="Dirección" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="pass1" id="pass1" class="form-control form-control-user"
                                            id="exampleInputPassword" value="'.$fila[4].'" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="pass2" id="pass2" class="form-control form-control-user"
                                            id="exampleRepeatPassword" value="'.$fila[4].'" placeholder="Repite Password" required>
                                    </div>
                                </div>
                                <input type="hidden" name="opcion" value="empleado_modificar">
                                <input type="hidden" name="id" value="'.$fila[0].'">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Modificar datos" />
                               
                              
                            </form>

                                                         </div> 
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" id="btnCancelar" type="button" data-dismiss="modal">Cancelar</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/> ';
                                        $i++;
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>



                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> M.S.C. Job  &copy; Sistema Santa Rosa</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿List@ para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!--       <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../varios/cerrarSesion.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <?php echo $modales;?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

      <!-- Page level plugins -->
      <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>