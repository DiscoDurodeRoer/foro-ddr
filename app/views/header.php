<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./includes/bootstrap-4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./includes/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Foro DDR</title>
</head>

<body>

    <div class="row-no-gutters" id="header">
        <!-- Cabecera -->
        <!-- <div class="row" id=""> -->
        <div class="col-12 mt-2">
            <!-- Menu -->

            <div class="container">

                <div class="row">
                    <div class="col-md-4 col-12 block-logo">
                        <a class="navbar-brand" href="index.php">
                            <img src="img/logo-foro.png" alt="">
                        </a>
                    </div>
                    <div class="col-md-8 col-12 mt-2 block-buttons">

                        <?php

                        if ($data['login']) {

                            $nickname = $data['nickname'];

                        ?>

                            <span class="greeting mr-3">Hola, <?php echo $nickname ?></span>

                            <?php
                            if ($data['isAdmin']) {
                            ?>
                                <a class="btn btn-success btn-icon" href="index.php?url=AdminController/display">
                                    <i class="fa fa-home" aria-hidden="true"></i>Admin
                                </a>
                            <?php
                            }

                            ?>

                            <a class="btn btn-info btn-icon" href="index.php?url=NoReadMessagesPublicController/display/">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>Mensajes no leidos
                            </a>

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



            </div>

        </div>
    </div>

    <!-- Contenido -->
    <div class="row-no-gutters vh-100" id="content">
        <div class="col-12">
            <div class="container">
                <div class="content-start">

                    <?php
                    include_once "show-info-message.php";
                    ?>