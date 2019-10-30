<?php


include_once 'header.php';




?>

<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-12">
                <h1><?php echo $datos['title_topic'] ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php
                foreach ($datos['messages'] as $key => $value) {
                    ?>

                    <div class="card card-message mb-3">
                        <span class="card-header"><?php echo $value['date_creation'] ?></span>
                        <div class="row no-gutters">
                            <div class="user-data-message text-center p-3 col-md-3">
                                <div class="row">
                                    <div class="col-12">
                                        <img class="user-avatar" src="<?php echo $value['avatar'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <span class="username"><?php echo $value['nickname'] ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <span class="registry-user">Registrado: <?php echo $value['registry_date'] ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <span class="last-connection-user">Última conexion: <?php echo $value['last_connection'] ?></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $value['text'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>





    </div>
</div>

<?php

include_once 'footer.php';

?>