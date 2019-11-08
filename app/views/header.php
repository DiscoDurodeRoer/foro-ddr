
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./includes/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./includes/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./includes/jquery-3.4.1/jquery-3.4.1.min.js"></script>
    <script src="./includes/bootstrap-4.1.3/js/bootstrap.min.js"></script>
    <title>Test</title>
</head>

<body>

    <div class="container-fluid" id="page">
        <!-- Cabecera -->
        <div class="row" id="header">
            <div class="col-12">
                <!-- Menu -->

                <div class="container">

                    <nav class="navbar navbar-expand-sm navbar-light">
                        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavId">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                                        <a class="dropdown-item" href="#">Action 1</a>
                                        <a class="dropdown-item" href="#">Action 2</a>
                                    </div>
                                </li>
                            </ul>
                            <div>
                                <?php
                             
                                if ($datos['login']) {
                                    
                                    $nickname = $datos['nickname'];
                                    
                                    ?>
                                    
                                    <p>Hola, <?php echo $nickname ?></p>


                                    <a class="btn btn-info btn-icon" href="index.php?url=UserController/display_profile/">
                                    <i class="fa fa-user" aria-hidden="true"></i>Ver perfil
                                    </a>
                                    
                                    <a class="btn btn-danger btn-icon" href="index.php?url=UserController/logout/">
                                        <i class="fa fa-power-off" aria-hidden="true"></i>Logout
                                    </a>

                                <?php
                                } else {
                                    ?>
                                    <a class="btn btn-primary btn-icon" href="index.php?url=UserController/display/">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>Registrarse
                                    </a>
                                    <a class="btn btn-success btn-icon" href="index.php?url=LoginController/display/">
                                        <i class="fa fa-user" aria-hidden="true"></i>Iniciar sesión
                                    </a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </nav>

                </div>

            </div>
        </div>

        <!-- Contenido -->
        <div class="row" id="content">
            <div class="col-12">
                <div class="container">
                    <div class="content-start">