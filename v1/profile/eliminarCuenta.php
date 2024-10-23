<!DOCTYPE html>
<?php
include 'conexion_.php';

if (isset($_POST['button'])) {

     $email = $_POST['email'];
     if($email == "")
     {
        echo'<script type="text/javascript">
        alert("Ingresa tu correo para poder eliminar la cuenta");
        window.location.href="eliminarCuenta.php";
        </script>';
     }
     else
     {

        
        $sql = "DELETE FROM users_ecommerce WHERE email=:email";
        $sql = $connect->prepare($sql);

        $sql->bindParam(':email',$email ,PDO::PARAM_STR, 55);
        $sql->execute();
        $lastInsertId = $connect->lastInsertId();

        if($sql->rowCount() > 0)
        {
            echo'<script type="text/javascript">
            alert("Cuenta eliminada");
            window.location.href="index.html";
            </script>';
        }
        else{
            echo'<script type="text/javascript">
            alert("Ocurrio un Error al Eliminar la Cuenta");
            window.location.href="eliminarCuenta.php";
            </script>';
        }
       
        $conn->close();
    
        
    }

    $conn->close();
   
}

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Monosoft-Devs</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><!-- <img src="/assets/img/navbar-logo.svg" alt="..." /> -->Monosoft</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead">
        <div class="container-fluid row justify-content-md-center">
            <label for="exampleInputEmail1">Ingrese su correo para eliminar su cuenta</label>
            <form action="eliminarCuenta.php" method="post">
                <div class="form-group row justify-content-md-center">
                    <label for="exampleInputEmail1">Correo</label>
                    <input name="email"  type="email" class="form-control w-25 p-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <br>
                <br>
                <button  name="button" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </header>
        
              <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
