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
        function revisaDatos() {


            var parametros = {
                "email": email,
                "pass": pass
            };

            $.ajax({
                data: $("#formulario").serialize(),
                url: 'logic/logica.php',
                type: 'post',
                beforeSend: function() {

                },
                success: function(response) {

                    if (response.trim() === "0") {
                        alert("Datos no encontrados");
                    } else {
                        if (response.trim() === "1") {
                            location.href = "logic/menu.php";
                        } else {
                            location.href = "logic/menuEmpleado.php";
                        }
                    }
                }
            });

        }

        function redirecciona() {

            var codi = document.getElementById("codigo").value;
            
            var parametros = {
                "codigo": codi,
                "opcion": "acceso"
            };

            $.ajax({
                data: parametros,
                url: 'logic/logicaNegocio.php',
                type: 'post',
                beforeSend: function() {
                },
                success: function(response) {
                    console.log(response);
                     if (response === "Datos no encontrados") {
                        alert("Datos no encontrados");
                    } else {
                   //    location.href = "resul-acceso.php?codigo="+codi+"&pago="+response.trim();
                    } 
                }
            });
        }

        var codigo = "";

        function llenaCodigo(valor) {
            codigo = codigo + valor;
            if (codigo.length <= 4)
                document.getElementById("codigo").value = codigo;

        }

        function limpiarCodigo() {
            codigo = "";
            document.getElementById("codigo").value = "";

        }

      

        
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

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">

                                        <h1 class="h4 text-gray-900 mb-4">Bienvenid@!</h1>
                                        <!--  <img src="img/logoGym.jpg"/><br/>-->
                                    </div>
                                    <center>
                                        <table>
                                            <tr align="center">
                                                <td colspan="3"><input type="text" name="codigo" id="codigo" value="" disabled><br><br></td>
                                            </tr>
                                            <tr>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(1);">1</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(2);">2</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(3);">3</button></td>
                                            </tr>
                                            <tr>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(4);">4</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(5);">5</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(6);">6</button></td>
                                            </tr>
                                            <tr>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(7);">7</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(8);">8</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(9);">9</button></td>
                                            </tr>
                                            <tr>
                                                <td width="200"><button class="btn btn-success btn-user btn-block" onclick="redirecciona();">ACEPTAR</button></td>
                                                <td width="200"><button class="btn btn-primary btn-user btn-block" onclick="llenaCodigo(0);">0</button></td>
                                                <td width="200"><button class="btn btn-danger btn-user btn-block" onclick="limpiarCodigo();">BORRAR</button></td>
                                            </tr>
                                        </table>
                                    </center>

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