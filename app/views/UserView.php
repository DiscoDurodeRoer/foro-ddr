<?php

include_once 'header.php';

?>


<div class="row">
    <div class="col-12">

        <?php
        if (isset($data['registry']) || isset($data['edit_profile'])) {

        ?>

            <form action="index.php?url=UserController/<?php echo isset($data['registry']) ? 'registrer' : 'edit_profile'; ?>/" method="POST">

                <?php
                if (isset($data['edit_profile'])) {
                ?>
                    <input type="hidden" name="id_user" value="<?php echo $data['info_user']['id']; ?>" />
                    <input type="hidden" name="rol" value="<?php echo $data['info_user']['rol']; ?>" />
                <?php
                }
                ?>

                <div class="row form-group">
                    <div class="col-md-6 col-12">
                        <label for="name">Nombre (*)</label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="20" value="<?php if (isset($data['info_user'])) {
                                                                                                                echo $data['info_user']['name'];
                                                                                                            } ?>" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="surname">Apellidos</label>
                        <input type="text" name="surname" class="form-control" id="surname" maxlength="30" value="<?php if (isset($data['info_user'])) {
                                                                                                                        echo $data['info_user']['surname'];
                                                                                                                    } ?>" />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-6 col-12">
                        <label for="nickname">Alias (*)</label>
                        <input type="text" name="nickname" class="form-control" id="nickname" maxlength="40" value="<?php if (isset($data['info_user'])) {
                                                                                                                        echo $data['info_user']['nickname'];
                                                                                                                    } ?>" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="email">Email (*)</label>
                        <input type="email" name="email" class="form-control" id="email" maxlength="40" value="<?php if (isset($data['info_user'])) {
                                                                                                                    echo $data['info_user']['email'];
                                                                                                                } ?>" />
                    </div>
                </div>

                <?php
                if (isset($data['registry'])) {
                ?>
                    <div class="row form-group">
                        <div class="col-md-6 col-12">
                            <label for="pass">Contraseña (*)</label>
                            <input type="password" name="pass" class="form-control" maxlength="20" />
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="confirm-pass">Confirmar contraseña (*)</label>
                            <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" maxlength="20" />
                        </div>
                    </div>
                <?php
                }

                ?>


                <div class="row form-group">
                    <div class="col-12">
                        <label for="avatar">Avatar</label>
                        <input type="text" class="form-control" name="avatar" maxlength="300" />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <button type="submit" name="action" class="btn btn-primary btn-block"><?php echo isset($data['registry']) ? 'Registro' : 'Editar'; ?></button>
                    </div>
                    <div class="col-6">
                        <button type="submit" name="back" class="btn btn-primary btn-block">Volver</button>
                    </div>
                </div>

            </form>

        <?php
        } else if (isset($data['profile'])) {
        ?>


            <div class="card card-message mb-3">
                <h2 class="card-header">Perfil de usuario</h2>
                <div class="row no-gutters">
                    <div class="user-data-message text-center p-3 col-md-3">
                        <div class="row">
                            <div class="col-12">
                                <img class="user-avatar" src="<?php echo $data['info_user']['avatar'] ?>" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="username"><?php echo $data['info_user']['nickname'] ?></span>
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
                                                <td><?php echo $data['info_user']['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Apellidos</td>
                                                <td><?php echo $data['info_user']['surname'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $data['info_user']['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Registrado</td>
                                                <td><?php echo $data['info_user']['registry_date'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Última conexion</td>
                                                <td><?php echo $data['info_user']['last_connection'] ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Total posts</td>
                                                <td>0</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/display_topics_user/">
                                    <i class="fa fa-eye" aria-hidden="true"></i> Participaciones en topics
                                    </a>
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/display_edit_profile/">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Editar perfil
                                    </a>
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/edit_password/">
                                        <i class="fa fa-key" aria-hidden="true"></i></i> Cambiar contraseña
                                    </a>
                                    <?php
                                    if ($data['info_user']['rol'] != 1) {
                                    ?>
                                        <a class="btn btn-danger btn-icon" href="index.php?url=UserController/display_unsubscribe/">
                                            <i class="fa fa-user-times" aria-hidden="true"></i> Darse de baja
                                        </a>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else if (isset($data['change_password'])) {

        ?>

            <form action="index.php?url=UserController/change_password/" method="POST">

                <?php
                if (isset($data['user_key'])) {
                ?>
                    <input type="hidden" name="user_key" value="<?php echo $data['user_key']; ?>">
                <?php
                }
                ?>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="pass">Contraseña (*)</label>
                        <input type="password" name="pass" class="form-control" maxlength="20" />
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="confirm-pass">Confirmar contraseña (*)</label>
                        <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" maxlength="20" />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                    </div>
                </div>

            </form>


        <?php

        } else if (isset($data['display_unsubscribe'])) {
        ?>

            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12">
                            <h4>¿Estas seguro de que darte de baja? Ya no podras loguearte de nuevo con este usuario.</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-success btn-icon" href="index.php?url=UserController/unsubscribe/">
                                <i class="fa fa-check" aria-hidden="true"></i> Si
                            </a>
                            <a class="btn btn-danger btn-icon" href="index.php?url=UserController/no_unsubscribe/">
                                <i class="fa fa-times" aria-hidden="true"></i> No
                            </a>
                        </div>
                    </div>

                </div>
            </div>



        <?php
        } else if (isset($data['display_topics_user'])) {
        ?>

            <div class="row">
                <div class="col-12">
                    <h1>Topics en los que has participado</h1>
                </div>
            </div>

            <?php

            if ($data['has_results']) {
            ?>

                <table class="table">

                    <tr>
                        <th>Topic</th>
                        <th>Ultimo mensaje</th>
                        <th>Número de posts</th>
                    </tr>

                    <?php

                    foreach ($data['topics_user'] as $key => $value) {
                        echo "<tr>";

                        echo "<td><a href='index.php?url=MessageController/display/" . $value['id_topic'] . "'>" . $value['title'] . "</a></td>";
                        echo "<td>" . $value['date_last_message'] . "</td>";
                        echo "<td>" . $value['num_post'] . "</td>";

                        echo "</tr>";
                    }
                    ?>
                </table>
            <?php
            } else {
            ?>
                <p>No has participado en ningún topic.</p>
            <?php
            }
            ?>

        <?php
        }
        ?>

    </div>
</div>



<?php

include_once 'footer.php';

?>