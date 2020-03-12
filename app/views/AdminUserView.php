<?php
require_once 'AdminView.php'
?>

<div class="col-md-9">

    <div class="row">
        <div class="col-12">
            <h1>Usuarios</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <table class="table">

                <tr>
                    <th>ID</th>
                    <th>Nickname</th>
                    <th>Email</th>
                    <th>Baneo</th>
                    <th>Activado</th>
                </tr>
                <?php

                foreach ($data['users'] as $key => $value) {
                ?>
                    <tr>
                        <td><?php echo $value['id']; ?></td>
                        <td><?php echo $value['nickname']; ?></td>
                        <td><?php echo $value['email']; ?></td>

                        <td><?php
                            if ($value['rol'] === IS_USER) {
                                if ($value['baneado'] === TRUE) {
                            ?>

                                    <a class="btn btn-success btn-icon" title="Desbanear usuario" href="index.php?url=AdminUserController/noBanUser/<?php echo $value['id']; ?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="btn btn-danger btn-icon" title="Banear usuario" href="index.php?url=AdminUserController/banUser/<?php echo $value['id']; ?>">
                                        <i class="fa fa-ban"></i>
                                    </a>

                            <?php
                                }
                            }

                            ?></td>
                        <td><?php
                            if ($value['rol'] === IS_USER) {
                                if ($value['borrado'] === TRUE) {
                            ?>

                                    <a class="btn btn-success btn-icon" title="Activar usuario" href="index.php?url=AdminUserController/noActUser/<?php echo $value['id']; ?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="btn btn-danger btn-icon" title="Desactivar usuario" href="index.php?url=AdminUserController/actUser/<?php echo $value['id']; ?>">
                                        <i class="fa fa-ban"></i>
                                    </a>

                            <?php
                                }
                            }
                            ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>




</div>

<?php
require_once 'AdminFooter.php';
?>