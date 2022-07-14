<?php

include_once 'header.php';

?>
<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-12">
                <?php include 'breadcumb.php'; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12 margin-from-footer">

                <?php

                if (isset($data['display'])) {
                ?>

                    <div class="row">
                        <div class="col-md-9 col-12 mt-2">
                            <h1><?php echo $data['name_category']  ?></h1>
                        </div>
                        <?php
                        if ($data['login']) {
                        ?>
                            <div class="col-md-3 col-12">
                                <a class="btn btn-primary btn-block btn-icon" href="<?php echo BASE_URL; ?>crear-topic-form/<?php echo $data['id_cat']; ?>">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Crear topic
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-12 table-responsive mt-2">
                            <table class="table text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Topic</th>
                                        <th scope="col">Creador</th>
                                        <th scope="col">Respuestas</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($data['topics'])) {
                                        foreach ($data['topics'] as $key => $value) {
                                    ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo BASE_URL; ?>reply/<?php echo $value['path'] ?>">
                                                    <?php echo  $value['title']; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $value['nickname'] ?></td>
                                            <td><?php echo $value['replies'] ?></td>
                                    <?php
                                            if($value['open'] == FALSE){
                                    ?>
                                            <td><i class='fa fa-lock'></i></td>
                                    <?php        
                                            }else{
                                    ?>
                                                <td></td>
                                    <?php
                                            }
                                    ?>
                                        </tr>
                                            <?php
                                        }
                                    ?>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <?php
                                include_once "pagination-controls.php";
                            ?>
                        </div>
                    </div>

                <?php
                } else if (isset($data['create'])) {
                ?>
                    <div class="row">
                        <div class="col-12">

                            <form action="<?php echo BASE_URL; ?>crear-topic" method="POST" novalidate>

                                <input type="hidden" name="id_cat" value="<?php echo $data['id_cat'] ?>" />

                                <div class="row form-group">
                                    <div class="col-12">
                                        <label for="title">Titulo topic</label>
                                        <input type="text" class="form-control" name="title" maxlength="80" required id="title" />
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-12">
                                        <label for="editor">Texto</label>
                                        <textarea name="text" required class="form-control" id="editor" cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-block" name="action" type="submit">Crear</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-block" name="back" type="button">Volver</button>
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



    </div>
</div>




<?php

include_once 'footer.php';


?>