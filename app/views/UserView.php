<?php

include_once 'header.php';

?>


<div class="row">
    <div class="col-12">


        <?php

        if (isset($datos['errors'])) {
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php
                                foreach ($datos['errors'] as $key => $datos['info_user']) {
                                    ?>

                                <li>
                                    <?php echo $datos['info_user'] ?>
                                </li>
                            <?php
                                }
                                ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        }


        if (isset($datos['success'])) { ?>

            <div class="row">
                <div class="col-12">

                    <div class="alert <?php echo $datos['success'] ? 'alert-success' : 'alert-danger' ?> text-center" role="alert">
                        <p><?php echo $datos['message']; ?></p>
                    </div>

                </div>
            </div>

        <?php
        } else if (isset($datos['registry']) || isset($datos['edit_profile'])) {

            ?>

            <div class="row">
                <div class="col-12">

                    <form action="index.php?url=UserController/registrer/" method="POST">

                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <label for="username">Nombre (*)</label>
                                <input type="text" name="username" class="form-control" id="username" required maxlength="20" />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="surname">Apellidos</label>
                                <input type="text" name="surname" class="form-control" id="surname" maxlength="30" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <label for="nickname">Alias (*)</label>
                                <input type="text" name="nickname" class="form-control" id="nickname" required maxlength="40" />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="email">Email (*)</label>
                                <input type="email" name="email" class="form-control" id="email" required maxlength="40" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <label for="pass">Contraseña (*)</label>
                                <input type="password" name="pass" class="form-control" required maxlength="20" />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="confirm-pass">Confirmar contraseña (*)</label>
                                <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" required maxlength="20" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <label for="avatar">Avatar</label>
                                <input type="text" class="form-control" name="avatar" maxlength="300" />
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Registro</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        <?php
        } else if (isset($datos['profile'])) {
            ?>


            <div class="card card-message mb-3">
                <h2 class="card-header">Perfil de usuario</h2>
                <div class="row no-gutters">
                    <div class="user-data-message text-center p-3 col-md-3">
                        <div class="row">
                            <div class="col-12">
                                <img class="user-avatar" src="<?php echo $datos['info_user']['avatar'] ?>" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="username"><?php echo $datos['info_user']['nickname'] ?></span>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-9">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nombre</td>
                                                <td><?php echo $datos['info_user']['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Apellidos</td>
                                                <td><?php echo $datos['info_user']['surname'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $datos['info_user']['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Registrado</td>
                                                <td><?php echo $datos['info_user']['registry_date'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Última conexion</td>
                                                <td><?php echo $datos['info_user']['last_connection'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total posts</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/edit_profile/">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Editar perfil
                                    </a>
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/edit_password/">
                                        <i class="fa fa-key" aria-hidden="true"></i></i> Cambiar contraseña
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else if (isset($datos['change_password'])) {

            ?>

            <form action="index.php?url=UserController/change_password/" method="POST">

                <div class="row form-group">
                    <div class="col-12">
                        <label for="pass">Contraseña (*)</label>
                        <input type="password" name="pass" class="form-control" required maxlength="20" />
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="confirm-pass">Confirmar contraseña (*)</label>
                        <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" required maxlength="20" />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                    </div>
                </div>

            </form>


        <?php

        }
        ?>

    </div>
</div>



<?php

include_once 'footer.php';

?>