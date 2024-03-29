<?php
require "../utils/utilidades.php";

$utils = new Utilidades();
$sesionIniciada = $utils->revisarSession(1);
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
        function revisaDatos() {
            var paquete = document.getElementById("paquete").value;
            var costo = [];
            
            if(paquete=="0"){
                alert("Tienes que seleccionar un paquete por favor");
                return false;
            }
            if (infoExtra == false) {
                costo = obtenerCosto(paquete);
                document.getElementById("tipoPaquete").value="normal";
            } else {
                document.getElementById("tipoPaquete").value="personalizado";
                costo[0] = document.getElementById("montoPaquete").value;
                costo[1] = document.getElementById("frecuenciaPaquete").value;
                const option = document.createElement('option');
                const valor = document.getElementById("nombrePaquete").value;
                if(valor==""){
                    alert("Por favor ingresa el nombre del paquete");
                    return false;
                }
                if(costo[0]=="" || costo[0] == 0){
                    alert("Por favor ingresa el costo del paquete");
                    return false;
                }
                if(costo[1] == "0"){
                    alert("Por favor ingresa la frecuencia del pago del paquete");
                    return false;
                }
                option.value = valor;
                option.text = valor;
                document.getElementById("paquete").appendChild(option);
                document.getElementById("paquete").value=valor;
            }

            document.getElementById("costo").value = costo[0];
            document.getElementById("frecuencia").value = costo[1];

            $.ajax({
                data: $("#formulario").serialize(),
                url: '../logicaNegocio.php',
                type: 'post',
                beforeSend: function() {

                },
                success: function(response) {
                 console.log(response);
                    if (response.trim() === "1") {
                        alert("Operación realizada exitosamente");
                        document.getElementById("formulario").reset();
                        document.getElementById("infoextra").reset();
                        document.getElementById("infoextra").style = "display:none;";
                    } else {
                        alert("Ocurrio un error, por favor vuelve a intentarlo");
                    }
                }
            });

        }

        function obtenerCosto(tipo) {
            var costo = [];
            if (tipo == "DIA GYM/BOX") {
                costo[0] = 50;
                costo[1] = "Día";
            }
            if (tipo == "SEMANA GYM/BOX") {
                costo[0] = 200;
                costo[1] = "Semana";
            }
            if (tipo == "QUINCENA GYM/BOX") {
                costo[0] = 300;
                costo[1] = "Quincena";
            }
            if (tipo == "MENSUALIDAD GYM") {
                costo[0] = 450;
                costo[1] = "Mensualidad";
            }
            if (tipo == "MENSUALIDAD BOX") {
                costo[0] = 400;
                costo[1] = "Mensualidad";
            }
            if (tipo == "MENSUALIDAD GYM+BOX") {
                costo[0] = 700;
                costo[1] = "Mensualidad";
            }
            if (tipo == "MENSUALIDAD GYM (PAREJA)") {
                costo[0] = 800;
                costo[1] = "Mensualidad";
            }
            if (tipo == "MENSUALIDAD BOX (PAREJA)") {
                costo[0] = 700;
                costo[1] = "Mensualidad";
            }
            if (tipo == "TRIMESTRE GYM") {
                costo[0] = 1100;
                costo[1] = "Trimestre";
            }
            if (tipo == "TRIMESTRE BOX") {
                costo[0] = 1000;
                costo[1] = "Trimestre";
            }
            if (tipo == "TRIMESTRE GYM+BOX") {
                costo[0] = 2100;
                costo[1] = "Trimestre";
            }
            if (tipo == "SEMESTRE GYM") {
                costo[0] = 2350;
                costo[1] = "Semestre";
            }
            if (tipo == "SEMESTRE BOX") {
                costo[0] = 2000;
                costo[1] = "Semestre";
            }
            if (tipo == "SEMESTRE GYM+BOX") {
                costo[0] = 4350;
                costo[1] = "Semestre";
            }
            if (tipo == "ANUALIDAD GYM") {
                costo[0] = 4500;
                costo[1] = "Anualidad";
            }
            if (tipo == "ANUALIDAD BOX") {
                costo[0] = 4000;
                costo[1] = "Anualidad";
            }
            return costo;
        }
        var infoExtra = false;

        function mostrarInfoExtra() {
            var paquete = document.getElementById("paquete").value;
            if (paquete == "OTRO") {
                infoExtra = true;
                document.getElementById("infoextra").style = "display:block;";
            } else {
                infoExtra = false;;
                document.getElementById("infoextra").style = "display:none;";
            }


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
                                    <form id="infoextra" style="display: none;" class="user">
                                        <p style="color: red;">Selecciona y registra los datos del paquete</p>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="nombrePaquete" id="nombrePaquete" class="form-control form-control-user" placeholder="Nombre del paquete" value="">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="number" name="montoPaquete" id="montoPaquete" class="form-control form-control-user" placeholder="costo del paquete" value="">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0 mt-2">
                                                <select class="form-control" name="frecuenciaPaquete" id="frecuenciaPaquete">
                                                    <option value="0">Selecciona cada cuanto se va a cobrar</option>
                                                    <option value="Día">Día</option>
                                                    <option value="Semana">Semana</option>
                                                    <option value="Quincena">Quincena</option>
                                                    <option value="Mensualidad">Mensualidad</option>
                                                    <option value="Trimestre">Trimestre</option>
                                                    <option value="Semestre">Semestre</option>
                                                    <option value="Anualidad">Anualidad</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="formulario" action="javascript:revisaDatos()" class="user">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="nombre" id="nombre" class="form-control form-control-user" placeholder="Nombre(s)" required>
                                            </div>

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="apellidos" id="apellidos" class="form-control form-control-user" placeholder="Apellidos">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                                                <input type="text" placeholder="Email" name="email" id="email" class="form-control form-control-user">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                                                <input type="date" name="nacimiento" id="nacimiento" class="form-control form-control-user">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="celular" id="celular" class="form-control form-control-user" placeholder="Celular">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select class="form-control" onchange="mostrarInfoExtra();" name="paquete" id="paquete">
                                                    <option value="0">Selecciona un paquete</option>
                                                    <option value="DIA GYM/BOX">Día gym/box </option>
                                                    <option value="SEMANA GYM/BOX">Semana gym/box </option>
                                                    <option value="QUINCENA GYM/BOX">Quincena gym/box </option>
                                                    <option value="MENSUALIDAD GYM">Mensualidad gym </option>
                                                    <option value="MENSUALIDAD BOX">Mensualidad box </option>
                                                    <option value="MENSUALIDAD GYM+BOX">Mensualidad gym+box </option>
                                                    <option value="MENSUALIDAD GYM (PAREJA)">Mensualidad gym (Pareja) </option>
                                                    <option value="MENSUALIDAD BOX (PAREJA)">Mensualidad box (Pareja) </option>
                                                    <option value="TRIMESTRE GYM">Trimestre gym </option>
                                                    <option value="TRIMESTRE BOX">Trimestre box </option>
                                                    <option value="TRIMESTRE GYM+BOX">Trimestre gym+box </option>
                                                    <option value="SEMESTRE GYM">Semestre gym </option>
                                                    <option value="SEMESTRE BOX">Semestre box </option>
                                                    <option value="SEMESTRE GYM+BOX">Semestre gym+box </option>
                                                    <option value="ANUALIDAD GYM">Anualidad gym </option>
                                                    <option value="ANUALIDAD BOX">Anualidad box </option>
                                                    <option value="OTRO">Otro</option>
                                                </select>
                                            </div>

                                        </div>
                                        <input type="hidden" name="costo" id="costo" value="0">
                                        <input type="hidden" name="frecuencia" id="frecuencia" value="0">
                                        <input type="hidden" name="tipoPaquete" id="tipoPaquete" value="normal">
                                        <input type="hidden" name="opcion" value="usuario_registrar">
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



</body>

</html>