<?php


include_once 'header.php';


?>

<div class="row">
    <div class="col-12">
        <?php include 'breadcumb.php'; ?>
    </div>
</div>

<div class="row">
    <div class="col-12">

        <?php
        if (isset($data['display'])) {
        ?>
            <div class="row">
                <div class="col-12">

                    <?php
                    if ($data['open_topic'] == FALSE) {
                    ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info" role="alert">
                                    <strong>Este hilo esta cerrado, por lo que no podrás responder.</strong>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($data['message_solution'])) {
                    ?>
                        <div class="message-solution">
                            <h1>Solución</h1>
                            <div id="<?php echo $data['message_solution']['message_index']; ?>" class="card card-message mb-3">
                                <div class="card-header row no-gutters">
                                    <div class="col-12 ">
                                        <?php echo $data['message_solution']['date_creation'] ?>
                                    </div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="user-data-message p-3 col-md-3">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <img class="user-avatar" src="<?php echo $data['message_solution']['avatar'] ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <span class="username"><?php echo $data['message_solution']['nickname'] ?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <span class="registry-user"><?php echo $data['message_solution']['rol_name'] ?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="registry-user">Registrado: <?php echo $data['message_solution']['registry_date'] ?></span>
                                            </div>
                                        </div>
                                        <!--<div class="row">
                                            <div class="col-12">
                                                <span class="last-connection-user">Última conexion: <?php echo $data['message_solution']['last_connection'] ?></span>
                                            </div>
                                        </div>-->

                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $data['message_solution']['text'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php
                    }

                    ?>

                    <div class="row mb-2 mt-2">
                        <div class="col-md-10 col-12">
                            <h1><?php echo $data['title_topic'] ?></h1>
                        </div>
                        <?php
                        if ($data['login'] && $data['open_topic']) {
                        ?>
                            <div class="col-md-2 col-12 mt-2">
                                <a class="btn btn-primary btn-block btn-icon" href="<?php echo BASE_URL; ?>responder-mensaje-form/<?php echo $data['id_topic']; ?>">
                                    <i class="fa fa-comment" aria-hidden="true"></i> Responder
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>



                    <div class="row">
                        <div class="col-12">
                            <?php
                            foreach ($data['messages'] as $index => $value) {
                            ?>

                                <div id="<?php echo $value['message_index']; ?>" class="card card-message mb-3">
                                    <div class="card-header row no-gutters">
                                        <div class="col-3 ">
                                            <?php echo $value['date_creation'] ?>
                                        </div>
                                        <?php
                                            if(isset($data['can_mark_solution'])){
                                            ?>

                                            <div class="col-3 offset-6 text-right" >
                                                <a href="<?php echo BASE_URL; ?>marcar-mensaje-solucion/<?php echo $data['id_topic']; ?>/<?php echo $value['id_message'] ?>">Marcar como solución</a>
                                            </div>
                                            <?php
                                            }
                                        ?>
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="user-data-message p-3 col-md-3">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <img class="user-avatar" src="<?php echo $value['avatar'] ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <span class="username"><?php echo $value['nickname'] ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <span class="registry-user"><?php echo $value['rol_name'] ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="registry-user">Fecha de registro: <?php echo $value['registry_date'] ?></span>
                                                </div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-12">
                                                    <span class="last-connection-user">Última conexion: <?php echo $value['last_connection'] ?></span>
                                                </div>
                                            </div>-->

                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <p class="card-text"><?php echo $value['text'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if(($index + 1) % SHOW_AD_MONETYZER_EACH == 0){
                                    include 'ads-monetyzer.php';
                                } ?>


                            <?php
                            }
                            ?>
                        </div>
                    </div>


                    <?php
                    if ($data['login'] && $data['open_topic']) {
                    ?>

                        <div class="row">
                            <div class="col-12">
                                <?php
                                include_once "pagination-controls.php";
                                ?>
                            </div>
                        </div>

                        <!-- Quick reply -->
                        <div class="row margin-from-footer">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-12">
                                        <h2>Respuesta rápida</h2>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">

                                        <form class="reply-fast" action="<?php echo BASE_URL; ?>responder-mensaje" method="POST" novalidate>

                                            <input type="hidden" name="id_topic" value="<?php echo $data['id_topic']; ?>">

                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <textarea required class="form-control" name="text" id="editor" cols="30" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Responder</button>
                                                </div>
                                            </div>


                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php
                    }else{
                        ?>

                        <div class="row margin-from-footer">
                            <div class="col-12">
                                <?php
                                include_once "pagination-controls.php";
                                ?>
                            </div>
                        </div>

                        <?php
                    }

                    ?>

                </div>
            </div>
        <?php
        } else if (isset($data['reply_message'])) {
        ?>
            <div class="row">
                <div class="col-12 margin-from-footer">

                    <form action="<?php echo BASE_URL; ?>responder-mensaje" method="POST" novalidate>

                        <input type="hidden" name="id_topic" value="<?php echo $data['id_topic']; ?>">

                        <div class="row form-group">
                            <div class="col-12">
                                <label for="editor">Mensaje</label>
                                <textarea required class="form-control" name="text" id="editor" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <button type="submit" name="action" class="btn btn-primary btn-block">Responder</button>
                            </div>
                            <div class="col-6">
                                <button type="button" name="back" class="btn btn-primary btn-block">Volver</button>
                            </div>
                        </div>

                    </form>
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