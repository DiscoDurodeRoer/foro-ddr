<?php


include_once 'header.php';



if (isset($datos['display'])) {
    ?>
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-10">
                    <h1><?php echo $datos['title_topic'] ?></h1>
                </div>
                <?php
                    if ($datos['login']) {
                        ?>
                    <div class="col-2">
                        <a class="btn btn-primary btn-block btn-icon" href="index.php?url=MessageController/display_reply_topic/<?php echo $datos['id_topic']; ?>">
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

            <!-- Quick reply -->
            <div class="row">
                <div class="col-12">


                    <div class="row">
                        <div class="col-12">
                            <h2>Respuesta rápida</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <form action="index.php?url=MessageController/reply_topic" method="POST">

                                <input type="hidden" name="id_topic" value="<?php echo $datos['id_topic']; ?>">

                                <div class="row form-group">
                                    <div class="col-12">
                                        <textarea required class="form-control" name="text" id="message" cols="30" rows="3"></textarea>
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



        </div>
    </div>
<?php
} else if (isset($datos['reply_message'])) {
    ?>
    <form action="index.php?url=MessageController/reply_topic" method="POST">

        <input type="hidden" name="id_topic" value="<?php echo $datos['id_topic']; ?>">

        <div class="row form-group">
            <div class="col-12">
                <label for="message">Mensaje</label>
                <textarea required class="form-control" name="text" id="message" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Responder</button>
            </div>
        </div>


    </form>
<?php
}
?>



<?php

include_once 'footer.php';

?>