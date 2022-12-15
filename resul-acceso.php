<?php
require "logic/dao/usuario.php";
$codigo = $_GET["codigo"];
$pago=$_GET["pago"];
$objUsu = new Usuario();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>SR</title>
    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        function redirecciona() {
            location.href = "home-acceso.php";
        }
        setTimeout(redirecciona, 3000);
    </script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" <?php if($pago=="Correcto") {echo 'style="background-color: greenyellow;"';} else{ echo 'style="background-color: red;"';} ?>>
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php
                                        $usuario = $objUsu->buscarByCodigo($codigo);
                                        $info = mysqli_fetch_assoc($usuario);
                                        ?>
                                        <h1 class="h4 mb-4" style="color:white;">Bienvenid@ <?php echo $info["nombre"]; ?></h1>
                                        <br>
                                        <?php $partida1 = explode("-", $info["fecha_nacimiento"]);
                                        $date_nueva = date('Y-m-d');
                                        $partida2 = explode("-", $date_nueva);
                                        if ($partida1[1] == $partida2[1] && $partida1[2] == $partida2[2]) {
                                            echo ' <h1 class="h4 mb-4" style="color:white;>QUE TENGAS UN MUY FELIZ CUMPLEAÑOS</h1>  ';
                                        }  ?>
                                        <?php if($pago=="Correcto") {echo '<h1 class="h4 mb-4" style="color:white;">PUEDES INGRESAR AL GYM</h1>';} else{ echo '<h1 class="h4  mb-4" style="color:white;">POR FAVOR REALIZA TU PAGO. ¡¡ESTAS ATRASADO!!</h1>';} ?>
                                        
                                        <!--  <img src="img/logoGym.jpg"/><br/>-->
                                    </div>


                                    <div class="text-center">
                                        <a class="small" href="#">Athletic Gym</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- <script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>