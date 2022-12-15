<?php
require "../utils/utilidades.php";

$utils= new Utilidades();
$sesionIniciada=$utils->revisarSession(1);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bibianas GYM</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <script>
          function revisaDatos() {
            var pass1 = document.getElementById("pass1").value;
            var pass2 = document.getElementById("pass2").value;
            
            if (pass1 != pass2 ) {
                alert("Tus contraseñas no son iguales, revisa tus datos ingresados");
                return false;
            }
  
            $.ajax({
                data: $("#formulario").serialize(),
                url: '../logicaNegocio.php',
                type: 'post',
                beforeSend: function() {
                   
                },
                success: function(response) {
                  alert(response);
                    if (response.trim() === "1") {
                       alert("Datos registrados correctamente");
                       document.getElementById("formulario").reset();
                    } else {
                        if(response.trim() === "2"){
                            alert("No se pudo registrar al empleado, el nombre de usuario ya esta ocupado");
                        }else{
                            alert("Ocurrio un error, por favor vuelve a intentarlo");
                        }
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
                        <h1 class="h3 mb-0 text-gray-800">Registrar datos usuario</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div> 

                    <!-- Content Row -->
                    <div class="row">



                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <!-- <center>
                                        <h6 class="m-0 font-weight-bold text-primary">Bienvenid@</h6>
                                    </center> -->
                                </div>
                                <div class="card-body">
                                <form id="formulario" action="javascript:revisaDatos()" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Nombre(s)" required>
                                    </div>
            
                                </div>
                                <div class="form-group">
                                    <input type="text" name="apellidos" id="apellidos" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Nombre de usuario" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="direccion" id="direccion" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Dirección" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="pass1" id="pass1" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="pass2" id="pass2" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repite Password" required>
                                    </div>
                                </div>
                                <input type="hidden" name="opcion" value="empleado_registrar">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Registrar datos" />
                               
                              
                            </form>
                                   
                                </div>
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
                        <span> M.S.C. Job  &copy; Bibianas GYM</span>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <script src="../../js/jquery-3.5.1.min.js"></script>

</body>

</html>