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
                                foreach ($datos['errors'] as $key => $value) {
                                    ?>

                                <li>
                                    <?php echo $value ?>
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
        ?>

        <?php

        if (!isset($datos['success'])) {
            ?>

            <div class="row">
                <div class="col-12">

                    <form action="index.php?url=UserController/registrer/" method="POST">

                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <label for="username">Nombre (*)</label>
                                <input type="text" name="username" class="form-control" id="username" required maxlength="20"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="surname">Apellidos</label>
                                <input type="text" name="surname" class="form-control" id="surname" maxlength="30"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <label for="nickname">Alias (*)</label>
                                <input type="text" name="nickname" class="form-control" id="nickname" required maxlength="40"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="email">Email (*)</label>
                                <input type="email" name="email" class="form-control" id="email" required maxlength="40"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <label for="pass">Contraseña (*)</label>
                                <input type="password" name="pass" class="form-control" required maxlength="20"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="confirm-pass">Confirmar contraseña (*)</label>
                                <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" required maxlength="20"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <label for="avatar">Avatar</label>
                                <input type="text" class="form-control" name="avatar" maxlength="300"/>
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
        }

        if (isset($datos['success'])) { ?>

            <div class="row">
                <div class="col-12">

                    <?php
                        if ($datos['success']) {
                            ?>
                        <div class="alert alert-success text-center" role="alert">
                            <p>Su registro se ha completado con éxito. Pulsa <a href="/foro-ddr/">aquí</a> para volver al inicio.</p>
                        </div>
                    <?php
                        } else {
                            ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <p>Su registro no se ha realizado con éxito. Contacte con discoduroderoer desde este <a href="https://www.discoduroderoer.es/contactanos/">formulario</a>.</p>
                        </div>
                    <?php
                        }
                        ?>


                </div>
            </div>

        <?php
        }
        ?>

    </div>
</div>



<?php

include_once 'footer.php';

?>