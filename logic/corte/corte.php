<?php
require "../utils/utilidades.php";
require "../dao/corte.php";

$objCor = new Corte();
$utils = new Utilidades();
$sesionIniciada=$utils->revisarSession(2);
$tipo_usuario=$_SESSION["tipo"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Athletic Gym</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <script>
        function buscarporLapsosDeFecha() {

            fi = document.getElementById("fechaInicio").value;
            ff = document.getElementById("fechaFin").value;

            location.href = "corte.php?fi=" + fi + "&ff=" + ff;

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
            <!-- Nav Item - Tables -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones usuarios</h6>
                        <a class="collapse-item" href="../usuarios/registrar.php">Registro</a>
                        <a class="collapse-item" href="../usuarios/consultar.php">Consulta</a>
                        <a class="collapse-item" href="../usuarios/verpagos.php">Ver falta de pago</a>
                        <a class="collapse-item" href="../usuarios/veraccesos.php">Ver acceso al GYM</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Entradas/Salidas</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Entradas y salidas:</h6>
                        <!--<a class="collapse-item" href="inventario/registro.php">Alta</a>-->
                        <a class="collapse-item" href="../entrada-salida/registrar.php">Registrar entrada/salida</a>
                        <a class="collapse-item" href="../entrada-salida/consultar.php">Consultar entrada/salida</a>
                    </div>
                </div>
            </li>
            <?php if($tipo_usuario!="Empleado"){ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Ver flujo de efectivo</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Flujo efectivo</h6>
                        <!--<a class="collapse-item" href="inventario/registro.php">Alta</a>-->
                        <a class="collapse-item" href="../corte/corte.php">Realizar corte</a>
                    </div>
                </div>
            </li>
            <?php } ?>



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
                                <img class="img-profile rounded-circle" src="../../img/undraw_profile_2.svg">
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
                        <h1 class="h3 mb-0 text-gray-800">Corte</h1>
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
                                    <div class="form-group row">
                                        <div class="col-sm-3 pt-4">
                                            Fecha inicio:
                                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control">
                                        </div>
                                        <div class="col-sm-3 pt-4">
                                            Fecha Fin:
                                            <input type="date" name="fechaFin" id="fechaFin" class="form-control">
                                        </div>
                                        <div class="col-sm-6 pt-5">

                                            <a href="#" onclick="buscarporLapsosDeFecha();" class="btn btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Buscar por lapsos</span>
                                            </a>
                                        </div>
                                    </div>

                                     <?php
                                    $fi = "";
                                    $ff = "";
                                    if (isset($_GET["fi"])) {
                                        $fi = $_GET["fi"];
                                        $ff = $_GET["ff"];

                                        $entradas = $objCor->obtenerEntradaSalida($fi, $ff, "Entrada");
                                        $salidas = $objCor->obtenerEntradaSalida($fi, $ff, "Salida");
                                        $mensualidades = $objCor->obtenerGananciasGYM($fi, $ff);
                                        $ingresos= $objCor->obtenerTotalDeRegistros($fi,$ff);
                                        $total = $entradas + $mensualidades - $salidas;

                                    ?>
                                     <br><br>
                                            <h4><strong>De:</strong> <?php echo $fi. "<strong> A </strong>" .$ff; ?></h4>
                                        <center>
                                       
                                         
                                            <h1>Información del GYM</h1>
                                            <br><br>
                                            <h3><strong>+ Entradas: </strong><?php echo $entradas; ?></h3><br>
                                            <h3><strong>+ Mensualidades: </strong><?php echo $mensualidades; ?></h3><br>
                                            <h3><strong>- Salidas: </strong><?php echo $salidas; ?></h3><br>
                                            <h3><strong>Total utilidad: </strong><?php echo $total; ?></h3><br>
                                            <br><br>
                                            <h3><strong>Nuevo asociados: </strong><?php echo $ingresos; ?></h3><br>
                                        </center>

                                    <?php

                                    }


                                    ?>

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
                        <span> M.S.C. Job &copy; Athletic Gym</span>
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